<?php 
include '../common/dbconnection.php';
include '../model/usermodel.php';
include '../model/loginmodel.php';
include '../common/sessionhandling.php';
include '../phpmailer/PHPMailerAutoload.php';


$obu=new user();
$action=$_REQUEST['action'];

switch ($action){
 case "add" :
 $arr=$_POST;

 print_r($arr);
        $user_id=$obu->addUser($arr); //add user details to db and get the last inserted id
         $msg='not';
         $oblogin=new login();  //create an object from login class

         if($user_id){//If user has been added then

            $user_pwd=sha1('123');  //encrypt the default password using sha1 and asign to a variable
            $oblogin->addlogin($_POST['user_email'], $user_pwd, $user_id); //add the email and password to login table


// if a user is added the email and the password will be sent to the perticular user email
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = 'southernlanka123@gmail.com';
            $mail->Password = 'southernlanka1@';

            $mail->setFrom('admin@southernlanka.com', 'Southern Lanka Catering');
            $mail->addAddress($_POST['user_email'], $_POST['user_fname']);
            $mail->Subject = 'Password for your account';
            $mail->isHTML(true);
            $mail->Body = "Congratulations your account is successfully created <br><br>"

            ."Email of your new account is - {$_POST["user_email"]}<br><br>"
            ."your password is - 123 <br><br>";



            if ($mail->send()) //if the email is sent

             if($_FILES['user_image']['name']!=""){    //if image is not empty
                $user_image=$_FILES['user_image']['name'];   //name off the image
                $user_tmp=$_FILES['user_image']['tmp_name'];  //temp location
                $user_image_new=time()."_".$user_id."_".$user_image;
                $r=$obu->updateUserImage($user_id, $user_image_new, $user_tmp);
              }

              $msg1=  base64_encode("A record has $msg been added");
             header("Location:../views/user_management.php?msg=1"); //redirection if the user added
           }else{
             $msg2=  base64_encode("A record has $msg been added");
             header("Location:../views/add_user.php?msg=2"); //redirection is the process failed
           }


           break;



           case "update": //update a perticular user
            $arr=$_POST;   //get the details of the user from the form
            $user_id=$_REQUEST['user_id']; //request the user id
 
            $result=$obu->updateUser($arr, $user_id); //update a perticular user
 
            if($result){ //if the user is updated 
             $msg="A record has been updated";
             $status="success";
 
               if($_FILES['user_image']['name']!=""){//if image is not empty
 
                    //to remove previous image
                 $resultuser=$obu->viewAUser($user_id);
                 $rowuser=$resultuser->fetch(PDO::FETCH_BOTH);
                 $user_pimage=$rowuser['user_image'];
                 $oldpath="../images/user_images/".$user_pimage;
                 unlink($oldpath);
 
                 $user_image=$_FILES['user_image']['name'];//name off the image
                 $user_tmp=$_FILES['user_image']['tmp_name'];//temp location
                 $user_image_new=time()."_".$user_id."_".$user_image;
                 $r=$obu->updateUserImage($user_id, $user_image_new, $user_tmp);
                 
               }
             }  else {
               $msg="A record has not been updated";
               $status="danger";
             }
 
             header("Location:../views/update_user.php?user_id=$user_id&msg=1"); //redirection
             break;
 
 
 
 
 
 
 
 
       case "ACDAC":                  // new case for active deactive 
 
       $user_id=$_REQUEST['user_id']; //get the user id from the url
       $status=$_REQUEST['status'];   //get the status from the url
 
       if($status){  //if the status is 1 set the user status to deactive
 
         $user_status="Deactive";
 
       }else{  //else set the user status to active
 
         $user_status="Active";
       }
       $r=$obu->updateUserStatus($user_id,$user_status); //update the user status
 
       $last_visited_url=$_SERVER['HTTP_REFERER'];
 $arrurl=explode("/",$last_visited_url); //by using slash we seperate the url by "/" value
 $count=count($arrurl); //get count
 $url=$arrurl[$count-1]; // get page name
 
 $uri=explode("?",$url);
 
 if($uri[0]=="searchuser.php"){
   $search=$_REQUEST['search'];
   $page=$_REQUEST['page'];
 
 }else{
 
   header("Location:$last_visited_url");
 
 }
 //header("Location:$last_visited_url");
 break;
 
 
 
 
 
 
 case "updateloggeduser": //update user information of a logged user
 $arr=$_POST;  //get the data from the form
 $user_id=$userinfo['user_id']; //get the user id from the session
 $user_fname=$_POST['user_fname']; //get the fname from the form
 $user_lname=$_POST['user_lname']; //get the lastname from the form
 $user_dob=$_POST['user_dob']; //get the dob
 $user_gender=$_POST['user_gender']; //get the gender
 $user_tel=$_POST['user_tel']; //get the tel
 $user_nic=$_POST['user_nic']; //get the nic
 $user_add=$_POST['user_add'];//get the address
 
 $result=$obu->updateLoggedUser($user_fname,$user_lname,$user_dob,$user_gender,$user_tel,$user_nic,$user_add,$user_id);
 //update the query 
 //
 if($result){ //if the result is true
 
  header("Location:../view/profile.php?msg=5");  //redirection
 
 }  else {
  header("Location:../view/profile.php?msg=6");  //redirection
 
 }
 break;
 } 

 ?>