<?php


class login {
    
    function userlogin($user_email,$user_pwd,$status){
        
        global $con;
        
        $r=$con->prepare("SELECT * FROM login l,user u,role r WHERE l.user_id=u.user_id AND u.role_id=r.role_id AND l.user_email=? AND l.user_pwd=? AND u.user_status=?"); // we use ? to prevent from sql injection attacks
        
        $r->execute(array($user_email,$user_pwd,$status)); // pass values using arrays
        
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
        
        return $r;
                
   
   }

    function cuslogin($cus_email,$cus_pwd){
        
        global $con;
        
        $r=$con->prepare("SELECT * FROM cus_login l,customer c WHERE l.cus_id=c.cus_id AND l.cus_email=? AND l.cus_pwd=? AND cus_status='Active'"); // we use ? to prevent from sql injection attacks
        
        $r->execute(array($cus_email,$cus_pwd)); // pass values using arrays
        
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
        
        return $r;
                }
   
   function addlogin($user_email,$user_pwd,$user_id){
        
        global $con;
        
        $r=$con->prepare("INSERT INTO login VALUES(?,?,?)"); // we use ? to prevent from sql injection attacks
        
        $r->execute(array($user_email,$user_pwd,$user_id)); // pass values using arrays
        
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
        
        return $r;
                
   
   }



    // add customer login details 
      function addcuslogin($cus_email,$cus_pwd,$cus_id){
        
        global $con;
        
        $r=$con->prepare("INSERT INTO cus_login VALUES(?,?,?)"); // we use ? to prevent from sql injection attacks
        
        $r->execute(array($cus_email,$cus_pwd,$cus_id)); // pass values using arrays
        
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
        
        return $r;
                
   
   }




   function checkEmail($user_email){
        
        global $con;
        
        $r=$con->prepare("SELECT * FROM login WHERE user_email=?"); // we use ? to prevent from sql injection attacks
        
        $r->execute(array($user_email)); // pass values using arrays
        $n=$r->rowCount();
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
        
        return $n;
                
   
   }

      function checkCusEmail($cus_email){
        
        global $con;
        
        $r=$con->prepare("SELECT * FROM cus_login WHERE cus_email=?"); // we use ? to prevent from sql injection attacks
        
        $r->execute(array($cus_email)); // pass values using arrays
        $n=$r->rowCount();
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
        
        return $n;
                
   
   }

    public function updateUserPassword($newPass,$id,$oldPass) {
        global $con;
        
        $r=$con->prepare("UPDATE login SET user_pwd='$newPass' WHERE user_id='$id' AND user_pwd='$oldPass'");
        $r->execute(array($newPass,$id,$oldPass));
       
       
        
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }

         return $r;
    }

}


?>


