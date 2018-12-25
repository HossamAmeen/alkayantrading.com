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
        $date = date("Y-m-d");
        $day_id = Day::where('day','=',$date)->first()->id;

        foreach ($rows as $row)
        {
            $price =  Price_at_day::where('day_id','=',$day_id)->first();
            $price->user_id = session('id') ;
            $price->day_id = $day_id ;

            $product_id  = Product::where('en_title','=',$row[0])->first();
            if(!empty($product_id))
            {
                $product_id = $product_id->id;
                $price->product_id = $product_id;
                $price->price = $row[1];
                $price->save();
            }



        }

    }
}
