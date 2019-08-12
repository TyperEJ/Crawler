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

    protected $hidden = ['id','line_member_id','created_at','updated_at'];

    public function lineMember()
    {
        return $this->belongsTo(LineMember::class);
    }
}
