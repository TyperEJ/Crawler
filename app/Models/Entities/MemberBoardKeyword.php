<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class MemberBoardKeyword extends Model
{
    protected $fillable = [
        'line_member_id',
        'board',
        'keyword'
    ];

    public function lineMember()
    {
        return $this->belongsTo(LineMember::class);
    }
}
