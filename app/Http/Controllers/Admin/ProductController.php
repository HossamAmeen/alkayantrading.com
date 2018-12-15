<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
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

        $data['title'] = 'عرض المنتجات';

        return view('admin.control_panel.products.show_products',$data);
    }

    public function create()
    {
        $data['categories'] = DB::table('categories')->select('id','en_title')->get();
        $data['title'] = 'اضافه منتج';
        return view('admin.control_panel.products.add_product',$data);
    }

    
    public function store(Request $request)
    {

        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $product = Product::create($request->all());  
        
        $product->user_id = session('id') ;
        $product->save();
        return redirect()->route('products.index');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $title = 'عرض المنتج';
        $categories = DB::table('categories')->select('id','en_title')->get();
        if(!empty($product))
        return view('admin.control_panel.products.edit_product',$product )->with(compact('product', 'title','categories') );
        else
        return redirect()->route('products.index');
    }

    
    public function update(Request $request, $id)
    {

        $rules = $this->EditformValidation($id);
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $product = Product::find($id);
        if(!empty($product)){

            $product->fill($request->all());
            
            $product->save();
            
        }
        return redirect()->route('products.index');
    }

    
    public function destroy($id)
    {
       // return "delete";
        $product = Product::find($id);
        
        if(!empty($product))
            { 
                $product->delete();
                
            }
            return redirect()->route('products.index');
    }


    function formValidation()
    {
       return array(
        'ar_title'     => 'regex:/^[\pL\s\d\-]+$/u||required|max:99|unique:products',
        'en_title'    => 'regex:/^[\pL\s\-]+$/u||required|max:99|unique:products',
       
       );
    }
    function EditformValidation($id)
    {
        return array(
            'ar_title'     => 'regex:/^[\pL\s\d\-]+$/u|required|max:99|unique:products,ar_title,'.$id,
            'en_title'    =>  'regex:/^[\pL\s\d\-]+$/u|required|max:99|unique:products,en_title,'.$id,
			
			
           );
    }

    function messageValidation(){
        return array(
            'ar_title.required'     => 'هذا الحقل (العنوان بالعربيه) مطلوب ',
            'ar_title.*'            =>  'هذا الحقل (العنوان بالعربيه) يجب يحتوي ع حروف وارقام فقط',

            'en_title.required'     => 'هذا الحقل (العنوان بالانجليزي) مطلوب ',
            'en_title.*'            =>  'هذا الحقل (العنوان بالانجليزي) يجب يحتوي ع حروف وارقام فقط ',
        );
    }

}
