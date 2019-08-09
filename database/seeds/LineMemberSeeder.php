<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\LineMember;
use App\Models\Entities\MemberBoardKeyword;

class LineMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lineMember = LineMember::create([
            'uid' => 'Ue1f5ad4cf1aa3bbabf62dda99afa42c9'
        ]);

        MemberBoardKeyword::create([
            'line_member_id' => $lineMember->id,
            'board' => 'MacShop',
            'keyword' => 'pod&台中',
        ]);

        MemberBoardKeyword::create([
            'line_member_id' => $lineMember->id,
            'board' => 'MacShop',
            'keyword' => 'pod&全國',
        ]);

        MemberBoardKeyword::create([
            'line_member_id' => $lineMember->id,
            'board' => 'Lifeismoney',
            'keyword' => '情報',
        ]);

        MemberBoardKeyword::create([
            'line_member_id' => $lineMember->id,
            'board' => 'MobilePay',
            'keyword' => '情報',
        ]);

        MemberBoardKeyword::create([
            'line_member_id' => $lineMember->id,
            'board' => 'soho',
            'keyword' => '徵才&程式',
        ]);
    }
}
