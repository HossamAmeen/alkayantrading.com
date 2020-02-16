<?php
namespace App\Imports;

use App\Price_at_day;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $myProduct = Price_at_day::where('product_id', '=', $row[1])
                ->where('day', '=', date("Y-m-d"))->first();

            if (!empty($myProduct)) {
                $myProduct->price_today = $row[6];
                $myProduct->user_id = session( 'id');
                $myProduct->save();
            }

        }
    }
}
