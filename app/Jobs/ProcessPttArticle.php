<?php

namespace App\Jobs;

use App\Models\Entities\PttArticle;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Goutte\Client;

class ProcessPttArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $attributes = ['article_id','title','origin_url','board'];
    protected $article;
    protected $client;

    /**
     * Create a new job instance.
     *
     * @param array $crawledArticle
     * @return void
     */
    public function __construct($crawledArticle)
    {
       $this->article = array_combine($this->attributes,$crawledArticle);
    }

    /**
     * Execute the job.
     *
     * @param Client $client
     * @return void
     */
    public function handle(Client $client)
    {
        $this->client = $client;

        PttArticle::create($this->article);
    }

    protected  function updateContent(PttArticle $article)
    {
        $crawler = $this->client->request('GET',$article->origin_url);

        // 網站分級限制
        if($crawler->filter('.over18-notice')->count())
        {
            $form = $crawler->selectButton('yes')->form();

            $crawler = $this->client->submit($form);
        }

        $article->content = $crawler->filter('#main-content')->text();

        $article->update();
    }
}
