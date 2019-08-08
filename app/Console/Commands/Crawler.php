<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPttArticle;
use App\Models\Entities\PttArticle;
use Illuminate\Console\Command;
use App\Models\Crawlers\PttCrawler;

class Crawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:start {board}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler Start';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param PttCrawler $pttCrawler
     */
    public function handle(PttCrawler $pttCrawler)
    {
        $board = $this->argument('board');

        $pttCrawler->start("https://www.ptt.cc/bbs/{$board}/index.html",5);

        $articles = $pttCrawler->getArticles();

        $this->saveArticles($articles,$board);

        $this->info("$board Crawled Success");
    }

    protected function saveArticles($articles,$board)
    {
        $queryLatest = PttArticle::query()
            ->select('article_id')
            ->where(['board' => $board])
            ->orderBy('id','desc');

        $latestArticle = $queryLatest->exists() ? $queryLatest->first() : $queryLatest->newModelInstance();

        $articles = collect($articles);

        $searchKey = $articles->search(function($item) use ($latestArticle){
            list($article_id) = $item;

            return $article_id === $latestArticle->article_id;
        });

        $searchKey++;

        $articles = $articles->splice($searchKey);

        $articles->map(function($article) use ($board){
            array_push($article,$board);

            ProcessPttArticle::dispatch($article);
        });
    }
}
