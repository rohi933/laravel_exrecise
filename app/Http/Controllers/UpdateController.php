<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\SearchModel;
use Redirect;
use Illuminate\Support\Facades\Input;

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
        $update = new SearchModel;
        $update->UpdateData($email,$name,$company,$pin,$group,$username);
        return Redirect::back();
    }
}
