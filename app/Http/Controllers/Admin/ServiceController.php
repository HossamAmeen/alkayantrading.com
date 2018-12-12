<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Service;
use App\User;
use DB;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
   
    public function index()
    {
      
        $data['services'] = DB::table('services')
            ->join('users', 'users.id', '=', 'services.user_id')
            ->leftJoin('categories', 'categories.id', '=', 'services.category_id')
            ->select('services.*', 'users.name','categories.en_title as cat_en_title')
            ->get();
        $data['title'] = 'عرض الخدمات';
        return view('admin.control_panel.services.show_services',$data);
    }

   
    public function create()
    {
        $data['categories'] = DB::table('categories')->select('id','en_title')->get();
        $data['title'] = 'اضافه خدمه';
        return view('admin.control_panel.services.add_service',$data);
    }

    
    public function store(Request $request)
    {
       
        $rules = $this->formValidation();
        $this->validate($request, $rules);
        $service = Service::create($request->all());  
        if($request->hasFile('img'))
        {
           
            $destination = '../public/images/' ;
            $img     = $request->file('img');
            $img->move($destination,$service->id.$request->en_title.'.png'); 
            $service->img = '/images/'.$service->id.$request->en_title.'.png';
        
        }
        $service->user_id = session('id');
        $service->save();
        return redirect()->route('service.index');
    }
    public function edit($id)
    {
        
        $service = Service::find($id);
        $title = 'عرض الخدمه';
        $categories = DB::table('categories')->select('id','en_title')->get();
        if(!empty($service))
        return view('admin.control_panel.services.edit_service',$service )->with(compact('service', 'title','categories') );
        else
        return redirect()->route('Service.index');
    }

    
    public function update(Request $request, $id)
    {
        
        $rules = $this->EditformValidation($id);
        $this->validate($request, $rules);
        $service = Service::find($id);
        if(!empty($service)){

            $service->fill($request->all());
            if($request->hasFile('img'))
            {
                $path =  '../public/'.$service->img;
                if(file_exists($path)) {
                    unlink($path);
                   
                }

                $destination = '../public/images/' ;
                $img       = $request->file('img');
                $img->move($destination,$service->id.$request->name.'.png'); 
                $service->img = '/images/'.$service->id.$request->name.'.png';
                
            }   
            $service->save();
            
        }
        return redirect()->route('service.index');
    }

    
    public function destroy($id)
    {
      
        $service = Service::find($id);
        
        if(!empty($service))
            { 
                $service->delete();
                
            }
            return redirect()->route('service.index');
    }


    function formValidation()
    {
       return array(
        'ar_title'     => 'required|max:99|unique:services|regex:/^[\pL\s\-]+$/u',
        'en_title'    => 'required|max:99|unique:services|regex:/^[\pL\s\-]+$/u',
        
        'img'=> 'image',
       );
    }
    function EditformValidation($id)
    {
        return array(
            'ar_title'     => 'required|max:99|regex:/^[\pL\s\-]+$/u|unique:services,ar_title,'.$id,
            'en_title'    => 'required|max:99|regex:/^[\pL\s\-]+$/u|unique:services,en_title,'.$id,
            'img'=> 'image',			
           );
    }
}
