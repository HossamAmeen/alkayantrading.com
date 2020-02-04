<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use DB;
use App\Day;
use App\Price_at_day;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;

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
    public function add_price(Request $request , $day_id)
    {
        $day = Input::get('day');
        $myDay = Day::where('day', '=', $day   )->first();

      /*  $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
*/
        $prices = Input::get('price');
        $products = Input::get('product_id');


        if(count($prices) != count($products) ){
            return redirect()->route('show_prices');

        }

        foreach($prices as $index => $price ){

            $myProduct = Price_at_day::where('product_id','=',$products[$index])
                                    ->where('day_id','=',$myDay->id)->first();
//            dd($myProduct);
            if(!empty($myProduct)){
                $myProduct->price = $prices[$index];
                $myProduct->user_id = Auth::id();
                $myProduct->save();
                echo "existing product";
            }else{
                $newDay = new Price_at_day ();
                $newDay->product_id = $products[$index];
                $newDay->price = $prices[$index];
                $newDay->day_id = $myDay->id;
                $newDay->user_id = Auth::id();
                $newDay->save();
            }

        }


            $request->session()->flash('status', 'تمت الإضافة بنجاح');

        return redirect()->route('show_prices');
              
    }
    public function show_prices(Request $request)
    {


        $categories = DB::table('categories')->select('id','ar_title')->where('deleted_at','=',null)->get();
        $date = $request->date;
        //$day_id = 1;
        if(empty($date)){
            
            $date = date("Y-m-d");
            $day_id = Day::where('day','=',$date)->first();
            if(!empty($day_id))
            $day_id = Day::where('day','=',$date)->first()->id;
            else{ 
                $day = new Day();
                $day->day = date("Y-m-d");
                $day->save();
                $day_id  = $day->id;
            }
        }
        else{
            if(!empty($day_id))
            $day_id = Day::where('day','=',$date)->first()->id;
            else{ 
                $day = new Day();
                $day->day = $date;
                $day->save();
                $day_id  = $day->id;
            }
        }
            
        $i=1;
        foreach ( $categories as  $value) {
            $data['category'.$i] = DB::table('products')
                ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
                ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
                ->join('categories' , 'products.category_id' ,'=','categories.id' )
                ->where('categories.id','=',$value->id)
                ->where('days.day','=',$date)
                ->where('products.deleted_at','=',null)
                ->select('products.id','products.ar_title' ,'price')
                ->get();
            if( count( $data['category'.$i] ) == 0  )
            {
                $data['category'.$i] = DB::table('products')
                ->join('categories' , 'products.category_id' ,'=','categories.id' )
                ->where('categories.id','=',$value->id)
                ->where('products.deleted_at','=',null)
                ->select('products.id','products.ar_title' )
                ->get();
            }    
         //   echo $i;
            $i++;
        }
        
       //return ($data) ;
      // return $day_id;
        $title= 'عرض الاسعار';
       return view('admin.control_panel.prices.edit_price_at_day' , $categories)->with(compact('data', 'title','categories' , 'date' , 'day_id') );
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
