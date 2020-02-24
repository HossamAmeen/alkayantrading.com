<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Price_at_day;
use App\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PriceAtDayController extends Controller
{

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'products.xlsx');
    }
    public function import(Request $request)
    {
        if ($request->isMethod('post')) {
            Excel::import(new UsersImport, $request->file('excel'));
            $request->session()->flash('status', 'uploaded was successfully!');
        }

        return redirect()->route('show_prices');

    }
    public function add_price(Request $request, $day)
    {
        for ($i = 0; $i < count($request->products); $i++) {
            $price = Price_at_day::where('product_id', $request->products[$i])->first();
            if (isset($price)) {
                if ($day == 1) {
                    $price->price_today = $request->price[$i];
                } elseif ($day == 2) {
                    $price->price_yesterday = $request->price_yesterday[$i];
                } elseif ($day == 3) {
                    $price->price_before_yesterday = $request->price_before_yesterday[$i];
                }

                $price->save();
            } else {
                $price = new Price_at_day();
                $price->product_id = $request->products[$i];
                $price->price_today = $request->price[$i];
                $price->price_yesterday = $request->price_yesterday[$i];
                $price->price_before_yesterday = $request->price_before_yesterday[$i];
                $price->save();
            }

        }
        $request->session()->flash('status', 'تمت الإضافة بنجاح');
        return redirect()->route('show_prices');
    }
    public function copyPrice(Request $request, $day)
    {
        for ($i = 0; $i < count($request->products); $i++) {
            $price = Price_at_day::where('product_id', $request->products[$i])->first();
            if (isset($price)) {
                if ($day == 2) {
                    $price->price_yesterday = $price->price_today;
                } elseif ($day == 3) {
                    $price->price_before_yesterday = $price->price_yesterday;
                }

                $price->save();
            }
        }
        $request->session()->flash('status', 'تمت الإضافة بنجاح');
        return redirect()->route('show_prices');
    }

    public function show_prices(Request $request)
    {
        $title = 'عرض الاسعار';
        $products = Product::get();
        return view('admin.control_panel.prices.edit_price_at_day', compact('title', 'products'));
    }
    public function formValidation()
    {
        return array(

            'price' => 'array|required',
            'price.*' => 'required|numeric',
            'day' => 'date|required',
        );
    }
    public function messageValidation()
    {
        return array(

            'ar_title.required' => 'هذا الحقل (قسم بالعربيه) مطلوب ',
            'ar_title.unique' => 'هذا الحقل (قسم بالعربيه) يوجد بالفعل ',
            'ar_title.*' => 'هذا الحقل (قسم بالعربيه) يجب يحتوي ع حروف وارقام فقط',

            'en_title.required' => 'هذا الحقل (قسم بالانجليزي) مطلوب ',
            'en_title.unique' => 'هذا الحقل (قسم بالانجليزي) يوجد بالفعل ',
            'en_title.*' => 'هذا الحقل (قسم بالانجليزي) يجب يحتوي ع حروف وارقام فقط ',
        );
    }
}
