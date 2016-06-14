<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\csv;
use Auth;
use Redirect;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $email = Input::get('email');
        $name = Input::get('name');
        $company = Input::get('company');
        $pin = Input::get('pin');
        $group = Input::get('group');
        $username =Input::get('username');


         $search = new csv;
         $search_result = $search;

        if($username==null && $email ==null && $name ==null && $company == null && $pin ==null && $group ==null){
            $error = "Please fill some fields.";
            return view ('home',['err' =>$error]);
        }
        else if($user['username'] =="admin" || $user['username']=="mod")
        {
            if($username !=null){
                 $search_result = $search_result-> where('username',$username);
            }
            if($email !=null){
                 $search_result = $search_result-> where('email',$email);
            }
            if($name != null){
                 $search_result = $search_result -> where('name',$name);
            }
            if($company !=null){
                 $search_result = $search_result-> where('company',$company);
            }
            if($pin !=null){
                 $search_result = $search_result -> where('pincode',$pin);
            }
            if($group !=null){
                 $search_result = $search_result-> where('mygroup',$group);

            }

            $search_result = $search_result
                             ->get();
            return view('home',['results' => $search_result]);
         }  
         else
         {
            if($email !=null){
                 $search_result = $search_result-> where('email',$email)
                                                ->where ('username',$user['username']);
            }
            if($name != null){
                 $search_result = $search_result -> where('name',$name)
                                                 ->where ('username',$user['username']);
            }
            if($company !=null){
                 $search_result = $search_result-> where('company',$company)
                                                ->where ('username',$user['username']);
            }
            if($pin !=null){
                 $search_result = $search_result -> where('pincode',$pin)
                                                 ->where ('username',$user['username']);
            }
            if($group !=null){
                 $search_result = $search_result-> where('mygroup',$group)
                                               ->where ('username',$user['username']);

            }

            $search_result = $search_result
                             ->get();
            return view('home',['results' => $search_result]);
         }


    }
}
