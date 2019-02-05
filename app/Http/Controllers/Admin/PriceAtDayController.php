<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use DB;
use App\Day;
use App\Price_at_day;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

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

        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);


        for ($i=0; $i < count($request->price) ; $i++) {

            $price =  Price_at_day::where('day_id','=',$day_id)->where('product_id','=',$request->product_id[$i])->first();
            $price->user_id = session('id') ;
            $price->price = $request->price[$i];
            $price->save();
            $request->session()->flash('status', 'added was successfully!');
        }

        return redirect()->route('show_prices');
              
    }
    public function show_prices(Request $request)
    {


        $categories = DB::table('categories')->select('id','en_title')->get();
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
                ->select('products.id','products.en_title' ,'price')
                ->get();
            if( count( $data['category'.$i] ) == 0  )
            {
                $data['category'.$i] = DB::table('products')
                ->join('categories' , 'products.category_id' ,'=','categories.id' )
                ->where('categories.id','=',$value->id)
                ->select('products.id','products.en_title' )
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
