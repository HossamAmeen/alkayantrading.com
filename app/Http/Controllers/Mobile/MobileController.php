<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\controller;
use App\Service;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function en_index()
    {
        $services = Service::all();
        return \Response::json($services);	
    }
   
}
