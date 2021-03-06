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
      
        $data['products'] = Product::all();
       
        $data['title'] = 'عرض المنتجات';

        return view('admin.control_panel.products.show_products',$data);
    }

    public function create()
    {
        $data['categories'] = DB::table('categories')->where('deleted_at','=',null)->get();
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
        $request->session()->flash('status', 'تم الاضافه بنجاح');

        return redirect()->route('products.index');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $title = 'عرض المنتج';
        $categories = DB::table('categories')->select('id','en_title')->where('categories.deleted_at' , '=' , NULL)->get();
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
            $product->user_id = session('id') ;
            $product->save();
            $product->save();
            
        }
        $request->session()->flash('status', 'تم التعديل بنجاح');
        return redirect()->route('products.index');
    }

    
    public function destroy(Request $request,$id)
    {
       // return "delete";
        $product = Product::find($id);
        
        if(!empty($product))
            { 
                $product->delete();
                $request->session()->flash('delete', 'تم الحذف بنجاح');
            }
            return redirect()->route('products.index');
    }


    function formValidation()
    {
       return array(
        'ar_title'     => 'required|max:99|unique:products,ar_title,NULL,id,deleted_at,NULL',
        'en_title'    => 'required|max:99|unique:products,en_title,NULL,id,deleted_at,NULL',
        'company_name'    => 'required|max:99',
       
       );
    }
    function EditformValidation($id)
    {
        return array(
            'ar_title'     => "string|required|max:99|unique:products,ar_title,$id,id,deleted_at,NULL",
            'en_title'    =>  "string|required|max:99|unique:products,en_title,$id,id,deleted_at,NULL",
            'company_name'    => 'required|max:99',
			
           );
    }

    function messageValidation(){
        return array(
            'ar_title.required'     => 'هذا الحقل (العنوان بالعربيه) مطلوب ',
            'ar_title.*'            =>  'هذا الحقل (العنوان بالعربيه) يجب يحتوي ع حروف وارقام فقط',

            'en_title.required'     => 'هذا الحقل (العنوان بالانجليزي) مطلوب ',
            'en_title.*'            =>  'هذا الحقل (العنوان بالانجليزي) يجب يحتوي ع حروف وارقام فقط ',

            'company_name.required'     => 'هذا الحقل (الشركه) مطلوب ',
            'company_name.*'            =>  'هذا الحقل (الشركه) يجب يحتوي ع حروف وارقام فقط',
        );
    }

}
