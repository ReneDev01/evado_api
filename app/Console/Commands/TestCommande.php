<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommande extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cwd:TestRene';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("rene");

        
        return 0;
    }
}
