<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\SearchModel;
use Auth;
use Illuminate\Support\Facades\Input;
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
        $A = new SearchModel;
        $error = $A->SearchData($user,$email,$name,$company,$pin,$group,$username);
        return view ('home', ['err' =>$error]);
    }
}
