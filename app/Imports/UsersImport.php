<?php
namespace App\Imports;


use App\Day;
use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Price_at_day;

class UsersImport implements ToCollection
{
    public function collection(Collection $rows)
    {

        $day = Day::where('day','=',date("Y-m-d"))->first();
        if( !empty($day) )
        $day_id = Day::where('day','=',date("Y-m-d"))->first()->id;
        else{
            $day = new Day();
            $day->day = date("Y-m-d");
            $day->save();

            $day_id  = $day->id;

        }

        foreach ($rows as $row)
        {
            $product_id  = Product::where('en_title','=',$row[5])->first();


           // echo  $product_id . " " . $row[1];
            if(!empty($product_id)&& !empty($row[4]))
            {
                $price =  Price_at_day::where('day_id','=',$day_id)
                ->where('product_id','=',$product_id->id)->first();

                if(!empty($price))
                {
                    $price->user_id = session('id') ;
                    if(!empty($row[6]))
                        $price->price = $row[6];
                    else
                    $price->price = 1;

                    $price->save();
                }
               else
               {
                   $newPrice = new Price_at_day();
                   $newPrice->product_id = $row[0];
                   $newPrice->day_id = $day_id ;
                   if(!empty($row[6]))
                   $newPrice->price = $row[6];
                   else
                   $newPrice->price = 1;
                   $newPrice->user_id = $row[2];
                       $newPrice->save();
                       
               }

            }



        }

    }
}
