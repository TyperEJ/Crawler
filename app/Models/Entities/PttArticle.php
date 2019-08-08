<?php

namespace App\Models\Entities;

use App\Events\PttArticleCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class PttArticle extends Model
{
    use Notifiable;

    protected $fillable = [
        'board',
        'article_id',
        'title',
        'origin_url',
        'short_url',
        'content'
    ];

    protected $dispatchesEvents = [
        'created' => PttArticleCreated::class
    ];

    public function getMessageBuilder()
    {
        $text = <<<TEXT
小助手新通知:
{$this->title}
{$this->origin_url}
TEXT;

        return new TextMessageBuilder($text);
    }
}
