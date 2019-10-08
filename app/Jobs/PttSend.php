<?php

namespace App\Jobs;

use App\Models\Entities\LineMember;
use App\Models\Entities\PttArticle;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\InputStream;
use Symfony\Component\Process\Process;

class PttSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $parameters;

    protected $linePayload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($parameters,$linePayload)
    {
        $this->parameters = $parameters;

        $this->linePayload = $linePayload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $pttArticleId = $this->parameters
                ->ptt_article_id;

            $lineMemberUid = $this->linePayload
                ->data
                ->source
                ->userId;

            $mailContent = $this->parameters
                ->content;

            $article = PttArticle::query()
                ->where('article_id','=',$pttArticleId)
                ->first();

            $lineMember = LineMember::query()
                ->where([
                    ['uid','=',$lineMemberUid],
                    ['ptt_account','!=',null],
                    ['ptt_password','!=',null],
                ])
                ->firstOrFail();

            $this->send($lineMember,$article,$mailContent);
        }catch (\Exception $e)
        {
            Log::error($e->getMessage());
        }
    }

    protected function send(LineMember $lineMember,PttArticle $article,$mailContent)
    {
        $input = new InputStream();

        $process = new Process('ssh -o "StrictHostKeyChecking no" ptt.cc -l bbsu');

        $process->setInput($input);

        $process->start();

        $input->write("{$lineMember->ptt_account},"."\r");

        $input->write("{$lineMember->ptt_password}"."\r");

        $input->write("n\r\r\r\r\r");

        $input->write("\x1b\x4fD");

        $input->write("\x1b\x4fD");

        $input->write("\x1b\x4fD");

        $input->write("\x1b\x4fB");

        $input->write("\r");

        $input->write("\x1b\x4fB");

        $input->write("\r");

        $input->write($article->author."\r");

        $input->write($article->title."\r");

        $input->write($mailContent);

        $input->write("\x18");

        $input->write("s"."\r");

        $input->write("y"."\r");

        $input->write("\r");

        $input->write("\x1b\x4fD");

        $input->write("\x1b\x4fD");

        $input->write("\r");

        $input->write("y"."\r");

        $input->write("\r");

        $input->close();

        $process->wait();

        if(!$process->isSuccessful()){
            throw new ProcessFailedException($process);
        }
    }
}
