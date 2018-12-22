<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use App\Category;
use DB;
class CategoryController extends Controller
{
    
    public function index()
    {
        $data['categories'] = DB::table('categories')
        ->join('users' , 'users.id' , '=' , 'categories.user_id')
        ->select('categories.*','users.name')
        ->get();
        
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
        $request->session()->flash('status', 'Task was successful!');
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

               // return "test";
                $category->fill($request->all());
                $category->save();
               // return $category;
            }
        $request->session()->flash('status', 'Task was successful!');
        return redirect()->route('category.index');
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        
        if(!empty($category))
            { 
                $category->delete();
                
            }
            return redirect()->route('category.index');
    }
    function formValidation()
    {
       return array(
        'ar_title'     => 'required|max:99|regex:/^[\pL\s\d\-]+$/u|unique:categories',
        'en_title'     => 'required|max:99|regex:/^[\pL\s\d\-]+$/u|unique:categories',
       );
    }
    function EditformValidation($id)
    {
        return array(
            'ar_title'     => 'regex:/^[\pL\s\d\-]+$/u|required|max:99|unique:categories,ar_title,'.$id,
            'en_title'    =>  'regex:/^[\pL\s\d\-]+$/u|required|max:99|unique:categories,en_title,'.$id,


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
