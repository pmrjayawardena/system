

<?php 
include '../common/dbconnection.php';
include '../model/usermodel.php';
include '../model/loginmodel.php';
include '../common/sessionhandling.php';



$action=$_REQUEST['action'];

switch ($action){
	
     case "add" :
       
         
$oldPass=sha1($_POST['oldPassword']); //get the old password to the variable $oldPass
$newPass=sha1($_POST['newPassword']); //get the New password to the variable $newPass

$id=$userinfo['user_id']; //get the user id of the logged in user
        
$obu=new login(); //create an object using login class

$r=$obu->updateUserPassword($newPass,$id,$oldPass);   //update the password in the database

header("Location:../view/profile.php?msg=4");  //redirection
}


?>