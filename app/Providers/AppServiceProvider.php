<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Pref;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        try {
           // if( DB::connection()->getPdo() );
            $pref = Pref::find(1);
            if(!empty($pref))
                View::share('pref',$pref );
        } catch (\Exception $e) {
           // die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }


    
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
