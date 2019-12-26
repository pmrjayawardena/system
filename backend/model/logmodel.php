<?php

class log{
    
    public function addlog($log_status,$log_ip,$user_id,$session_id){
        global $con;
        
        $r=$con->prepare("INSERT INTO log(log_in_date,log_status,log_ip,user_id,session_id) VALUES(NOW(),?,?,?,?)"); // we use ? to prevent from sql injection attacks
        $r->execute(array($log_status,$log_ip,$user_id,$session_id)); 
        
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
    }
    
    public function updatelog($log_status,$session_id){
         global $con;
        
        $r=$con->prepare("UPDATE log SET log_out_date=NOW(), log_status=? WHERE session_id=?");
        $r->execute(array($log_status,$session_id)); 
        
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
    }
    public function countlogFrequency($date){   // chart in dashboard
         global $con;
        
        $r=$con->prepare("SELECT * FROM log WHERE log_in_date LIKE '$date%'");
        $r->execute(); 
        
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
        return $r;
    }

     public function addcuslog($log_status,$log_ip,$cus_id,$session_id){
        global $con;
        
        $r=$con->prepare("INSERT INTO cus_log(log_in_date,log_status,log_ip,cus_id,session_id) VALUES(NOW(),?,?,?,?)"); // we use ? to prevent from sql injection attacks
        $r->execute(array($log_status,$log_ip,$cus_id,$session_id)); 
        
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
    }

        public function updatecuslog($log_status,$session_id){
         global $con;
        
        $r=$con->prepare("UPDATE cus_log SET log_out_date=NOW(), log_status=? WHERE session_id=?");
        $r->execute(array($log_status,$session_id)); 
        
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
    }
}

