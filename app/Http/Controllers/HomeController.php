<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Route;
use URL;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Service;
use App\Pref;
use App\Product;
use App\Category;
use App\Review;
use App\Team;
use App\Day;
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
       
        $categories = Category::all();
    //     $data = array();
    //    foreach($categories as $category)
    //    {
    //        $data2['category'] = $category->ar_title ; 
    //        $data2['products'] = $category->products ;
    //        $data[] = $data2; 
    //    }
    //    foreach($data as $item)
    //    {
    //     foreach($item['products'] as $item1)
    //     {
    //         return $item1;
    //     }
          
    //    }
    //    return $data; 
        $title =  "شركة كيان - الاسعار اليوميه";
      // return $data2;
        return view('web.ar.daily_price' ,compact('title','categories') );
       
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
       
        
        $categories = Category::all();
        
        $title =  "شركة كيان - الاسعار اليوميه";
      // return $data2;
        return view('web.en.daily_price' , compact('title','categories') );
       
       
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
            'name'     => 'required|string||max:99',
            'address'    => 'required||max:99',
             'email' => 'required|email',
            'phone'         => 'required|numeric|min:1000000000',
            'job'    => 'required||max:99',

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
            'name'     => 'string||required|max:99',

            'email' => 'required|email',
            'phone'         => 'required|numeric|min:1000000000',
            'text'    => '|required|max:99',

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
