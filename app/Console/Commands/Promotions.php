<?php

namespace App\Console\Commands;

use App\Models\Meal;
use App\Models\Promo;
use Illuminate\Console\Command;

class Promotions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cwd:Promos';

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
        //$date = date(now(), "Y-m-d");
        $promo = Promo::whereDate('date_debut', '<=', date("Y-m-d"))
        ->whereDate('date_fin', '>=', date("Y-m-d"))
        ->first();
        

        $meal = Meal::where('promo_id', $promo->id)->get();
        
        $promo_price = $meal->price - ($meal->price*$promo->percent*10/100);
        info($promo);
        info($meal);
        info($promo_price);
        
        return 0;
    }
}
