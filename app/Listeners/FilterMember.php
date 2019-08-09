<?php

namespace App\Listeners;

use App\Events\PttArticleCreated;
use App\Models\Entities\MemberBoardKeyword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use LINE\LINEBot;

class FilterMember implements ShouldQueue
{
    protected $bot;

    /**
     * Create the event listener.
     *
     * @param LINEBot $bot
     * @return void
     */
    public function __construct(LINEBot $bot)
    {
        $this->bot = $bot;
    }

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
            ->with('lineMember')
            ->get();

        $filtered = $boardKeywords->filter(function($boardKeyword) use ($article){
            $title = strtolower($article->title);
            $keyword = explode('&',strtolower($boardKeyword->keyword));

            return $this->contains($title, $keyword);
        });

        $memberUids = $filtered->pluck('lineMember.uid')->unique();

        $memberUids->map(function($memberUid) use ($article){
            $this->bot->pushMessage($memberUid,$article->getMessageBuilder());
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
