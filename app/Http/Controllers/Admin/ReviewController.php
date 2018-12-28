<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Review;
class ReviewController extends Controller
{
    public function index()
    {
        $data['reviews'] = Review::all();
        $data['title'] = 'عرض التعليقات';
        return view('admin.control_panel.review.show_review',$data);
    }
    public function create()
    {
        $data['title'] = 'اضافه تعليق';
        return view('admin.control_panel.review.add_review',$data);
    }
    public function store(Request $request)
    {
        $rules = $this->formValidation();
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $review = Review::create($request->all());
        if($request->hasFile('img'))
        {
            $photo = $request->file('img');
            $imagename = time().'.'.$photo->getClientOriginalExtension();

            $destinationPath = 'resources/assets/admin/images/';
            $thumb_img = Image::make($photo->getRealPath())->resize(400, 400);
            $thumb_img->save($destinationPath.$imagename,80);
            $review->img = $destinationPath . $imagename;
        }

        $request->session()->flash('status', 'added was successfully!');
        $review->save();
        return redirect()->route('review.index');
    }
    public function edit($id)
    {
        $review = Review::find($id);
        $title = 'تعديل التعليق';

        if(!empty($review))
            return view('admin.control_panel.review.edit_review',$review)->with(compact('review', 'title') );
        else
            return redirect()->route('review.index');
    }


    public function update(Request $request, $id)
    {
        $rules = $this->EditformValidation($id);
        $message = $this->messageValidation();
        $this->validate($request, $rules,$message);
        $review = Review::find($id);
        $newPassword = true ;
        if(!empty($review))
        {
            if($request->password  == $review->password){
                $newPassword = false ;
            }
            $rules = $this->EditformValidation($id);
            $this->validate($request, $rules);
            $review->fill($request->all());

            if($newPassword){
                $review->password =  Hash::make($request->password);
            }
            if($request->hasFile('img'))
            {
                $photo = $request->file('img');
                $imagename =   time().'.'.$photo->getClientOriginalExtension();
                $destinationPath = 'resources/assets/admin/images/';
                $thumb_img = Image::make($photo->getRealPath())->resize(400, 400);
                $thumb_img->save($destinationPath.$imagename,80);
                $review->img = $destinationPath . $imagename;
            }

            $review->save();
        }
        $request->session()->flash('status', 'updated was successfully!');
        return redirect()->route('review.index');

    }


    public function destroy(Request $request, $id)
    {
        $review = Review::find($id);
        if(!empty($review)){

            $review->delete();
            $request->session()->flash('delete', 'deleted was successfully!');
        }
        return redirect()->route('review.index');
    }

    function formValidation()
    {
        return array(
            'name'     => 'regex:/^[\pL\s\d\-]+$/u|required|max:99',
            'review'    => 'required|max:99',
            'img'=> 'image',
        );
    }
    function EditformValidation($id)
    {
        return array(
            'name'     => 'regex:/^[\pL\s\d\-]+$/u|required|max:99',
            'review'    => 'required|max:99',
            'img'=> 'image',
        );
    }
    function messageValidation(){
        return array(

            'name.required'     =>  'هذا الحقل (الاسم) مطلوب ',
            'name.*'            =>  'هذا الحقل (قسم بالعربيه) يجب يحتوي ع حروف وارقام فقط',

            'review.required'     => 'هذا الحقل (التعليق) مطلوب ',

            'image'            =>  'هذا الحقل (اضافه الصورة) يجب ان يكون صورة',


        );
    }
}
