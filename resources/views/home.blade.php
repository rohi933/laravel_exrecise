@extends('layouts.app')
@section('content')
<style>
input{
  border-radius: 5px;
  border:1px solid #ddd;
}
#file{
    border:none;
}
table{
    width:100%;
    text-align: center;
}

</style>


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    
                   
                    <form action="{{URL :: to('upload' )}}" method="POST" enctype="multipart/form-data">
                    
                    <p>Your Group: <input type="text" name="group"><br /></p>
                    
                    <p>Select your file::</p>
                    <input type ="file" name="file" id="file" ></br>
                    <p><input type="submit" value="Submit" name="Submit" ></p>
                    <input type ="hidden" value = "{{ csrf_token() }}" name = "_token" >
                    </form> 

                </div>
            </div>


        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Data Query</div>

                <div class="panel-body">
                    
                   
                    <form action="{{url('/search')}}" enctype="multipart/form-data">
                    <?php 
                  //  use Auth;
                    $user = Auth::user();
                    if($user['username'] == "admin" || $user['username'] == "mod")
                    { ?>
                        <p>Username:</br><input type ="text" name="username" id="user" > </p>
                   <?php } 

                        else {
                            ?>
                        <p></br><input type ="hidden" name="username" id="user" > </p>

                        <?php } ?>                   



                    
                     <p>   Email: </br><input type ="email" name="email" id="email" > </p>
            
                      <p>  Name: </br><input type ="text" name="name" id="name" > </p>
                
                      <p>  Company: </br><input type ="text" name="company" id="company" > </p>
                    
                     <p>   Pin Code: </br><input type ="text" name="pin" id="pin" > </p>
                     <p>   Your Group:</br> <input type ="text" name="group" id="group" > </p>
                     
                        <input type="submit" value="Submit" name="Submit" >
                    

                    </form> 

                </div>
            </div>

            
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Results</div>

                <div class="panel-body">
                 @if(isset($error)) <div id="color"><?php echo $error ?></div> @endif 
                     @if(isset($succ))<div id="color"> <?php echo $succ ?></div>@endif 
                    @if(isset($err))<div id="color"><?php echo $err ?></div> @endif       
                     @if(isset($results) && count($results)>0)
                 <?php
                 foreach($results as $res)
                 { ?>
            <table><tr>
         <form action="update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <?php
     $user = Auth::user(); 
    if($user['username']=="admin"){ ?>
        <td>
        <?php 
         $user = Auth::user();
                    if($user['username'] == "admin" || $user['username'] == "mod")
                    { ?>
                        <input type ="text" name="username" id="username" value = <?php echo $res['username'];?> readonly>
                   <?php } 

                        else {
                            ?>
                       <input type ="hidden" name="username" id="username" value = <?php echo $res['username'];?>>

                        <?php } ?>  
         </td>
   
   <td><input id="username" type="email" name="email" value=<?php echo $res['email'];?> readonly></td>
    <td><input type="text" name="name" value = <?php echo $res['name'];?>></td>
    <td><input type="text" name="company" value = <?php echo $res['company'];?>></td>
    <td><input type="number" name="pincode" min="100000" max="999999" value=<?php echo $res['pincode'];?>></td>
    <td><input type="numbers" name="groupnumber" value = <?php echo $res['mygroup'];?>></td>
    <td><input type="submit" name = "submit" value = "update"><br></td>
    
   <?php } 
    else if($user['username']=="mod"){
        if($res['username']=="mod"){
            $user = Auth::user();
                    if($user['username'] == "admin" || $user['username'] == "mod")
                    { ?>
                       <td> <input type ="text" name="username" id="username" value = <?php echo $res['username'];?> readonly>
                   <?php } 

                        else {
                            ?>
                     <td>  <input type ="hidden" name="username" id="username" value = <?php echo $res['username'];?>>

                        <?php } ?>  
                </td>
   
               <td><input id="username" type="email" name="email" value=<?php echo $res['email'];?> readonly></td>
                <td><input type="text" name="name" value = <?php echo $res['name'];?>></td>
                <td><input type="text" name="company" value = <?php echo $res['company'];?>></td>
                <td><input type="number" name="pincode" min="100000" max="999999" value=<?php echo $res['pincode'];?>></td>
                <td><input type="numbers" name="groupnumber" value = <?php echo $res['mygroup'];?>></td>
                <td><input type="submit" name = "submit" value = "update"><br></td>
        <?php 
        }
        else {
            $user = Auth::user();
                    if($user['username'] == "admin" || $user['username'] == "mod")
                    { ?>
                        <td>
                        <input type ="text" name="username" id="username" value = <?php echo $res['username'];?> readonly>
                   <?php } 

                        else {
                            ?>
                            <td>
                       <input type ="hidden" name="username" id="username" value = <?php echo $res['username'];?>>

                        <?php } ?>  
                </td>
   
               <td><input id="username" type="email" name="email" value=<?php echo $res['email'];?> readonly></td>
                <td><input type="text" name="name" value = <?php echo $res['name'];?> readonly></td>
                <td><input type="text" name="company" value = <?php echo $res['company'];?> readonly></td>
                <td><input type="number" name="pincode" min="100000" max="999999" value=<?php echo $res['pincode'];?> readonly></td>
                <td><input type="numbers" name="groupnumber" value = <?php echo $res['mygroup'];?> readonly></td>
                <td><input type="hidden" name = "submit" value = "update"><br></td>
      <?php  } 
    }
    else { ?>
     <input type ="hidden" name="username" id="username" value = <?php echo $res['username'];?>>
         <td><input id="username" type="email" name="email" value=<?php echo $res['email'];?> readonly></td>
                <td><input type="text" name="name" value = <?php echo $res['name'];?> readonly></td>
                <td><input type="text" name="company" value = <?php echo $res['company'];?> readonly></td>
                <td><input type="number" name="pincode" min="100000" max="999999" value=<?php echo $res['pincode'];?> readonly></td>
                <td><input type="numbers" name="groupnumber" value = <?php echo $res['mygroup'];?> readonly></td>
                <td><input type="hidden" name = "submit" value = "update"><br></td>
   <?php } ?>
 
     </form>
     </tr></table>
 
    <?php 
  } 
    ?>
        @endif
                 </div>
            </div>
        </div>
    </div>
</div>

@endsection
