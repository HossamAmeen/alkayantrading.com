<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\controller;
use DB;
use App\Day;
use App\Price_at_day;
use App\Category;
use Illuminate\Http\Request;

class PriceAtDayController extends Controller
{
   
    public function index()
    {
       
      $categories = DB::table('categories')->select('id','en_title')->get();
        $i=1;
        foreach ( $categories as  $value) {
           $data['category'.$i++] = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->select('products.id','products.en_title' ,'price')
           ->get();
        }
      
        $title = 'عرض الاسعار';

         return view('control_panel.edit_price_at_day' , $categories)->with(compact('data', 'title','categories') );

    }

    public function create()
    {
        $title= 'اضافه الاسعار';
       /* $data['products'] = DB::table('products')
        ->select('products.id','en_title')
        ->get();*/
        $categories = DB::table('categories')->select('id','en_title')->get();
        $i=1;
        foreach ( $categories as  $value) {
           $data['category'.$i++] = DB::table('products')
         
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->select('products.id','products.en_title')
           ->get();
        }
        return view('control_panel.add_price_at_day', $categories)->with(compact('data', 'title','categories') );
    }

    public function store(Request $request)
    {
        
        $rules = $this->formValidation();
        $this->validate($request, $rules);
        $day = new Day();
        if(!empty($request->day))

        $day->day = $request->day;

        else
        $day->day = date("Y/m/d");
        $day->save();
        
        
        
        for ($i=0; $i < count($request->price) ; $i++) { 
            $price = new Price_at_day();
            $price->user_id = session('id') ;
            $price->day_id = $day->id ;
            $price->product_id = $request->product_id[$i];
            $price->price = $request->price[$i];
            $price->save();
        }
       
       
        return redirect()->route('priceAtDay.index');
              
    }

    public function copy_day(){

        $yesterday =  Day::where('day','=',date('Y/m/d',strtotime('-1 days')))->first();


       $price_at_yesterdays = Price_at_day::where('day_id','=',$yesterday->id)->get();
        //return count($price_at_yesterdays);
        foreach ($price_at_yesterdays as $price_at_yesterday)
        {
          //  return $price_at_yesterday->product_id;
            $price_at_day = new Price_at_day();
            $price_at_day->product_id = $price_at_yesterday->product_id;
            $price_at_day->day_id = $price_at_yesterday->day_id +1 ;
            $price_at_day->price = $price_at_yesterday->price;
            $price_at_day->user_id = $price_at_yesterday->user_id;
            $price_at_day->save();
        }

        /*
         $today = new Day();
         $today->day = date("Y/m/d");
         $today->save();*/




    }
    
    public function show_prices(Request $request){
        //return $date;
        $categories = DB::table('categories')->select('id','en_title')->get();
        $date = $request->date;
        if(empty($date)){
            $date = date("Y-m-d");
        }
        $i=1;
        foreach ( $categories as  $value) {
            $data['category'.$i++] = DB::table('products')
                ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
                ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
                ->join('categories' , 'products.category_id' ,'=','categories.id' )
                ->where('categories.id','=',$value->id)
                ->where('days.day','=',$date)
                ->select('products.id','products.en_title' ,'price')
                ->get();
        }
        $title= 'عرض الاسعار';
        return view('control_panel.edit_price_at_day2' , $categories)->with(compact('data', 'title','categories' , 'date') );
    }
    function formValidation()
    {
       return array(
       
        'price'     => 'array||required',
        'price.*' =>  'required|numeric',
       );
    }
}
