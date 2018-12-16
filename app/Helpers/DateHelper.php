<?php namespace App\Helpers;
use Auth;
use Request;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Requests;
use Input;

class DateHelper  {

    public static function print_date($date){
        $date = date_create($date);
        echo date_format($date, 'Y-m-d');
    }//end print date

    public static function get_time($datetime){
        $time = date_create($datetime);
        $time =  date_format($time, 'Y-m-d H:i:s');
        return   date("0-0-0 H:i:s",strtotime($time));
    }

    public static function print_time($datetime){
        $date = date_create($datetime);
        return date_format($date, 'H:i');
    }

    public static function get_years(){
        $years = array();
        foreach(range(date('Y'), date('Y')-100, -1) as $year){
            $nextYear = $year+1;
            $value  = "{$year} - {$nextYear}";
            $years[$year] =  $value ;
        }
        return $years;
    }

    public static function get_ar_days(){
        $days = array();
        foreach(range(0, 6,1 ) as  $day){
            $days[$day] =  DateHelper::get_ar_day($day) ;
        }
        return $days;
    }

    public static function get_ar_day($dayNo){
        switch ($dayNo){
            case 0: return 'السبت';
            case 1: return 'الأحد';
            case 2: return 'الاثنين';
            case 3: return 'الثلاثاء';
            case 4: return 'الأربعاء';
            case 5: return 'الخميس';
            default: return 'الجمعة';
        }
    }

# $time = strtotime('2010-04-28 17:25:43');

# echo 'event happened '.humanTiming($time).' ago';

    public static function print_ar_elapsed_time($time){
        $time = strtotime($time);
        echo 'منذ '.DateHelper::ar_human_timing($time);
    }

    public static function print_en_elapsed_time($time){
        $time = strtotime($time);
         echo 'since '.DateHelper::en_human_timing($time) . "ago";
    }
    public static function en_human_timing ($time)
    {

        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'':'');
        }

    }//end en human timing

    public static function ar_human_timing ($time)
    {

        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'سنة',
            2592000 => 'شهر',
            604800 => 'أسبوع',
            86400 => 'يوم',
            3600 => 'ساعة',
            60 => 'دقيقة',
            1 => 'ثانية'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'':'');
        }

    }//end en human timing
}//end Date Helper