<?php

namespace App\Http\Controllers\Mobile;

use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use App\Pref;
use DB;
use Illuminate\Http\Request;

class MobileController extends Controller
{

    public function en_services()
    {
        $services['rows'] = DB::table('services')
           
            ->where('services.deleted_at', '=', null)
            ->get();

        return json_encode($services, JSON_UNESCAPED_UNICODE);

    }

    public function EnCategory()
    {
      
        $categories['rows'] = Category::with(['products','products.priceProduct'])->get();
       
    return json_encode($categories, JSON_UNESCAPED_UNICODE);

    }
    public function ArCategory()
    {
       
        $categories['rows'] = Category::with(['products','products.priceProduct'])->get();
    return json_encode($categories, JSON_UNESCAPED_UNICODE);

    }
    public function EnShowProducts($id)
    {
        $categories['rows'] = DB::table('products')
        ->where('products.category_id', '=', $id)
        ->where('products.deleted_at', '=', null)
        ->get();
        $data['rows'] = Product::where('category_id' , $id)->with('priceProduct')->get();
    return json_encode($data, JSON_UNESCAPED_UNICODE);

    }


    public function ArShowProducts($id)
    {
        $categories['rows'] = DB::table('products')
        ->where('products.category_id', '=', $id)
        ->where('products.deleted_at', '=', null)
        ->get();
// return "test";
        $data['products'] = Product::where('category_id' , $id)->with('priceProduct')->get();
        return json_encode($data, JSON_UNESCAPED_UNICODE);

    }



    public function en_about()
    {
        $pref['rows'] = DB::table('prefs')->select('enAddress as address', 'enDescription as description', 'phone'
            , 'enMainAddress as mainAddress',
            'mainEmail', 'facebook', 'twitter', 'instgram', 'linkedin')
            ->get();
        return json_encode($pref, JSON_UNESCAPED_UNICODE);

    }
    public function ar_services()
    {
        $services['rows'] = DB::table('services')
       
            ->where('services.deleted_at', '=', null)
            ->get();

        return json_encode($services, JSON_UNESCAPED_UNICODE);

    }
    
    public function ar_about()
    {
        $pref['rows'] = DB::table('prefs')->select('arAddress as address', 'arDescription as description', 'phone'
            , 'arMainAddress as mainAddress',
            'mainEmail', 'facebook', 'twitter', 'instgram', 'linkedin', 'whatsapp')

            ->get();
        return json_encode($pref, JSON_UNESCAPED_UNICODE);

    }
    public function join_us(Request $request)
    {

        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'job' => $request->job,
        ];
        Mail::send('mail', $data, function ($message) use ($data) {
            $message->from($pref->mainEmail, 'kayan');
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
            $data = [
                'email' => $request->email,
                'Name' => $request->Name,
                'phone' => $request->phone,
                'text' => $request->text,
            ];
            Mail::send('mail', $data, function ($message) use ($data) {
                $message->from($pref->mainEmail, 'kayan');
                $message->to($data['email']);
                $message->subject('contact');
            });
            return redirect()->back();
        }

    }
}

class DataClass
{
    public $protype = "test";
}
