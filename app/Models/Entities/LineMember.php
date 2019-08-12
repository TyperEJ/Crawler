<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class LineMember extends Model
{
    protected $fillable = [
        'uid'
    ];

    protected $hidden = ['created_at','updated_at'];

    protected $with = ['keywords'];

    public function keywords()
    {
        return $this->hasMany(MemberBoardKeyword::class);
    }
}
