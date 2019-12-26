<?php
session_start(); //Start a session
date_default_timezone_set("Asia/colombo");
include '../model/loginmodel.php';
include '../model/logmodel.php';
include '../common/dbconnection.php';
include '../common/functions.php';

$con=$GLOBALS['con'];

//Validate Email and Password in db
$user_email=$_POST['txtEmail'];   //get the typed email from the form
$user_pwd=sha1($_POST['txtPassword']); //one way encryption

$oblogin=new login(); //to create an object
$r=$oblogin->userlogin($user_email, $user_pwd,"Active");  //asign the values taken from userLogin() to variable $r


echo $nor=$r->rowCount();  //get the rowCount



if($nor){
    $row=$r->fetch(PDO::FETCH_BOTH);
    
    $log_status="login";          //set the string value "login" to a variable $log_status
    $log_ip=  get_ip_address();   //get IP Address of the client machine
    $user_id=$row['user_id'];     //get the user_id from $row variable 
    // $user_id=$row['user_id'];
    $time_id=  time();            //Time Stamp   
    $session_id=$time_id."_".$user_id;  //create a session_id from current time and user id
    $oblog=new log();  //create an object using log class
    $oblog->addlog($log_status, $log_ip, $user_id,$session_id); //Insert date into log table
    array_push($row, $session_id);
    //var_dump($row);
    $_SESSION['userinfo']=$row;            //asign session values to variable $row

    //var_dump($nor);
    
    header("Location:../views/dashboard.php");     //Redirection    
}else{
    
    $msg=base64_encode("Invalid Email or Password");
    header("Location:../views/login.php?msg=$msg");    //Redirection    
}

?>


