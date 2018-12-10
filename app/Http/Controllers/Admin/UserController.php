<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    public function index()
    {
        $data['users'] = User::all();
        $data['title'] = 'عرض المستخدمين';
        return view('control_panel.show_users',$data);
    }

   
    public function create()
    {
        $data['title'] = 'اضافه مستخدم';
        return view('control_panel.add_user',$data);
    }

    
    public function store(Request $request)
    {
        $rules = $this->formValidation();
        $this->validate($request, $rules);
        $user = User::create($request->all());
        

        $user->password = Hash::make($request->password); 
        
        if($request->hasFile('img'))
        {
           
            $destination = '../public/images/' ;
            $img     = $request->file('img');
            //$photo   = $img->getClientOriginalName(); 
            $img->move($destination,$user->id.$request->name.'.png'); 
            $user->img = '/images/'.$user->id.$request->name.'.png';
           //return  $user->img;
        }
        $user->save();
        return redirect()->route('user.index');
    }
   
    
   

    public function edit($id)
    {
        
        $user = User::find($id);
        $title = 'تعديل المستخدمين';
        $user= $user->makeVisible('password'); //// for hidden in model
        if(!empty($user))
            return view('control_panel.edit_user',$user)->with(compact('user', 'title') );
        else
            return redirect()->route('user.index');
    }

    
    public function update(Request $request, $id)
    {
        
       $user = User::find($id);
       $newPassword = true ; 
       if(!empty($user))
       {        
          
        
            if($request->password  == $user->password){
                $newPassword = false ;
            }
                $rules = $this->EditformValidation($id);
                $this->validate($request, $rules);
                $user->fill($request->all());

            if($newPassword){
                $user->password =  Hash::make($request->password); 
            }      

                if($request->hasFile('img'))
                {
                    $path =  '../public/'.$user->img;
                    if(file_exists($path)) {
                        unlink($path);
                    
                    }

                    $destination = '../public/images/' ;
                    $img       = $request->file('img');
                    $img->move($destination,$user->id.$request->name.'.png'); 
                    $user->img = '/images/'.$user->id.$request->name.'.png';
                    
            }   
                $user->save();
        }

        return redirect()->route('user.index');

    }

    
    public function destroy($id)
    {
        $user = User::find($id);
        if(!empty($user)){
           
         $user->delete();
         }
         return redirect()->route('user.index');
    }
    
    function formValidation()
    {
       return array(
        'name'     => 'alpha_num|required|max:99',
        'email'    => 'required|max:99|email|unique:users,email',
        'password'              => 'required | confirmed ',
        'password_confirmation' => 'required ',
        'img'=> 'image',
       );
    }
    function EditformValidation($id)
    {
        return array(
            'name'     => 'alpha_num|required|max:99',
			'email'    => 'required|max:99|email|unique:users,email,'.$id,
			'password' => 'confirmed',
           );
    }
}
