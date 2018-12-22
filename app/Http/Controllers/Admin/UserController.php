<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Image;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    public function index()
    {
        $data['users'] = User::all();
        $data['title'] = 'عرض المستخدمين';
        return view('admin.control_panel.users.show_users',$data);
    }

   
    public function create()
    {
        $data['title'] = 'اضافه مستخدم';
        return view('admin.control_panel.users.add_user',$data);
    }

    
    public function store(Request $request)
    {
        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $user = User::create($request->all());
        

        $user->password = Hash::make($request->password);

        if($request->hasFile('img'))
        {
            $photo = $request->file('img');
            $imagename = time().'.'.$photo->getClientOriginalExtension();

            $destinationPath = 'resources/assets/admin/images/';
            $thumb_img = Image::make($photo->getRealPath())->resize(100, 100);
            $thumb_img->save($destinationPath.$imagename,80);
            $user->img = $destinationPath . $imagename;
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
            return view('admin.control_panel.users.edit_user',$user)->with(compact('user', 'title') );
        else
            return redirect()->route('user.index');
    }

    
    public function update(Request $request, $id)
    {

        $rules = $this->EditformValidation($id);
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
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
               $photo = $request->file('img');
               $imagename =   time().'.'.$photo->getClientOriginalExtension();
               $destinationPath = 'resources/assets/admin/images/';
               $thumb_img = Image::make($photo->getRealPath())->resize(100, 100);
               $thumb_img->save($destinationPath.$imagename,80);
               $user->img = $destinationPath . $imagename;
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
        'name'     => 'regex:/^[\pL\s\d\-]+$/u|required|max:99',
        'email'    => 'required|max:99|email|unique:users,email',
        'password'              => 'required | confirmed ',
        'password_confirmation' => 'required ',
        'img'=> 'image',
       );
    }
    function EditformValidation($id)
    {
        return array(
            'name'     => 'regex:/^[\pL\s\d\-]+$/u|required|max:99',
			'email'    => 'required|max:99|email|unique:users,email,'.$id,
			'password' => 'confirmed',
           );
    }
    function messageValidation(){
        return array(

            'name.required'     =>  'هذا الحقل (الاسم) مطلوب ',
            'name.*'            =>  'هذا الحقل (قسم بالعربيه) يجب يحتوي ع حروف وارقام فقط',

            'email.required'     => 'هذا الحقل (البريد) مطلوب ',
            'email.unique'     => 'هذا الحقل (البرريد) يوجد بالفعل ',
            'email.*'            =>  'هذا الحقل (البريد) يجب يحتوي ع حروف وارقام فقط ',

            'password.required'     => 'هذا الحقل (كلمه السر) مطلوب ',
            'password_confirmation.required'     => 'هذا الحقل (تاكيد كلمه السر) غير مطابق ',

            'image'            =>  'هذا الحقل (اضافه الصورة) يجب ان يكون صورة',


        );
    }
}
