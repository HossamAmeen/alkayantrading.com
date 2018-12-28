<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use Image;
class TeamController extends Controller
{
    public function index()
    {
        $data['teams'] = Team::all();
        $data['title'] = 'عرض الاعضاء';
        return view('admin.control_panel.team.show_team',$data);
    }
    public function create()
    {
        $data['title'] = 'اضافه عضو';
        return view('admin.control_panel.team.add_team',$data);
    }
    public function store(Request $request)
    {
        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $team = Team::create($request->all());
        if($request->hasFile('img'))
        {
            $photo = $request->file('img');
            $imagename = time().'.'.$photo->getClientOriginalExtension();

            $destinationPath = 'resources/assets/admin/images/';
            $thumb_img = Image::make($photo->getRealPath())->resize(400, 400);
            $thumb_img->save($destinationPath.$imagename,80);
            $team->img = $destinationPath . $imagename;
        }
        $request->session()->flash('status', 'added was successfully!');
        $team->save();
        return redirect()->route('team.index');
    }
    public function edit($id)
    {
        $team = Team::find($id);
        $title = 'تعديل الاعضاء';

        if(!empty($team))
            return view('admin.control_panel.team.edit_team',$team)->with(compact('team', 'title') );
        else
            return redirect()->route('team.index');
    }


    public function update(Request $request, $id)
    {
        $rules = $this->EditformValidation($id);
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $team = Team::find($id);
        $newPassword = true ;
        if(!empty($team))
        {
            if($request->password  == $team->password){
                $newPassword = false ;
            }
            $rules = $this->EditformValidation($id);
            $this->validate($request, $rules);
            $team->fill($request->all());
            if($newPassword){
                $team->password =  Hash::make($request->password);
            }
            if($request->hasFile('img'))
            {
                $photo = $request->file('img');
                $imagename =   time().'.'.$photo->getClientOriginalExtension();
                $destinationPath = 'resources/assets/admin/images/';
                $thumb_img = Image::make($photo->getRealPath())->resize(400, 400);
                $thumb_img->save($destinationPath.$imagename,80);
                $team->img = $destinationPath . $imagename;
            }
            $team->save();
        }
        $request->session()->flash('status', 'updated was successfully!');
        return redirect()->route('team.index');
    }


    public function destroy(Request $request, $id)
    {
        $team = Team::find($id);
        if(!empty($team)){

            $team->delete();
            $request->session()->flash('delete', 'deleted was successfully!');
        }
        return redirect()->route('team.index');
    }

    function formValidation()
    {
        return array(
            'name'     => 'regex:/^[\pL\s\d\-]+$/u|required|max:99',
            'job'    => 'required|max:99',
            'img'=> 'image',
        );
    }
    function EditformValidation($id)
    {
        return array(
            'name'     => 'regex:/^[\pL\s\d\-]+$/u|required|max:99',
            'job'    => 'required|max:99',
            'img'=> 'image',
        );
    }
    function messageValidation(){
        return array(

            'name.required'     =>  'هذا الحقل (الاسم) مطلوب ',
            'name.*'            =>  'هذا الحقل (قسم بالعربيه) يجب يحتوي ع حروف وارقام فقط',

            'job.required'     => 'هذا الحقل (الوظيفه) مطلوب ',

            'job.*'            =>  'هذا الحقل (الوظيفه) يجب يحتوي ع حروف وارقام فقط ',

            'image'            =>  'هذا الحقل (اضافه الصورة) يجب ان يكون صورة',


        );
    }
}
