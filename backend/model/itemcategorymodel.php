<?php
class stock{

    public function  addstock($arr,$user_id,$textfile){
        global $con;
        $r=$con->prepare("INSERT INTO item_category(itemcategory_date,item_id,item_status,user_id,item_price,textfile)VALUES(now(),?,?,?,?,?)");
        $r->execute(array($arr['item_id'],"Active",$user_id,$arr['price'],$textfile));
        
        $itemcategory_id=$con->lastinsertId();
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $itemcategory_id;
        
    }

    public function  addstockfeature($itemcategory_id,$f_id){
        global $con;
        $r=$con->prepare("INSERT INTO stock_feature(itemcategory_id,f_id)VALUES(?,?)");
        $r->execute(array($itemcategory_id,$f_id));
        
        
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $r;
        
    }

                public function  getStockQuantity($item_id,$flavour_id,$size_id){
        global $con;
        $r=$con->prepare("SELECT SUM(ic.item_price) as sq FROM item_category ic WHERE ic.item_id=? AND ic.itemcategory_id IN (SELECT distinct itemcategory_id FROM stock_feature  WHERE f_id=? OR f_id=?)");
        $r->execute(array($item_id,$flavour_id,$size_id));
        
      
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $r;
        
    }


    public function  viewallitemcategory(){
        global $con;
        $r=$con->prepare("SELECT * FROM item_category ic,stock_feature sf WHERE ic.itemcategory_id=sf.itemcategory_id");
        $r->execute(array());
        
        
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $r;
        
    }

    public function  checkstockbalance($item_id,$flavour_id,$size_id){
        global $con;
        $r=$con->prepare("SELECT * FROM stock_balance WHERE item_id=? AND flavour_id=? AND size_id=?");
        $r->execute(array($item_id,$flavour_id,$size_id));
        
        
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $r;
        
    }

    public function  addstockbalance($item_id,$flavour_id,$size_id){
        global $con;
        $r=$con->prepare("INSERT INTO stock_balance(lastmodified,item_id,flavour_id,size_id)VALUES(now(),?,?,?)");
        $r->execute(array($item_id,$flavour_id,$size_id));
        
        
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $r;
        
    }

    public function  updatestockbalance($item_id,$flavour_id,$size_id){
        global $con;
        $r=$con->prepare("UPDATE stock_balance SET lastmodified=now() WHERE item_id=$item_id,flavour_id=$flavour_id,size_id=$size_id  ");
        $r->execute(array($item_id,$flavour_id,$size_id));
        
        
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $r;
        
    }
    public function  viewallstockbalance(){
        global $con;
        $r=$con->prepare("SELECT * FROM stock_balance ");
        $r->execute(array());
        
        
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $r;
        
    }
        public function  viewallstockbalance1(){
        global $con;
        $r=$con->prepare("SELECT * FROM stock_balance sb,item i WHERE sb.item_id=i.item_id");
        $r->execute(array());
        
        
        
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position
            
        }
        return $r;
        
    }

       public function  viewAllItems(){
        global $con;
        $r=$con->prepare("SELECT * FROM item i,category c WHERE i.cat_id=c.cat_id ORDER BY i.item_id DESC");
        $r->execute();
        return $r;

    }

}

?>
