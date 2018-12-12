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
        $this->validate($request, $rules);
        $category = Category::create($request->all());
        $category->user_id = session('id') ;
        $category->save();
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
        $category = Category::find($id);
        
        if(!empty($category))
            {
                $category->fill($request->all());
            }
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
        'ar_title'     => 'alpha_num|required|max:99|unique:categories',
        'en_title'    => 'alpha_num|required|max:99|unique:categories',
       );
    }
}
