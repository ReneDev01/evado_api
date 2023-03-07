<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Partener;
use Illuminate\Console\Command;

class EndParteners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cwd:EndParteners';

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
        $now = Carbon::now();
        //$hour = date('hh:mm:00', strtotime($now));
        $hour = Carbon::createFromFormat('Y-m-d H:i:s', $now)->format('H:i:00');;
        $parteners = Partener::all();

        foreach($parteners as $partener){
            if($partener->end_hours == $hour){
                $partener->update([
                    'status' => false
                ]);
            }
        }
    }
}
