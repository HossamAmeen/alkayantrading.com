<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel ;
class ExelController extends Controller
{
    public  function  exportExcel(){

    Excel::create('clients' ,  function ($excel){
        $excel->sheet('clients' , function ($sheet){
            $sheet->loadView('exportExcel');
        });

    })->export('xlsx');



    }

    public  function  importExcel(Request $request){

        if($request->isMethod('post')){


            $photo = $request->file('excel');
            $imagename = time().'.'.$photo->getClientOriginalName();
            $photo->move("files" , $imagename);

            return $imagename;
        }
        return view('upload');
    }
}
