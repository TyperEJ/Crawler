<?php

namespace App\Models\Entities;

use App\Events\PttArticleCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PttArticle extends Model
{
    use Notifiable;

    protected $fillable = [
        'board',
        'article_id',
        'title',
        'origin_url',
        'author',
        'short_url',
        'content'
    ];

    protected $dispatchesEvents = [
        'created' => PttArticleCreated::class
    ];

    public function getText()
    {
        $text = <<<TEXT
{$this->title}
{$this->origin_url}
TEXT;

        return $text;
    }
}
