<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Category;
use App\Service;
use DB;
class CategoryController extends Controller
{
    
    public function index()
    {
      
        $data['categories'] = Category::all();
  
    
        $data['title'] = 'عرض الاقسام';
         return view('admin.control_panel.categories.show_categories' , $data);
    }

    public function create()
    {
        $title = 'اضافه قسم';
        return view('admin.control_panel.categories.add_category' ) ->with(compact('title') );
    }

    public function store(Request $request)
    {
        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $category = Category::create($request->all());
        $category->user_id = session('id') ;
        $category->save();
        $request->session()->flash('status', 'تم الاضافه بنجاح');
        return redirect()->route('category.index');
    }
    public function edit($id)
    {
        
        $category = Category::find($id);
        $title = 'تعديل القسم';
        if(!empty($category))
            {
                return view('admin.control_panel.categories.edit_category',$category) ->with(compact('title') );
            }
        return redirect()->route('category.index');    
    }

    public function update(Request $request, $id)
    {
        $rules = $this->EditformValidation($id);
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $category = Category::find($id);
        if(!empty($category))
            {
                $category->fill($request->all());
                $category->save();
                $request->session()->flash('status', 'تم التعديل بنجاح');
            }

        return redirect()->route('category.index');
    }
    public function destroy(Request $request, $id)
    {
        
       // return $id; 
        $category = Category::find($id);
        
        if(!empty($category))
            { 
                             
                $category->delete();
                $request->session()->flash('delete', 'تم الحذف بنجاح');
            }
            return redirect()->route('category.index');
    }
    function formValidation()
    {
       return array(
        'ar_title'     => 'required|max:99|string|unique:categories,ar_title,NULL,id,deleted_at,NULL',
        'en_title'     => 'required|max:99|string|unique:categories,en_title,NULL,id,deleted_at,NULL',
       );
    }
    function EditformValidation($id)
    {
        return array(
            'ar_title'     => "string|required|max:99|unique:categories,ar_title,$id,id,deleted_at,NULL",
            'en_title'    =>  "string|required|max:99|unique:categories,en_title,$id,id,deleted_at,NULL",


        );
    }
    function messageValidation(){
        return array(

            'ar_title.required'     => 'هذا الحقل (قسم بالعربيه) مطلوب ',
            'ar_title.unique'     => 'هذا الحقل (قسم بالعربيه) يوجد بالفعل ',
            'ar_title.*'            =>  'هذا الحقل (قسم بالعربيه) يجب يحتوي ع حروف وارقام فقط',

            'en_title.required'     => 'هذا الحقل (قسم بالانجليزي) مطلوب ',
            'en_title.unique'     => 'هذا الحقل (قسم بالانجليزي) يوجد بالفعل ',
            'en_title.*'            =>  'هذا الحقل (قسم بالانجليزي) يجب يحتوي ع حروف وارقام فقط ',
        );
    }
}
