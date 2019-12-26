<?php
session_start();
$userInfo=$_SESSION['userinfo'];//TO identify unique session ID

$session_id=$userInfo[19];  //get the session id from the session and assign
                            //to a variable


include '../common/dbconnection.php';
include '../model/logmodel.php';
$oblog=new log();   //create an object 
$log_status='logout';
$oblog->updatelog($log_status, $session_id); //update the log table

unset( $_SESSION['userinfo']); //unset the session upon logging out
header("refresh:1,url=login.php"); //Redirection
?>

<html>
 <head>
    <meta charset="utf-8">
   
    <title>sos</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css" />
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
    
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    
    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
    <script defer src="../plugins/fontawesome-all.js" ></script>
  </head>
  <body>
      <div id="main">
          <div id="heading">
              <div class="row">
                
              </div>
          </div>
          <div id="navi">
              <div class="row" >
                  <div class="col-md-4 col-sm-6 paddinga">
                      &nbsp;
                  </div>
                 
              </div>
              
          </div>
          <div class="clearfix"></div>
          <div id="contents">
              <div class="row" >
                  <div class="col-md-4 col-sm-4 "> &nbsp;</div>
                  <div class="col-md-4 col-sm-4 " >
                      </br>
                      <center>
                      <p  class="alert alert-danger" >Successfully Logging out</p>
                      <img src="../images/logout2.gif" /></br></br>
                      <a href="../view/login.php" class="">Login</a>
                      </center>
                  </div>
                  <div>&nbsp;</div>
              </div>
          </div>
      </div>
     


  </body>

</html>



