<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Day;
use App\Price_at_day;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
      //  commands\TestCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        //  $schedule->exec('php artisan test:test');
        $schedule->call(function () {
            $yesterday =  Day::where('day','=',date('Y/m/d',strtotime('-1 days')))->first();
            $newDay = new Day();
            $newDay->day = date("Y-m-d");
            $newDay->save();
            $price_at_yesterdays = Price_at_day::where('day_id','=',$yesterday->id)->get();
            //return count($price_at_yesterdays);
            foreach ($price_at_yesterdays as $price_at_yesterday)
            {
                //  return $price_at_yesterday->product_id;
                $price_at_day = new Price_at_day();
                $price_at_day->product_id = $price_at_yesterday->product_id;
                $price_at_day->day_id = $price_at_yesterday->day_id +1 ;
                $price_at_day->price = $price_at_yesterday->price;
                $price_at_day->user_id = $price_at_yesterday->user_id;
                $price_at_day->save();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
