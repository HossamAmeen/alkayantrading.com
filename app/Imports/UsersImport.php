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

        $day_id = Day::where('day','=',date("Y-m-d"))->first()->id;

        foreach ($rows as $row)
        {
            $product_id  = Product::where('en_title','=',$row[3])->first();


           // echo  $product_id . " " . $row[1];
            if(!empty($product_id)&& !empty($row[4]))
            {
                $price =  Price_at_day::where('day_id','=',$day_id)
                ->where('product_id','=',$product_id->id)->first();
                $price->user_id = session('id') ;
                $price->price = $row[4];
                //var_dump($price);
                $price->save();
            }



        }

    }
}
