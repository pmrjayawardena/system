<?php
//To make sure authentication
//check if there are records in session and if the session is empty redirect to login.php page with a messsage else asign the image of the logged user



session_start();
error_reporting(E_WARNING || E_ALL);
 $userinfo=$_SESSION['userinfo'];
 if(count($userinfo)!=0){ //to check login or not
    if($userinfo['user_image']==""){
         $iname="../images/user_icon.png";
    }else{
        $iname="../images/user_images/".$userinfo['user_image'];
    }
 }  else {
     $msg = base64_encode("Please login!!!");
     header("Location:../views/login.php?msg=$msg");
     exit();
     
 }    
 ?>