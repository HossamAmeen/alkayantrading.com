<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Day;
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
    }
}
