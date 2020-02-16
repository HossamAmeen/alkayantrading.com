<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Day;
use App\Price_at_day;
use Illuminate\Support\Facades\Log;
class DayCopy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
       
        Log::info('cron started on ' . date("Y-m-d"));
       
    
            $price_at_yesterdays = Price_at_day::where('day', '=', date('Y-m-d', strtotime('-1 days') ) )->get();
        
        Log::info('cron started on ' .  date('Y/m/d', strtotime('-1 days') ) );
        if (!empty($price_at_yesterdays))
        foreach ($price_at_yesterdays as $price_at_yesterday) {
            $price_at_day = new Price_at_day();
            $price_at_day->product_id = $price_at_yesterday->product_id;
           
            $price_at_day->price_today = $price_at_yesterday->price_today;
            $price_at_day->price_yesterday = $price_at_yesterday->price_today;
            $price_at_day->price_before_yesterday = $price_at_yesterday->price_yesterday;

            $price_at_day->save();
        }
    }
}
