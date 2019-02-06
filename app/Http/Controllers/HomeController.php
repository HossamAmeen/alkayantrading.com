<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Route;
use URL;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Service;
use App\Pref;
use App\Product;
use App\Days;
use App\Review;
use App\Team;
use DB;
use Mail;

class HomeController extends Controller
{
    public  function  change_language($lang){

       $prefUrl = url()->previous() ; 
        if($lang == "en")

            $rout =   str_replace("ar","en",url()->previous());

        else
            $rout =   str_replace("en","ar",url()->previous());

        //return $rout;
        if( $rout == url()->previous()){
            $rout = $rout . $lang;
            //return $rout;
        }
        return redirect($rout);
    }
    public function ar_index()
    {

        $data['services'] = Service::all();
        $data['reviews'] =  Review::all();
        $data['title'] = "kayan trading company";
        return view('web.ar.index',$data);
    }

    public function ar_services()
    {
        $data['services'] = Service::all();
        $data['title'] =  "شركة كيان - خدماتنا" ; 
        return view('web.ar.services',$data);
    }
    public function ar_daily_price($id = null)
    {
       
        $categories = DB::table('categories')->select('id','ar_title')->get();
        
       
         
        $data = array();
        $data2 = array();
        
        foreach ( $categories as  $value)
         {
           $data['catname'] = $value->ar_title;

           $data['prices'] = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->where('days.day' ,'=',date('Y/m/d'))
           ->select('products.id','products.ar_title as title' ,'products.company_name','price as today')
           ->get();
           
                  $temp = array();
            foreach ($data['prices'] as $key => $value2) {
                $yesterDayPrice = DB::table('products')
               ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
               ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
               ->join('categories' , 'products.category_id' ,'=','categories.id' )
               ->where('categories.id','=',$value->id)
               ->where('days.day' ,'=',date('Y/m/d',strtotime("-1 days")))
               ->where('products.id','=',$value2->id)
               ->select('price')
               ->first();
                //dd($yesterDayPrice);
               
               $yesterDayPrice2 =DB::table('products')
               ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
               ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
               ->join('categories' , 'products.category_id' ,'=','categories.id' )
               ->where('categories.id','=',$value->id)
               ->where('days.day' ,'=',date('Y/m/d',strtotime("-2 days")))
               ->where('products.id','=',$value2->id)
               ->select('price')
               ->first();

             $value2 =   (array) $value2 ;
             if($yesterDayPrice !== null)
             $value2['yesterday']=  $yesterDayPrice->price ;
             if($yesterDayPrice2 !== null)
             $value2['beforeYesterday']= $yesterDayPrice2->price ;
             $temp[] = $value2;
            }
      
           $data['prices'] = $temp;
           $data2[] = $data;
   
        
          
         
        }
        $title =  "شركة كيان - الاسعار اليوميه";
      // return $data2;
        return view('web.ar.daily_price' , $categories)->with(compact('data2', 'title','categories' ,  'id') );
       
    }
    public function ar_about()
    {
        $title =  "شركة كيان -  من نحن";
        $data['teams'] = Team::all();
        return view('web.ar.about' , $data)->with(compact('title') );

    }
    public function ar_join_us(Request $request)
    {

        $title =  "شركة كيان -  انضم إلينا";

        if ($request->isMethod('post')) {
            $rules = $this->jobFormValidation();
            $message = $this->jobMessageValidation();
            $this->validate($request, $rules,$message);
            $data=[
                'email' =>  $request->email,
                'name' => $request->name,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'job'=>$request->job,
            ];

           // return $data['email'] ;
            //$pref = Pref::find(1);
            Mail::send('web.job_mail',$data,function($message) use ($data){
                $pref = Pref::find(1);
                $message->from( $data['email'] , 'kayan');
                $message->to($pref['mainEmail']);
                $message->subject("job");

            });
            $request->session()->flash('status', 'send mail  was successful!');
            return redirect()->back();
        }
       

        return view('web.ar.join_us')->with(compact('title') );
    }
    public function ar_contact(Request $request)
    {

        $title =  "شركة كيان - تواصل معانا";
            Log::info('start sending message');
        if ($request->isMethod('post')) {
            $rules = $this->contactFormValidation();
            $message = $this->contactMessageValidation();
            $this->validate($request, $rules,$message);
            // $data=[
            //     'email' =>  $request->email,
            //     'name' => $request->name,
            //     'phone'=>$request->phone,
            //     'text'=>$request->text,
            // ];
            
            $title  = $request->name;
            $text  = $request->text;
            $phone  = $request->phone;
            $subject  = "contact";
            $email = $request->email;
            Log::info($request->all());
            Mail::send(['html' => 'web.contact_mail'], ['text' => $text], function ($message) use ($email, $title, $subject,$phone,$text) {
                $message->from('contact@alkayantrading.com', $title);

                $message->to('abdelrahman.elzedy@gmail.com')->subject($subject);
            });

            // Mail::send('web.contact_mail',$data,function($message) use ($data){
            //     $pref = Pref::find(1);

            //     $message->from( $data['email'] , 'kayan');
            //     $message->to($pref['mainEmail']);
            //     $message->subject('contact');
            // });
            $request->session()->flash('status', 'send mail  was successful!');
            return redirect()->back();
        }

        return view('web.ar.contacts')->with(compact('title') );
    }
    ////////////////// english
    public function en_index(){

        $data['services'] = Service::all();
        $data['reviews'] =  Review::all();
        $data['title'] = "kayan trading company";

        
       // $pref = Pref::find(1);
       // return \Response::json($pref);	
        return view('web.en.index',$data);
    }
    public function en_services()
    {
       
        $data['services'] = Service::all();
        $data['title'] =  "شركة كيان - خدماتنا" ; 
        return view('web.en.services',$data);
    }
    public function en_daily_price($id = NULL)
    {
       
        
        $categories = DB::table('categories')->select('id','en_title')->get();
        
       
         
        $data = array();
        $data2 = array();
        
        foreach ( $categories as  $value)
         {
           $data['catname'] = $value->en_title;

           $data['prices'] = DB::table('products')
           ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
           ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
           ->join('categories' , 'products.category_id' ,'=','categories.id' )
           ->where('categories.id','=',$value->id)
           ->where('days.day' ,'=',date('Y/m/d'))
           ->select('products.id','products.en_title as title' ,'products.company_name','price as today')
           ->get();
           
                  $temp = array();
            foreach ($data['prices'] as $key => $value2) {
                $yesterDayPrice = DB::table('products')
               ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
               ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
               ->join('categories' , 'products.category_id' ,'=','categories.id' )
               ->where('categories.id','=',$value->id)
               ->where('days.day' ,'=',date('Y/m/d',strtotime("-1 days")))
               ->where('products.id','=',$value2->id)
               ->select('price')
               ->first();
                //dd($yesterDayPrice);
               
               $yesterDayPrice2 =DB::table('products')
               ->join('price_at_days' , 'price_at_days.product_id' ,'=' , 'products.id')
               ->join('days' , 'price_at_days.day_id' ,'=' , 'days.id')
               ->join('categories' , 'products.category_id' ,'=','categories.id' )
               ->where('categories.id','=',$value->id)
               ->where('days.day' ,'=',date('Y/m/d',strtotime("-2 days")))
               ->where('products.id','=',$value2->id)
               ->select('price')
               ->first();

             $value2 =   (array) $value2 ;
             if($yesterDayPrice !== null)
             $value2['yesterday']=  $yesterDayPrice->price ;
             if($yesterDayPrice2 !== null)
             $value2['beforeYesterday']= $yesterDayPrice2->price ;
             $temp[] = $value2;
            }
      
           $data['prices'] = $temp;
           $data2[] = $data;
   
        
          
         
        }
        $title =  "شركة كيان - الاسعار اليوميه";
      // return $data2;
        return view('web.en.daily_price' , $categories)->with(compact('data2', 'title','categories' ,  'id') );
       
       
    }
    
    public function en_about()
    {
        $title =  "شركة كيان -  من نحن";
        $data['teams'] = Team::all();
        return view('web.en.about' , $data)->with(compact('title') );

    }
    public function en_join_us(Request $request)
    {

        $title =  "شركة كيان -  انضم إلينا";

        if ($request->isMethod('post')) {
            $rules = $this->jobFormValidation();
            $message = $this->jobMessageValidation();
            $this->validate($request, $rules,$message);
            $data=[
                'email' =>  $request->email,
                'name' => $request->name,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'job'=>$request->job,
            ];

           // return $data['email'] ;
            //$pref = Pref::find(1);
            Mail::send('web.job_mail',$data,function($message) use ($data){
                $pref = Pref::find(1);
                $message->from( $data['email'] , 'kayan');
                $message->to($pref['mainEmail']);
                $message->subject("job");

            });
            $request->session()->flash('status', 'send mail  was successful!');
            return redirect()->back();
        }
       

        return view('web.en.join_us')->with(compact('title') );
    }
    public function en_contact(Request $request)
    {

        $title =  "شركة كيان - تواصل معانا";

        if ($request->isMethod('post')) {
            $rules = $this->contactFormValidation();
            $message = $this->contactMessageValidation();
            $this->validate($request, $rules,$message);
            $data=[
                'email' =>  $request->email,
                'Name' => $request->Name,
                'phone'=>$request->phone,
                'message'=>$request->message,
            ];
            Mail::send('web.contact_mail',$data,function($message) use ($data){
                $pref = Pref::find(1);
                $message->from( $data['email'] , 'kayan');
                $message->to($pref['mainEmail']);
                $message->subject('contact');
            });
            $request->session()->flash('status', 'send mail  was successful!');
            return redirect()->back();
        }

        return view('web.en.contacts')->with(compact('title') );
    }
    function jobFormValidation()
    {

        return array(
            'name'     => 'required|regex:/^[\pL\s\d\-]+$/u||max:99',
            'address'    => 'required|regex:/^[\pL\s\-]+$/u||max:99',
             'email' => 'required|email',
            'phone'         => 'required|numeric|min:1000000000',
            'job'    => 'required|regex:/^[\pL\s\-]+$/u||max:99',

        );
    }
    function jobMessageValidation(){
        return array(
            'name.required'     => 'هذا الحقل (الاسم) مطلوب ',
            'name.*'            =>  'هذا الحقل (الاسم) يجب يحتوي ع حروف وارقام فقط',

            'address.required'     => 'هذا الحقل (العنوان) مطلوب ',
            'address.*'            =>  'هذا الحقل (العنوان) يجب يحتوي ع حروف وارقام فقط',

            'email.required'     => 'هذا الحقل (البريد) مطلوب ',
            'email.*'            =>  'هذا الحقل (البريد)يجب ان يكون بريد صحيح',

            'phone.required'     => 'هذا الحقل (التلفون) مطلوب ',
            'phone.min'          => 'هذا الحقل (التلفون) يجب الا يقل عن 11 رقم ',
            'phone.*'            =>  'هذا الحقل (التلفون) يجب يحتوي ع ارقام فقط',

            'job.required'     => 'هذا الحقل (العمل) مطلوب ',
            'job.*'            =>  'هذا الحقل (العمل) يجب يحتوي ع حروف وارقام فقط',


        );
    }
    function contactFormValidation()
    {



        return array(
            'name'     => 'regex:/^[\pL\s\d\-]+$/u||required|max:99',

            'email' => 'required|email',
            'phone'         => 'required|numeric|min:1000000000',
            'text'    => 'regex:/^[\pL\s\-]+$/u||required|max:99',

        );
    }
    function contactMessageValidation(){
        return array(
            'name.required'     => 'هذا الحقل (الاسم) مطلوب ',
            'name.*'            =>  'هذا الحقل (الاسم) يجب يحتوي ع حروف وارقام فقط',

            'text.required'     => 'هذا الحقل (الرساله) مطلوب ',
            'text.*'            =>  'هذا الحقل (الرساله) يجب يحتوي ع حروف وارقام فقط',

            'email.required'     => 'هذا الحقل (البريد) مطلوب ',
            'email.*'            =>  'هذا الحقل (البريد)يجب ان يكون بريد صحيح',

            'phone.required'     => 'هذا الحقل (التلفون) مطلوب ',
            'phone.min'          => 'هذا الحقل (التلفون) يجب الا يقل عن 11 رقم ',
            'phone.*'            =>  'هذا الحقل (التلفون) يجب يحتوي ع ارقام فقط',


        );
    }

//     public function post_contact(Requests $request){

//         $this->validate($request, $this->get_contact_form_validation_rules(), $this->get_contact_form_validation_messages());
//         $title  = Input::get('name');
//         $text  = Input::get('msg');
//         $subject  = Input::get('subject');
//         $email = Input::get('email');

//         Mail::send(['html' => 'emails.contact'], ['text' => $text], function ($message) use ($email, $title, $subject) {
//             $message->from($email, $title);

//             $message->to('info@elmasria.co')->subject($subject);
//         });
// //        return Redirect('/');

//     }//end post contact

//     private function get_contact_form_validation_messages() {
//         return array(
//             'title.required'                => "رجاء إدخال الاسم",
//         );
//     }//end get validation messages

//     private function get_contact_form_validation_rules()
//     {
//         return array(
//             'title' => 'required',
//             'msg' => 'required',
//             'email' => 'required',
//             'subject' => 'required',
//         );
//     }

//     public function api_contact(Requests $request){

//         $token = Input::get('token');
//         if ($token !== APIHelper::TOKEN) {
//             $data['error'] = "true";
//             echo json_encode($data);
//             return;
//         }

//         $this->validate($request, $this->get_contact_form_validation_rules(), $this->get_contact_form_validation_messages());
//         $title  = Input::get('title');
//         $text  = Input::get('msg');
//         $subject  = Input::get('subject');
//         $email = Input::get('email');

//         Mail::send(['html' => 'emails.contact'], ['text' => $text], function ($message) use ($email, $title, $subject) {
//             $message->from($email, $title);

//             $message->to('info@elmasria.co')->subject($subject);
//         });

//         $data['error'] = "false";
//         echo json_encode($data);
//         return;


// //        return Redirect('/');

//     }//end post contact
    
}
