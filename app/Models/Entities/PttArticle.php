<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class PttArticle extends Model
{
    protected $fillable = [
        'board',
        'article_id',
        'title',
        'origin_url',
        'short_url',
        'content'
    ];
}
