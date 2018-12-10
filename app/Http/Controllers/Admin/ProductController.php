<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use App\Product;
use DB;
class ProductController extends Controller
{
    
    public function index()
    {
      
        $data['products'] = DB::table('products')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'users.name','categories.en_title as cat_en_title')
            ->get();
        // return $data['services'];
        $data['title'] = 'عرض المنتجات';
        return view('control_panel.show_products',$data);
    }

    public function create()
    {
        $data['categories'] = DB::table('categories')->select('id','en_title')->get();
        $data['title'] = 'اضافه منتج';
        return view('control_panel.add_product',$data);
    }

    
    public function store(Request $request)
    {
       
        $rules = $this->formValidation();
        $this->validate($request, $rules);
        $product = Product::create($request->all());  
        
        $product->user_id = session('id') ;
        $product->save();
        return redirect()->route('product.index');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $title = 'عرض المنتج';
        $categories = DB::table('categories')->select('id','en_title')->get();
        if(!empty($product))
        return view('control_panel.edit_product',$product )->with(compact('product', 'title','categories') );
        else
        return redirect()->route('product.index');
    }

    
    public function update(Request $request, $id)
    {
       // return $request->all();
        $rules = $this->EditformValidation($id);
        $this->validate($request, $rules);
        $product = Product::find($id);
        if(!empty($product)){

            $product->fill($request->all());
            
            $product->save();
            
        }
        return redirect()->route('product.index');
    }

    
    public function destroy($id)
    {
       // return "delete";
        $product = Product::find($id);
        
        if(!empty($product))
            { 
                $product->delete();
                
            }
            return redirect()->route('product.index');
    }


    function formValidation()
    {
       return array(
        'ar_title'     => 'alpha_num|required|max:99|unique:products',
        'en_title'    => 'alpha_num|required|max:99|unique:products',
       
       );
    }
    function EditformValidation($id)
    {
        return array(
            'ar_title'     => 'alpha_num|required|max:99|unique:products,ar_title,'.$id,
            'en_title'    =>  'alpha_num|required|max:99|unique:products,en_title,'.$id,
			
			
           );
    }
}
