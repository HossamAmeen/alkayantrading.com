<?php

namespace App\Exports;

use App\Product;
use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
   /* public function collection()
    {
        return User::all();
    }*/
    public function view(): View
    {
       $products = Product::all();
        return view('admin.control_panel.prices.price_excel') ->with(compact('products' )
        );
    }
}

