<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Controllers\Controller;
use App\SearchModel;
class UploadController extends Controller
{
    public function upload(){
         $upload = new SearchModel;
         // Read the parameter values here, and then pass them to the model function
         // Naming convention for variable names, use camelCase, e.g. updateData instead of UpdateData
         $upload_data = $upload->UploadData();
        return view('home',['error' => $upload_data]);


    }

}
