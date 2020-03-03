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
            ->select('en_title as title', 'category_id', 'img')
            ->where('services.deleted_at', '=', null)
            ->get();

        return json_encode($services, JSON_UNESCAPED_UNICODE);

    }

    public function EnCategory()
    {
        $categories['rows'] = DB::table('categories')
       
        ->where('categories.deleted_at', '=', null)
        ->get();

    return json_encode($categories, JSON_UNESCAPED_UNICODE);

    }
    public function ArCategory()
    {
        $categories['rows'] = DB::table('categories')
       
        ->where('categories.deleted_at', '=', null)
        ->get();

    return json_encode($categories, JSON_UNESCAPED_UNICODE);

    }
    public function EnShowProducts($id)
    {
        $categories['rows'] = DB::table('products')
        ->where('products.category_id', '=', $id)
        ->where('products.deleted_at', '=', null)
        ->get();
        $data['rows'] = $product::where('category_id' , $id)->with('priceProduct')->get();
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


    public function en_daily_price($id = null)
    {

        if ($id != null) {

            $category = Category::find($id);

            $data['catname'] = $category->en_title;
            $data['prices'] = DB::table('products')
                ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                ->join('days', 'price_at_days.day_id', '=', 'days.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $id)
                ->where('days.day', '=', date('Y/m/d'))
                ->select('products.en_title as title', 'products.company_name', 'price as today')
                ->get();
            $yesterDayPrice = DB::table('products')
                ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                ->join('days', 'price_at_days.day_id', '=', 'days.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $id)
                ->where('days.day', '=', date('Y/m/d', strtotime("-1 days")))
                ->select('price')
                ->first();

            $yesterDayPrice2 = DB::table('products')
                ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                ->join('days', 'price_at_days.day_id', '=', 'days.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $id)
                ->where('days.day', '=', date('Y/m/d', strtotime("-2 days")))
                ->select('price')
                ->first();
            $temp = array();
            foreach ($data['prices'] as $key => $value2) {

                $value2 = (array) $value2;
                $value2['yesterday'] = $yesterDayPrice->price;
                $value2['beforeYesterday'] = $yesterDayPrice2->price;
                $value2 = (object) $value2;

                $temp[] = $value2;
            }

            $data['prices'] = $temp;

            return $data;

        }
        if ($id == null) {

            $categories = DB::table('categories')->select('id', 'en_title')->get();

            $data = array();
            $data2 = array();

            foreach ($categories as $value) {
                $data['catname'] = $value->en_title;

                $data['prices'] = DB::table('products')
                    ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                    ->join('days', 'price_at_days.day_id', '=', 'days.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->where('categories.id', '=', $value->id)
                    ->where('days.day', '=', date('Y/m/d'))
                    ->select('products.id', 'products.en_title as title', 'products.company_name', 'price as today')
                    ->get();

                $temp = array();
                foreach ($data['prices'] as $key => $value2) {

                    $yesterDayPrice = DB::table('products')
                        ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                        ->join('days', 'price_at_days.day_id', '=', 'days.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->where('categories.id', '=', $value->id)
                        ->where('days.day', '=', date('Y/m/d', strtotime("-1 days")))
                        ->where('products.id', '=', $value2->id)
                        ->select('price')
                        ->first();
                    //dd($yesterDayPrice);

                    $yesterDayPrice2 = DB::table('products')
                        ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                        ->join('days', 'price_at_days.day_id', '=', 'days.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->where('categories.id', '=', $value->id)
                        ->where('days.day', '=', date('Y/m/d', strtotime("-2 days")))
                        ->where('products.id', '=', $value2->id)
                        ->select('price')
                        ->first();

                    $value2 = (array) $value2;
                    $value2['yesterday'] = $yesterDayPrice->price;
                    $value2['beforeYesterday'] = $yesterDayPrice2->price;
                    $temp[] = $value2;
                }

                $data['prices'] = $temp;
                $data2[] = $data;

            }
            return $data2;
            return json_encode($data2, JSON_UNESCAPED_UNICODE);
        }

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
        $services['rows'] = DB::table('services')->select('ar_title as title', 'category_id', 'img')
            ->where('services.deleted_at', '=', null)
            ->get();

        return json_encode($services, JSON_UNESCAPED_UNICODE);

    }
    public function ar_daily_price($id = null)
    {

        if ($id != null) {

            $category = Category::find($id);

            $data['catname'] = $category->ar_title;
            $data['prices'] = DB::table('products')
                ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                ->join('days', 'price_at_days.day_id', '=', 'days.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $id)
                ->where('days.day', '=', date('Y/m/d'))
                ->select('products.ar_title as title', 'products.company_name', 'price as today')
                ->get();
            $yesterDayPrice = DB::table('products')
                ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                ->join('days', 'price_at_days.day_id', '=', 'days.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $id)
                ->where('days.day', '=', date('Y/m/d', strtotime("-1 days")))
                ->select('price')
                ->first();

            $yesterDayPrice2 = DB::table('products')
                ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                ->join('days', 'price_at_days.day_id', '=', 'days.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $id)
                ->where('days.day', '=', date('Y/m/d', strtotime("-2 days")))
                ->select('price')
                ->first();
            $temp = array();
            foreach ($data['prices'] as $key => $value2) {

                $value2 = (array) $value2;
                $value2['yesterday'] = $yesterDayPrice->price;
                $value2['beforeYesterday'] = $yesterDayPrice2->price;
                $value2 = (object) $value2;

                $temp[] = $value2;
            }

            $data['prices'] = $temp;

            return $data;

        }
        if ($id == null) {

            $categories = DB::table('categories')->select('id', 'ar_title')->get();

            $data2 = array();
            $data = array();

            foreach ($categories as $value) {
                $data['catname'] = $value->ar_title;
                $data['prices'] = DB::table('products')
                    ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                    ->join('days', 'price_at_days.day_id', '=', 'days.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->where('categories.id', '=', $value->id)
                    ->where('days.day', '=', date('Y/m/d'))
                    ->select('products.ar_title as title', 'products.company_name', 'price as today')
                    ->get();

                $yesterDayPrice = DB::table('products')
                    ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                    ->join('days', 'price_at_days.day_id', '=', 'days.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->where('categories.id', '=', $value->id)
                    ->where('days.day', '=', date('Y/m/d', strtotime("-1 days")))
                    ->select('price')
                    ->first();
                //dd($yesterDayPrice);

                $yesterDayPrice2 = DB::table('products')
                    ->join('price_at_days', 'price_at_days.product_id', '=', 'products.id')
                    ->join('days', 'price_at_days.day_id', '=', 'days.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->where('categories.id', '=', $value->id)
                    ->where('days.day', '=', date('Y/m/d', strtotime("-2 days")))
                    ->select('price')
                    ->first();

                $temp = array();
                foreach ($data['prices'] as $key => $value2) {
                    //   echo $key . ' ' .  $value2->title;
                    $value2 = (array) $value2;
                    $value2['yesterday'] = $yesterDayPrice->price;
                    $value2['beforeYesterday'] = $yesterDayPrice2->price;
                    $value2 = (object) $value2;

                    $temp[] = $value2;
                }

                $data['prices'] = $temp;
                $data2[] = $data;

            }
            return $data2;
            return json_encode($data2, JSON_UNESCAPED_UNICODE);
        }
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
