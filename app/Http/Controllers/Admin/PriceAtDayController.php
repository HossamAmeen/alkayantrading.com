<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use DB;
use App\Category;
use App\Price_at_day;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Arr;
class PriceAtDayController extends Controller
{

    public  function  exportExcel(){
        return Excel::download(new UsersExport, 'products.xlsx');
    }
    public function import(Request $request)
    {
        if($request->isMethod('post'))
        {
            Excel::import(new UsersImport, $request->file('excel'));
            $request->session()->flash('status', 'uploaded was successfully!');
        }


        return redirect()->route('show_prices');

    }
    public function add_price(Request $request , $day_id = null)
    {
        
        // foreach($request->products as $item )
        $products = $request->products ; 
        // return $products;
        for($i = 0 ; $i <count($products); $i++ ){
            // return $request->day ;
            if(isset($request->day))
            $myProduct = Price_at_day::where('product_id','=',$products[$i])
                                    ->where('day','=',$request->day)->first();
            else
            {
                // return $products[$i];
                $myProduct = Price_at_day::where('product_id','=',$products[$i])
                ->where('day','=',date("Y-m-d"))->first();
            }
            
            if(!empty($myProduct)){
                $myProduct->price_today = $request->price[$i];
                $myProduct->user_id = Auth::id();
                $myProduct->save();
                // echo "existing product";
            }else{
                $newDay = new Price_at_day ();
                $newDay->product_id = $products[$i];
                $newDay->price_today = $request->price[$i];
                $newDay->price_yesterday = $request->price[$i];
                $newDay->price_before_yesterday = $request->price[$i];
                // $newDay->day_id = $myDay->id;
                $newDay->user_id = Auth::id();
                $newDay->save();
            }

        }


            $request->session()->flash('status', 'تمت الإضافة بنجاح');

        return redirect()->route('show_prices');
              
    }
    public function show_prices(Request $request)
    {

        $productsArray = Product::get();   
        
        $products = array();
        foreach($productsArray as $product)
        {
            // return $product->priceYesterDaye(2)->price_today;
            $data['id'] = $product->id ;
            $data['product'] = $product->ar_title ;
            if(isset($request->date))
            $price= Price_at_day::where('day', '=',$request->date  )
                                  ->where('product_id' , $product->id)->first();
            else
            $price= Price_at_day::where('day', '=',date('Y-m-d')  )
            ->where('product_id' , $product->id)->first();

            
            if(!isset($price))
            {
                // return "test";
                $data['price'] = 1;
            }
            else
            $data['price'] = $price->price_today ;
           
            // $data['product']['price'][] = $product->price->price_today ;

            $products[] = $data;
        }
      
        
        $day = $request->date ; //// to show in valueof button
    //   return $products;
        $title= 'عرض الاسعار';
       return view('admin.control_panel.prices.edit_price_at_day' , compact('title','products','day') );
    }
    function formValidation()
    {
       return array(
       
        'price'     =>  'array|required',
        'price.*'   =>  'required|numeric',
        'day'       =>  'date|required'
       );
    }
    function messageValidation(){
        return array(

            'ar_title.required'     => 'هذا الحقل (قسم بالعربيه) مطلوب ',
            'ar_title.unique'     => 'هذا الحقل (قسم بالعربيه) يوجد بالفعل ',
            'ar_title.*'            =>  'هذا الحقل (قسم بالعربيه) يجب يحتوي ع حروف وارقام فقط',

            'en_title.required'     => 'هذا الحقل (قسم بالانجليزي) مطلوب ',
            'en_title.unique'     => 'هذا الحقل (قسم بالانجليزي) يوجد بالفعل ',
            'en_title.*'            =>  'هذا الحقل (قسم بالانجليزي) يجب يحتوي ع حروف وارقام فقط ',
        );
    }
}
