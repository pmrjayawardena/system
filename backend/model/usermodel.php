<?php
class user{
    public function viewAllUser(){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM user u,role  r WHERE u.role_id=r.role_id ORDER BY user_id ASC");
        $r->execute();
        return $r;
    }

        public function viewAllUserlimit(){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM user u,role  r WHERE u.role_id=r.role_id ORDER BY user_id DESC LIMIT 4");
        $r->execute();
        return $r;
    }
    public function viewUserBystatus($status){ //view users by their status
        global $con;
        $r=$con->prepare("SELECT * FROM user  WHERE user_status=?");
        $r->execute(array($status));
        return $r;
    }
    public function  viewUserLimited($start,$limit){
        global $con;
        $r=$con->prepare("SELECT * FROM user u,role  r WHERE u.role_id=r.role_id ORDER BY user_id ASC LIMIT $start,$limit");
        $r->execute();
        return $r;
    }

    public function addUser($arr) {
        global $con;
        
        $r=$con->prepare("INSERT INTO `user`(`user_id`, `user_fname`, `user_lname`, `user_dob`, `user_gender`, `user_image`, `user_status`, `role_id`, `user_tel`, `user_nic`, `user_add`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $r->execute(array(NULL,$arr['user_fname'],$arr['user_lname'],$arr['user_dob'],$arr['user_gender'],'','Active',$arr['role_id'],$arr['user_tel'],$arr['user_nic'],$arr['user_add']));
        $user_id=$con->lastinsertId();
        return $user_id;
        
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }
        public function updateUser($arr,$user_id) {
        global $con;
        
        $r=$con->prepare("UPDATE user SET user_fname=?,user_lname=?,user_dob=?,user_gender=?,role_id=?,user_tel=?,user_nic=?,user_add=? WHERE user_id=?");
        $r->execute(array($arr['user_fname'],$arr['user_lname'],$arr['user_dob'],$arr['user_gender'],$arr['role_id'],$arr['user_tel'],$arr['user_nic'],$arr['user_add'],$user_id));
       
        return $r;
        
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }
    public function updateUserImage($user_id,$user_image_new,$user_tmp){
        global $con;
        $r=$con->prepare("UPDATE user SET user_image=? WHERE user_id=?");
        $r->execute(array($user_image_new,$user_id));
        if($r){
            $path="../images/user_images/".$user_image_new;
            move_uploaded_file($user_tmp, $path);
        }
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
        return $r;
    }

    public function viewAUser($user_id){//To select a particular user
        global $con;
        $r=$con->prepare("SELECT * FROM user u,role r,login l WHERE u.role_id=r.role_id AND u.user_id=l.user_id AND u.user_id=?");
        $r->execute(array($user_id));
        return $r;
    }

   public function viewSearchUser($search){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM user u,role  r WHERE u.role_id=r.role_id AND (u.user_fname LIKE '$search%' OR u.user_lname LIKE '$search%' OR user_gender LIKE '$search%' OR u.user_status LIKE '$search%' OR r.role_name LIKE '$search%')");
        $r->execute();
        return $r;
    }

       public function viewSearchUserLimited($search,$start,$limit){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM user u,role  r WHERE u.role_id=r.role_id AND (u.user_fname LIKE '$search%' OR u.user_lname LIKE '$search%' OR user_gender LIKE '$search%' OR u.user_status LIKE '$search%' OR r.role_name LIKE '$search%') ORDER BY u.user_id DESC LIMIT $start,$limit");
        $r->execute();
        return $r;
    }

        public function updateUserStatus($user_id,$user_status) {
        global $con;
        
        $r=$con->prepare("UPDATE user SET user_status=? WHERE user_id=?");
        $r->execute(array($user_status,$user_id));
       
        return $r;
        
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }

  


     public function viewUserLog(){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM user u,log l WHERE u.user_id=l.user_id ORDER BY u.user_id ASC");
        $r->execute();
        return $r;
    }

       public function updateLoggedUser($user_fname,$user_lname,$user_dob,$user_gender,$user_tel,$user_nic,$user_add,$user_id) {
        global $con;
        
        $r=$con->prepare("UPDATE user SET user_fname='$user_fname',user_lname='$user_lname',user_dob='$user_dob',user_gender='$user_gender',user_tel='$user_tel',user_nic='$user_nic',user_add='$user_add' WHERE user_id='$user_id'");
        $r->execute(array($user_fname,$user_lname,$user_dob,$user_gender,$user_tel,$user_nic,$user_add,$user_id));
       
        return $r;
        
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }

     public function viewALoggedUser($user_id){//To select a particular user
        global $con;
        $r=$con->prepare("SELECT * FROM user u,role r,login l WHERE u.role_id=r.role_id AND u.user_id=l.user_id AND u.user_id='$user_id'");
        $r->execute(array($user_id));
        return $r;
    }

}

?>
