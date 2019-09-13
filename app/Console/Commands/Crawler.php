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
    protected $signature = 'crawler:start {board} {--page=3}';

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

        $page = $this->option('page');

        $pttCrawler->start("https://www.ptt.cc/bbs/{$board}/index.html",$page);

        $articles = $pttCrawler->getArticles();

        $this->saveArticles($articles,$board);

        $this->info("$board Crawled Success");
    }

    protected function saveArticles($articles,$board)
    {
        $queryExists = PttArticle::query()
            ->select('article_id')
            ->where(['board' => $board])
            ->orderBy('id','desc')
            ->limit(count($articles));

        $existArticles = $queryExists->count() ? $queryExists->get() : collect();

        $articles = collect($articles);

        foreach ($existArticles as $existArticle)
        {
            $searchKey = $articles->search(function($item) use ($existArticle){
                list($article_id) = $item;

                return $article_id === $existArticle->article_id;
            });

            if($searchKey !== false)
            {
                $searchKey++;

                $articles = $articles->splice($searchKey);

                break;
            }
        }

        $articles->each(function($article) use ($board){

            array_push($article,$board);

            ProcessPttArticle::dispatch($article);

        });
    }
}
