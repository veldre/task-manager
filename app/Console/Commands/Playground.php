<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Playground extends Command
{
    protected $signature = 'testing:playground';

    protected $description = 'Command description';


    public function handle()
    {
        dd(now()->addDay()->toISOString());
    }
}
