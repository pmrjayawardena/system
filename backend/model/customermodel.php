<?php
class customer{
    public function viewAllCustomer(){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM customer WHERE cus_id");
        $r->execute();
        return $r;
    }
    public function viewPurchaseHistory($cus_id){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM cus_order WHERE cus_id=$cus_id ORDER BY order_id DESC");
        $r->execute();
        return $r;
    }

    public function  viewpurchaseLimited($cus_id,$start,$limit){
        global $con;
        $r=$con->prepare("SELECT * FROM cus_order WHERE cus_id=$cus_id ORDER BY order_id DESC LIMIT $start,$limit");
        $r->execute(array($cus_id,$start,$limit));
        return $r;
    }
    public function viewPurchaseHistoryItems($order_id){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM cus_order o,order_item oi,item i WHERE o.order_id=oi.order_id AND i.item_id=oi.item_id AND o.order_id=$order_id");
        $r->execute();
        return $r;
    }
    public function viewPurchaseHistorypackage($order_id){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM cus_order o,order_package op,package p WHERE o.order_id=op.order_id AND p.package_id=op.package_id AND o.order_id=$order_id");
        $r->execute();
        return $r;
    }

    function checkitemorpackagewebsite($order_id){
        global $con;
        $r=$con->prepare("SELECT * FROM cus_order co WHERE co.order_id IN(SELECT oi.order_id FROM order_item oi WHERE co.order_id=oi.order_id AND co.order_id=$order_id )");
        $r->execute();



        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];

        }

        return  $r;

    }
    public function  getDelivery1($order_id){
        global $con;
        $r=$con->prepare("SELECT * FROM payment WHERE order_id=$order_id");
        $r->execute(array($order_id));
        
        
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $r;
        
    }


    public function addCustomer($arr) {
        global $con;
        
        $r=$con->prepare("INSERT INTO customer (cus_fname,cus_lname,cus_dob,cus_gender,cus_email,cus_tel,cus_nic,cus_add,pro_id,dis_id,city_id,zip_code,cus_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $r->execute(array($arr['cus_fname'],$arr['cus_lname'],$arr['cus_dob'],$arr['cus_gender'],$arr['cus_email'],$arr['cus_tel'],$arr['cus_nic'],$arr['cus_add'],$arr['pro_id'],$arr['dis_id'],$arr['city_id'],$arr['zip_code'],"Active"));
        $cus_id=$con->lastinsertId();
        return $cus_id;
        
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }

    public function addCustomerOther($arr) {
        global $con;
        
        $r=$con->prepare("INSERT INTO cus_contact(firstname,lastname,email,telephone,event_type,no_of_guests,location,event_date,type_of_food) VALUES (?,?,?,?,?,?,?,?,?)");
        $r->execute(array($arr['firstname'],$arr['lastname'],$arr['email'],$arr['telephone'],$arr['event_type'],$arr['no_of_guests'],$arr['location'],$arr['event_date'],$arr['type_of_food']));
        
        return $r;
        
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }

        public function selectContactDetails(){  //view all user data
            global $con;
            $r=$con->prepare("SELECT * FROM cus_contact");
            $r->execute();
            return $r;
        }

        
        public function updateCusImage($cus_id,$cus_image_new,$cus_tmp){
            global $con;
            $r=$con->prepare("UPDATE customer SET cus_image=? WHERE cus_id=?");
            $r->execute(array($cus_image_new,$cus_id));
            if($r){
                $path="../img/cus_images/".$cus_image_new;
                move_uploaded_file($cus_tmp, $path);
            }
            if($r->errorCode() != 0){
                $errors = $r->errorinfo();
                echo $errors[2];
            }
            return $r;
        }

    public function viewACustomer($cus_id){//To select a particular user
        global $con;
        $r=$con->prepare("SELECT * FROM customer cu,cities c WHERE c.id=cu.city_id AND cu.cus_id=?");
        $r->execute(array($cus_id));
        return $r;
    }

        public function viewACustomerinordering($cus_id){//To select a particular user
            global $con;
            $r=$con->prepare("SELECT * FROM customer WHERE cus_id=?");
            $r->execute(array($cus_id));
            return $r;
        }

        public function viewACustomer1($cus_id){//To select a particular user
            global $con;
            $r=$con->prepare("SELECT * FROM customer WHERE cus_id=?");
            $r->execute(array($cus_id));
            return $r;
        }

    public function viewAInquiry($c_id){//To select a particular user
        global $con;
        $r=$con->prepare("SELECT * FROM cus_contact WHERE c_id=?");
        $r->execute(array($c_id));
        return $r;
    }

    public function updateLoggedCustomer($arr,$cus_id) {
        global $con;
        
        $r=$con->prepare("UPDATE customer SET cus_fname=?,cus_lname=?,cus_gender=?,cus_tel=?,cus_nic=?,cus_dob=?,cus_add=?,pro_id=?,dis_id=?,city_id=?,zip_code=? WHERE cus_id=?");
        $r->execute(array($arr['cus_fname'],$arr['cus_lname'],$arr['cus_gender'],$arr['cus_tel'],$arr['cus_nic'],$arr['cus_dob'],$arr['cus_add'],$arr['pro_id'],$arr['dis_id'],$arr['city_id'],$arr['zip_code'],$cus_id));
        
        return $r;
        
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }



     public function viewALoggedCustomer($cus_id){//To select a particular user
        global $con;
        $r=$con->prepare("SELECT * FROM customer c WHERE  c.cus_id='$cus_id'");
        $r->execute(array($cus_id));
        return $r;

        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position

        }

    }


    public function  deleteACustomer($cus_id){
        global $con;
        $r=$con->prepare("DELETE FROM customer WHERE cus_id=?");
        $r->execute(array($cus_id));


        return $r;
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position

        }

    }

    public function  viewCusLog(){
        global $con;
        $r=$con->prepare("SELECT * FROM customer c , cus_log l WHERE c.cus_id=l.cus_id  ORDER BY l.log_id DESC");
        $r->execute();
        return $r;
        
    }

            public function updateCustomerStatus($cus_id,$cus_status) {
        global $con;
        
        $r=$con->prepare("UPDATE customer SET cus_status=? WHERE cus_id=?");
        $r->execute(array($cus_status,$cus_id));
       
        return $r;
        
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }

}

?>
