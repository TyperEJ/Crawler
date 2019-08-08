<?php

namespace App\Models\Crawlers;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class PttCrawler
{
    const INDEX_SPLIT = 'INDEX_SPLIT';

    protected $client;
    protected $articles = [];
    protected $page;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function start($startUrl,$page)
    {
        $this->page = $page;

        $crawler = $this->client->request('GET', $startUrl);

        // 網站分級限制
        if($crawler->filter('.over18-notice')->count())
        {
            $form = $crawler->selectButton('yes')->form();

            $crawler = $this->client->submit($form);
        }

        $this->crawled($crawler);
    }

    protected function crawled(Crawler $crawler,$depth = 0)
    {
        if($depth == $this->page)
        {
            return true;
        }

        $articles =  $crawler->filter('.search-bar ~ div')->each(function(Crawler $node, $i){

            if($node->filter('a')->count())
            {
                $uri = $node->filter('a')->link()->getUri();

                $articleId = substr($uri, -23,18);

                return [
                    $articleId,
                    $node->filter('a')->text(),
                    $uri
                ];
            }

            if($node->attr('class') === 'r-list-sep')
            {
                return self::INDEX_SPLIT;
            }

            return null;
        });

        $offsetKey = array_search(self::INDEX_SPLIT, $articles);

        if($offsetKey)
        {
            $articles = array_slice($articles, 0, $offsetKey);
        }

        $articles = array_filter(array_reverse($articles));

        $this->articles = array_merge($this->articles,$articles);

        $link = $crawler->selectLink('‹ 上頁')->link();

        $nextPageCrawler = $this->client->click($link);

        return $this->crawled($nextPageCrawler,++$depth);
    }

    public function getArticles()
    {
        return array_reverse($this->articles);
    }
}
