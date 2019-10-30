<?php

namespace App\Console\Commands;

use App\Models\Entities\PttArticle;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Expired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete 7days ago articles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sevenDaysAgo = Carbon::now()->subDay(7);

        PttArticle::query()
            ->where('created_at','<',$sevenDaysAgo)
            ->delete();
    }
}
