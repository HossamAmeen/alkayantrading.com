<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Route;
use URL;
use Illuminate\Http\Request;
use App\Service;
use App\Pref;
use App\Product;
use App\Days;
use DB;
use Mail;

class HomeController extends Controller
{
    public  function  change_language($lang){


        if($lang == "en")

            $rout =   str_replace("ar","en",url()->previous());

        else
            $rout =   str_replace("en","ar",url()->previous());

       // return $rout;
        return redirect($rout);
    }
    public function ar_index()
    {

        $data['services'] = Service::all();
        $data['title'] = "kayan trading company";
        return view('web.ar.index',$data);
    }

    public function ar_services()
    {
        $data['services'] = Service::all();
        $data['title'] =  "شركة كيان - خدماتنا" ; 
        return view('web.ar.services',$data);
    }
    public function ar_daily_price($service = NULL)
    {
       
        $categories = DB::table('categories')->select('id','ar_title')->get();
       
        $i=1;
        foreach ( $categories as  $value) {
           $data['category'.$i] = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->where('days.day' ,'=',date('Y/m/d'))
           ->select('products.id','products.ar_title' ,'products.company_name','price')
           ->get();


           
           //while( ){}
           
           $yesterDayPrice = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->where('days.day' ,'=',date('Y/m/d',strtotime('-1 days')))
           ->select('price')
           ->get();
           $yesterDayPrice2 =DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->where('days.day' ,'=',date('Y/m/d',strtotime('-2 days')))
           ->select('price')
           ->get();
           $data['category'.$i]->put('yesterDayPrice', $yesterDayPrice);
           $data['category'.$i]->put('beforeYesterDayPrice', $yesterDayPrice2);
     
          $i++; 
        }
        $title =  "شركة كيان - الاسعار اليوميه";
        //return $categories;
        return view('web.ar.daily_price' , $categories)->with(compact('data', 'title','categories') );
       
    }
    public function ar_about()
    {
        $title =  "شركة كيان -  من نحن";
        return view('web.ar.about')->with(compact('title') );

    }
    public function ar_join_us(Request $request)
    {
        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $title =  "شركة كيان -  انضم إلينا";

        if ($request->isMethod('post')) {
                
            $data=[
                'email' =>  $request->email,
                'name' => $request->name,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'job'=>$request->job,
            ];

           // return $data['email'] ;
            Mail::send('mail',$data,function($message) use ($data){

                $message->from( $data['email'] , 'kayan');
                $message->to("info@alkayantrading.com");
                $message->subject('job');
            });
            return redirect()->back();
        }
       

        return view('web.ar.join_us')->with(compact('title') );
    }
    public function ar_contact(Request $request)
    {
        $title =  "شركة كيان - تواصل معانا";
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

        return view('web.ar.contacts')->with(compact('title') );
    }
    ////////////////// english
    public function en_index(){

        $data['services'] = Service::all();
        $data['title'] = "kayan trading company";
        $pref = Pref::find(1);
        
       // $pref = Pref::find(1);
       // return \Response::json($pref);	
        return view('web.en.index',$data)->with(compact('pref'));
    }
    public function en_services()
    {
        $data['services'] = Service::all();
        $data['title'] =  "شركة كيان - خدماتنا" ; 
        return view('web.en.services',$data);
    }
    public function en_daily_price($service = NULL)
    {
       
        $categories = DB::table('categories')->select('id','en_title')->get();
       
        $i=1;
        foreach ( $categories as  $value) {
           $data['category'.$i] = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->where('days.day' ,'=',date('Y/m/d'))
           ->select('products.id','products.en_title' ,'products.company_name','price')
           ->get();

            

           $yesterDayPrice = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
          // ->where('days.day' ,'=',date('Y/m/d',strtotime("-$numOfDay days")))
          ->where('days.day' ,'=',date('Y/m/d',strtotime("-1 days")))
           ->select('price')
           ->get();
           //$numOfDay++;

           
         // return date('Y/m/d',strtotime("-$numOfDay days"));

           $yesterDayPrice2 =DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           //->where('days.day' ,'=',date('Y/m/d',strtotime("-$numOfDay days")))
           ->where('days.day' ,'=',date('Y/m/d',strtotime("-2 days")))
           ->select('price')
           ->get();
           $data['category'.$i]->put('yesterDayPrice', $yesterDayPrice);
           $data['category'.$i]->put('beforeYesterDayPrice', $yesterDayPrice2);
            
          
          $i++; 
        }
         //return $data['category'.--$i] ;
       // return $data;
        $title =  "شركة كيان - الاسعار اليوميه";
        
        return view('web.en.daily_price' , $categories)->with(compact('data', 'title','categories') );
       
    }
    public function en_about()
    {
        $title =  "شركة كيان -  من نحن";
        return view('web.en.about')->with(compact('title') );

    }
    public function en_join_us(Request $request)
    {
        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $title =  "شركة كيان -  انضم إلينا";

        if ($request->isMethod('post')) {

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
       

        return view('web.en.join_us')->with(compact('title') );
    }
    public function en_contact(Request $request)
    {
        $title =  "شركة كيان - تواصل معانا";
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

        return view('web.en.contacts')->with(compact('title') );
    }
    function formValidation()
    {
       /* 'email' =>  $request->email,
                'name' => $request->name,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'job'=>$request->job,*/
        return array(
            'ar_title'     => 'regex:/^[\pL\s\d\-]+$/u||required|max:99|unique:products',
            'en_title'    => 'regex:/^[\pL\s\-]+$/u||required|max:99|unique:products',

        );
    }
    
}
