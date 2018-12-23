<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ExelController extends Controller
{
    public  function  exportExcel(){

        return Excel::download(new UsersExport, 'users.xlsx');




    }

    public function import(Request $request)
    {
        if($request->isMethod('post'))
        Excel::import(new UsersImport, $request->file('excel'));
        else
            return view('upload');
        return "test";
    }
}
