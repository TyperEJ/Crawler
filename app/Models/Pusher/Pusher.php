<?php

namespace App\Models\Pusher;

use App\Models\Entities\LineMember;
use App\Models\Entities\PttArticle;

interface Pusher {
    public static function push(LineMember $lineMember,PttArticle $pttArticle);
}