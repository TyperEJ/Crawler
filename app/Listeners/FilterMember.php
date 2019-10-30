<?php

namespace App\Listeners;

use App\Events\PttArticleCreated;
use App\Models\Bot\BotFactory;
use App\Models\Entities\MemberBoardKeyword;
use App\Models\Pusher\Pusher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FilterMember implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  PttArticleCreated  $event
     * @return void
     */
    public function handle(PttArticleCreated $event)
    {
        $article = $event->getArticle();

        $boardKeywords = MemberBoardKeyword::query()
            ->where(['board' => $article->board])
            ->get();

        $filtered = $boardKeywords->filter(function($boardKeyword) use ($article){
            $title = strtolower($article->title);
            $keyword = explode('&',strtolower($boardKeyword->keyword));

            return $this->contains($title, $keyword);
        });

        $filtered->each(function($boardKeyword) use ($article){

            $pusher = app(Pusher::class);

            $pusher::push($boardKeyword->lineMember,$article);

        });
    }

    protected function contains($haystack, $needles)
    {
        $result = collect();

        foreach ((array) $needles as $needle) {
            if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
                $result->push(true);
            }else{
                $result->push(false);
            }
        }

        $result = $result->unique();

        if($result->count() == 1 && $result->pop() === true)
        {
            return true;
        }

        return false;
    }
}
