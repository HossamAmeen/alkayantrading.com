<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Pref;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PrefController extends Controller
{
    public function login(Request $request){
       
        if(session('login')){
            
            return redirect()->route('prefs.index');
        }
    
       // return "test";
        if($request->isMethod('post')){
           // return "tet";
          $user = User::where('name', $request->name)->first();
          
          $user= $user->makeVisible('password');
            
            if (User::where('name', $request->name)->exists()  && Hash::check($request->password , $user->password))
                  
            
               {
               // session( ['login' => 1] ) ;
                session( ['id' => $user->id] );
                session( ['role' => $user->role] );
                
                return redirect()->route('prefs.index');
                
              }
           //  return "test";
        }
        $title='تسجيل الدخول';
        return view('admin.login')->with(compact('title'));
    }
    public function index()
    {
        
     
       $mPref = Pref::find(1);
        $title='اضافه بيانات الموقع';
    
        if(empty($mPref))

            return view('admin.control_panel.prefs.add_pref')->with(compact('title'));
            else
        return redirect()->route('prefs.edit',['id' => 1]);
    }

   

    
    public function store(Request $request)
    {
       // return $request->all();
        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $pref = Pref::create($request->all());  

        $pref->user_id = session('id');
        $pref->save();
        return redirect()->route('prefs.index');
    }


    
    public function edit($id)
    {
        $pref = Pref::find($id);
        $title = ' تعديل بيانات الموقع';
        if(!empty($pref))
        return view('admin.control_panel.prefs.edit_pref',$pref)->with(compact('title'));
        else
        return redirect()->route('prefs.index');
    }

    
    public function update(Request $request, $id)
    {
      //  return "test";
     
        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $pref = Pref::find($id);
        if(!empty($pref)){
            $pref->fill($request->all());
            $pref->save();
            
        }
        return redirect()->route('prefs.index');
    }

   
    function formValidation()
    {

       return array(
        'arAddress'     => 'required|regex:/^[\pL\s\d\-]+$/u',
        'enAddress'     => 'required|regex:/^[\pL\s\d\-]+$/u',
        'enDescription' => 'required|regex:/^[\pL\s\d\-]+$/u',
        'arDescription' => 'required|regex:/^[\pL\s\d\-]+$/u',
        'phone'         => 'required|numeric',
        'mainEmail'     => 'required|email',
        'arMainAddress'   => 'required|regex:/^[\pL\s\d\-]+$/u',
        'enMainAddress'   => 'required|regex:/^[\pL\s\d\-]+$/u'
       );
    }
    function messageValidation(){
        return array(

            'arAddress.required'     => 'هذا الحقل (العنوان بالعربيه) مطلوب ',
            'arAddress.*'     => 'هذا الحقل (العنوان بالعربيه) يجيب ان يكون حروف او ارقام  ',

            'enAddress.required'     => 'هذا الحقل (العنوان بالانجليزي) مطلوب ',
            'enAddress.*'     => 'هذا الحقل (العنوان بالعربيه) يجيب ان يكون حروف او ارقام  ',

            'arDescription.required'     => 'هذا الحقل (الوصف بالعربيه) مطلوب ',
            'arDescription.*'     => 'هذا الحقل (الوصف بالعربيه) يجيب ان يكون حروف او ارقام  ',

            'enDescription.required'     => 'هذا الحقل (الوصف بالانجليزي) مطلوب ',
            'enDescription.*'     => 'هذا الحقل (الوصف بالعربيه) يجيب ان يكون حروف او ارقام  ',

            'phone.required'     => 'هذا الحقل (تلفون ) مطلوب ',
            'phone.*'     => 'هذا الحقل (تلفون) يجيب ان يكون  ارقام  ',

            'mainEmail.required'     => 'هذا الحقل (البريد) مطلوب ',
            'mainEmail.*'     => 'هذا الحقل (بريد) يجيب ان يكون بريد صحيح  ',

            'arMainAddress.required'     => 'هذا الحقل (العنوان الرئيسي بالعربيه) مطلوب ',
            'arMainAddress.*'     => 'هذا الحقل (العنوان الرئيسي بالعربيه) يجيب ان يكون حروف او ارقام  ',


            'enMainAddress.required'     => 'هذا الحقل (العنوان الرئيسي بالانجليزي) مطلوب ',
            'enMainAddress.*'     => 'هذا الحقل (العنوان الرئيسي بالانجليزي) يجيب ان يكون حروف او ارقام  ',


        );
    }
}
