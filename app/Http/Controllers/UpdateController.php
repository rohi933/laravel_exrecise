<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\csv;
use Redirect;
use App\Http\Controllers\Controller;

class UpdateController  extends Controller
{
    
    public function update()
    {
        $email = Input::get('email');
        $name = Input::get('name');
        $company = Input::get('company');
        $pin = Input::get('pincode');
        $group = Input::get('groupnumber');
        $username = Input::get('username');
        $user = new csv;
        $user = $user
              ->where('email',$email)
              ->where('username',$username)
              ->update(array('name'=>$name,'company'=>$company,'pincode'=>$pin,'mygroup'=>$group));

    return Redirect::back();

    }
}
