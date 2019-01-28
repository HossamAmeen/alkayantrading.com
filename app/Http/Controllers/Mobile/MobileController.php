<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use App\Service;
use App\Pref;
use DB;
use Illuminate\Http\Request;




class MobileController extends Controller
{


    public function en_services()
    {
        $services['rows'] = DB::table('services')->select( 'en_title as title', 'category_id' , 'img')
            ->where('services.deleted_at','=' , null)
            ->get();

        return json_encode($services , JSON_UNESCAPED_UNICODE) ;

    }
   
    public function en_daily_price($service = NULL)
    {

        $categories = DB::table('categories')->select('id','en_title')->get();
       
        $i=1;
            $data = array();
        foreach ( $categories as  $value) {
           $data['category'.$i] = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->where('days.day' ,'=',date('Y/m/d'))
           ->select('products.id','products.en_title as title' ,'products.company_name','price')
           ->get();

            

           $yesterDayPrice = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
          
          ->where('days.day' ,'=',date('Y/m/d',strtotime("-1 days")))
           ->select('price')
           ->get();
         

           $yesterDayPrice2 =DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           
           ->where('days.day' ,'=',date('Y/m/d',strtotime("-2 days")))
           ->select('price')
           ->get();
           $data['category'.$i]->put('yesterDayPrice', $yesterDayPrice);
           $data['category'.$i]->put('beforeYesterDayPrice', $yesterDayPrice2);
            
          
          $i++; 
        }



        return json_encode($data , JSON_UNESCAPED_UNICODE);


    }

    public function en_about()
    {
        $pref['rows'] =  DB::table('prefs')->select( 'enAddress as address', 'enDescription as description' ,  'phone'
            ,'enMainAddress as mainAddress' ,
            'mainEmail' , 'facebook' , 'twitter' , 'instgram' ,'linkedin')
            ->get();
        return json_encode($pref , JSON_UNESCAPED_UNICODE);

    }
    public function ar_services()
    {
        $services['rows'] = DB::table('services')->select( 'ar_title as title', 'category_id' , 'img')
            ->where('services.deleted_at','=' , null)
            ->get();

        return json_encode($services , JSON_UNESCAPED_UNICODE) ;

    }
    public function ar_daily_price($service = NULL)
    {

        $categories = DB::table('categories')->select('id','ar_title')->get();
       
        $i=1;
        $data = array();
        foreach ( $categories as  $value) {
           $data['category'.$i] = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->where('days.day' ,'=',date('Y/m/d'))
           ->select('products.id','products.ar_title as title' ,'products.company_name','price')
           ->get();

            

           $yesterDayPrice = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
          
          ->where('days.day' ,'=',date('Y/m/d',strtotime("-1 days")))
           ->select('price')
           ->get();
         

           $yesterDayPrice2 =DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           
           ->where('days.day' ,'=',date('Y/m/d',strtotime("-2 days")))
           ->select('price')
           ->get();
           $data['category'.$i]->put('yesterDayPrice', $yesterDayPrice);
           $data['category'.$i]->put('beforeYesterDayPrice', $yesterDayPrice2);
            
          
          $i++; 
        }



        return json_encode($data , JSON_UNESCAPED_UNICODE);


    }
    public function ar_about()
    {
        $pref['rows'] =  DB::table('prefs')->select(   'arAddress as address', 'arDescription as description' ,  'phone'
        ,'arMainAddress as mainAddress' ,
        'mainEmail' , 'facebook' , 'twitter' , 'instgram' ,'linkedin')
           
            ->get();
        return json_encode($pref , JSON_UNESCAPED_UNICODE);

    }
    public function join_us(Request $request)
    {

            $data=[
                'email' =>  $request->email,
                'name' => $request->name,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'job'=>$request->job,
            ];
            Mail::send('mail',$data,function($message) use ($data){
                $message->from( $pref->mainEmail , 'kayan');
                $message->to($data['email']);
                $message->subject('job');
            });
            return redirect()->back();

    }
    public function contact(Request $request)
    {

        $pref = Pref::find(1);
        if ($request->isMethod('post')) {
            //      Name phone email
            $data=[
                'email' =>  $request->email,
                'Name' => $request->Name,
                'phone'=>$request->phone,
                'text'=>$request->text,
            ];
            Mail::send('mail',$data,function($message) use ($data){
                $message->from( $pref->mainEmail , 'kayan');
                $message->to($data['email']);
                $message->subject('contact');
            });
            return redirect()->back();
        }


    }
}
