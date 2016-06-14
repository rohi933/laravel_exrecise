<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use App\csv;
use Redirect;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{ 
    public function upload(){

        $group = Input::get('group');
        $user = Auth::user();
        if(Input::hasFile('file')){
             $file = Input::file('file');
             $file -> move('uploads', $file->getClientOriginalName());
             $myfile = fopen('uploads/' .$file->getClientOriginalName(),"r");
             $row = 1;   
             $count =0; 
             if ($myfile !== FALSE) {
              while (($data = fgetcsv($myfile, 1000, ",")) !== FALSE) {
                 $csv = new csv;
                    if (filter_var($data[0], FILTER_VALIDATE_EMAIL) ==FALSE) {

                         $err1= 'error in '.$row.' row of the table for email.';
                         return view('home',['error' => $err1]);
                         $count++;
                         continue;
                    }
                    if(preg_match("/^[1-9][0-9]{5}$/", $data[3]) == FALSE){
                        $err1 =  'error in '.$row.' row of the table for pincode.';
                        return view('home',['error' => $err1]);
                        $count++;
                        continue;
                     } 

                 $row++;
                }
              fclose($myfile);
            }
            
           $myfile1 = fopen('uploads/' .$file->getClientOriginalName(),"r"); 
           if ($myfile1 !== FALSE) {
             if($count == 0){
                    while (($data = fgetcsv($myfile1, 1000, ",")) !== FALSE) {
                         $csv = new csv;
                        $csv ->email = $data[0];
                        $csv ->name = $data[1];
                        $csv ->company= $data[2];
                         $csv ->pincode = $data[3];
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
               $success =  'Data uploaded successfully';
                        return view('home',['succ' => $success]);
            }       
            fclose($myfile1);
            
         }

        }

       
    }

}
