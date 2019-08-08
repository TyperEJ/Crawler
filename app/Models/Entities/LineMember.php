<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class LineMember extends Model
{
    protected $fillable = [
        'uid'
    ];

    public function keywords()
    {
        return $this->hasMany(MemberBoardKeyword::class);
    }
}
