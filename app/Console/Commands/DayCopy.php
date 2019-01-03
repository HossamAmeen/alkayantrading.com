<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Day;
use App\Price_at_day;
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
        $newDay = new Day();
        $newDay->day = date("Y-m-d");
        $newDay->save();
        Log.info('cron started');
       /* $yesterday = Day::where('day', '=', date('Y/m/d', strtotime('-1 days')))->first();
        if (!empty($yesterday))
        $price_at_yesterdays = Price_at_day::where('day_id', '=', $yesterday->id)->get();
        if (!empty($price_at_yesterdays))
        foreach ($price_at_yesterdays as $price_at_yesterday) {

            $price_at_day = new Price_at_day();
            $price_at_day->product_id = $price_at_yesterday->product_id;
            $price_at_day->day_id = $price_at_yesterday->day_id + 1;
            $price_at_day->price = $price_at_yesterday->price;
            $price_at_day->user_id = $price_at_yesterday->user_id;
            $price_at_day->save();
        }*/
    }
}
