<?php

namespace App\Events;

use App\Models\Entities\PttArticle;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PttArticleCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $pttArticle;

    /**
     * Create a new event instance.
     *
     * @param PttArticle $pttArticle
     * @return void
     */
    public function __construct(PttArticle $pttArticle)
    {
        $this->pttArticle = $pttArticle;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getArticle()
    {
        return $this->pttArticle;
    }
}
