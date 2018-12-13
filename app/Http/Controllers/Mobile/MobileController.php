<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use App\Service;
use App\Pref;
use Illuminate\Http\Request;




class MobileController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return \Response::json($services);	
    }

    public function services()
    {
        $services = Service::all();
        return \Response::json($services);

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



        return view('web.en.daily_price' , $categories)->with(compact('data','categories') );

    }
    public function about()
    {
        $pref = Pref::all();
        return \Response::json($pref);

    }
    public function en_join_us(Request $request)
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
    public function en_contact(Request $request)
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
