<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\InputStream;
use Symfony\Component\Process\Process;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ptt:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ptt mail send';

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
        $input = new InputStream();

        $process = new Process('ssh -o "StrictHostKeyChecking no" ptt.cc -l bbs');

        $process->setInput($input);

        $process->start();

        $input->write('miaomiao5566,'."\r");

        $input->write('55668451'."\r");

        $input->write("\r");

        $input->write("\x1b\x4fB");

        $input->write("\r");

        $input->write("\x1b\x4fB");

        $input->write("\r");

        $input->write('EJLin'."\r");

        $input->write('Success'."\r");

        $input->write('Test');

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

        $process->stop();

        if(!$process->isSuccessful()){
            throw new ProcessFailedException($process);
        }

        $this->info('Success');
    }
}
