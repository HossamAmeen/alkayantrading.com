<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Pref;
use App\user;
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
          $user = User::where('email', $request->email)->first();
          
          $user= $user->makeVisible('password');
            
            if (User::where('email', $request->email)->exists()  && Hash::check($request->password , $user->password))
                  
            
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

            return view('admin.control_panel.prefs.edit_pref')->with(compact('title'));
            else
        return redirect()->route('prefs.edit',['id' => 1]);
    }

   

    
    public function store(Request $request)
    {
       // return $request->all();
        $rules = $this->formValidation();
        $this->validate($request, $rules);
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
        $this->validate($request, $rules);
        //return $request->all();
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
        'arAddress'     => 'required|regex:/^[\pL\s\-]+$/u',
        'enAddress'     => 'required|regex:/^[\pL\s\-]+$/u',
        'enDescription' => 'required|regex:/^[\pL\s\-]+$/u',
        'arDescription' => 'required|regex:/^[\pL\s\-]+$/u',
        'phone'         => 'required|numeric',
        'mainEmail'   => 'required|email',
        'arMainAddress'   => 'required|regex:/^[\pL\s\-]+$/u',
        'enMainAddress'   => 'required|regex:/^[\pL\s\-]+$/u'
       );
    }
}
