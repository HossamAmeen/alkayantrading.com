<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Service;
use App\User;
use DB;
use Image;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
   
    public function index()
    {
       
            
         $data['services'] =   Service::all(); 
         
        $data['title'] = 'عرض الخدمات';
        return view('admin.control_panel.services.show_services',$data);
    }
    public function create()
    {
        $data['categories'] = DB::table('categories')->where('deleted_at','=',null)->select('id','en_title')->get();
        $data['title'] = 'اضافه خدمه';
        return view('admin.control_panel.services.add_service',$data);
    }
    public function store(Request $request)
    {
        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $service = Service::create($request->all());
        if($request->hasFile('img'))
        {
           $service->img = 'resources/assets/site/images/'.$service->id.$request->en_title.'.png';
           $photo = $request->file('img');
            $imagename = time().'.'.$photo->getClientOriginalExtension();
            $destinationPath = 'resources/assets/admin/images/';
            $thumb_img = Image::make($photo->getRealPath())->resize(400, 400);
            $thumb_img->save($destinationPath.$imagename,80);
            $service->img = $destinationPath.$imagename;
        }

        $service->user_id = session('id');
        $service->save();
        $request->session()->flash('status', 'تم الاضافه بنجاح');
      return redirect()->route('service.index');
    }
    public function edit($id)
    {
        
        $service = Service::find($id);
        $title = 'عرض الخدمه';
        $categories = DB::table('categories')->select('id','en_title')->where('categories.deleted_at' , '=' , NULL)->get();
        if(!empty($service))
        return view('admin.control_panel.services.edit_service',$service )->with(compact('service', 'title','categories') );
        else
        return redirect()->route('service.index');
    }
    public function update(Request $request, $id)
    {
        
        $rules = $this->EditformValidation($id);
        $message = $this->messageValidation();
      
       // $this->validate($request, $rules,$message);
      
        $service = Service::find($id);
        $path =  $service->img ;
        $hasFile=false;
        if(!empty($service)){
            $service->fill($request->all());
            if($request->hasFile('img'))
            {
                $photo = $request->file('img');
                $imagename =   time().'.'.$photo->getClientOriginalExtension();
                $destinationPath = 'resources/assets/admin/images/';
                $thumb_img = Image::make($photo->getRealPath())->resize(400, 400);
                $thumb_img->save($destinationPath.$imagename);
                 $service->img = $destinationPath.$imagename;
                 $hasFile=true;
            }   
            $service->save();
        }
        if($hasFile) {
            
             unlink($path);
         }
        $request->session()->flash('status', 'تم التعديل بنجاح');
        return redirect()->route('service.index');
    }
    public function destroy(Request $request, $id)
    {
        $service = Service::find($id);
        if(!empty($service))
            { 
                $service->delete();
                $request->session()->flash('delete', 'تم الحذف بنجاح');
            }

        return redirect()->route('service.index');
    }
    function formValidation()
    {
       return array(
        'ar_title'     => 'required|max:99|unique:services,ar_title,NULL,id,deleted_at,NULL|regex:/^[\pL\s\d\-]+$/u',
        'en_title'    => 'required|max:99|unique:services,en_title,NULL,id,deleted_at,NULL|regex:/^[\pL\s\d\-]+$/u',
        'img'=> 'image',
       );
    }
    function EditformValidation($id)
    {
        return array(
            'ar_title'     => "required|max:99|regex:/^[\pL\s\d\-]+$/u|unique:services,ar_title,deleted_at,$id,id,deleted_at,NULL",
            'en_title'    =>  "required|max:99|regex:/^[\pL\s\d\-]+$/u|unique:services,en_title,deleted_at,$id,id,deleted_at,NULL",
            'img'=> 'image',			
           );
    }
    function messageValidation(){
        return array(

            'ar_title.required'     => 'هذا الحقل (العنوان بالعربيه) مطلوب ',
            'ar_title.unique'     => 'هذا الحقل (العنوان بالعربيه) يوجد بالفعل ',
            'ar_title.*'            =>  'هذا الحقل (العنوان بالعربيه) يجب يحتوي ع حروف وارقام فقط',

            'en_title.required'     => 'هذا الحقل (العنوان بالانجليزي) مطلوب ',
            'en_title.unique'     => 'هذا الحقل (العنوان بالانجليزي) يوجد بالفعل ',
            'en_title.*'            =>  'هذا الحقل (العنوان بالانجليزي) يجب يحتوي ع حروف وارقام فقط ',

            'image'            =>  'هذا الحقل (اضافه الصورة) يجب ان يكون صورة',
        );
    }
}
