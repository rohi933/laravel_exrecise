<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use App\csv;
use Auth;
use League\Csv\Reader;


class SearchModel extends Model
{
   public static function filepath(){
     $file = Input::file('file');
     $file -> move('uploads', $file->getClientOriginalName());
     return $file;
   }

    //upload Data
        public function UploadData(){
          $group = Input::get('group');
          $user = Auth::user();
          $err1='';
          if(Input::hasFile('file')){
               $file_reader = Reader::createFromPath('uploads/' .self::filepath()->getClientOriginalName());
               $results = $file_reader->fetch();
               foreach ($results as $row) {
                   $csv = new csv;
                   $csv ->email = $row[0];
                   $csv ->name = $row[1];
                   $csv ->company= $row[2];
                   $csv ->pincode = $row[3];
                   $csv ->mygroup = $group;
                   $csv ->username = $user['username'];
                   if($csv->username == "admin"){
                      $csv->usertype = "admin";
                   }
                   else if($csv->username == "mod"){
                      $csv->usertype = "mod";
                   }
                   else{
                      $csv->usertype = "normal";
                     }
               $csv->save();
             }
              $success =$success. 'Data uploaded successfully';
              return view('home',['error' => $success]);
          }

         }
      //Search
          public function SearchData($user,$email,$name,$company,$pin,$group,$username){
            $search = new csv;
            $search_result = $search;

           if($username ==null && $email ==null && $name ==null && $company == null && $pin ==null && $group ==null){
             $error = "Please fill some fields.";
             return $error;
            }

           else if ($user['username'] =="admin" || $user['username']=="mod") {
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

          //get input from update form
          public function UpdateData($email,$name,$company,$pin,$group,$username){

            $user = new csv;
            $user = $user
                  ->where('email',$email)
                  ->where('username',$username)
                  ->update(array('name'=>$name,'company'=>$company,'pincode'=>$pin,'mygroup'=>$group));
          }

}
