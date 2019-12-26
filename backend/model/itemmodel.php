<?php
class item{
    public function  viewAllItems(){
        global $con;
        $r=$con->prepare("SELECT * FROM item i,category c WHERE i.cat_id=c.cat_id  ORDER BY i.item_name ASC");
        $r->execute();
        return $r;

    }

        public function  displaynotselected($item_id1){
        global $con;
        $r=$con->prepare("SELECT * FROM item i WHERE i.item_id NOT IN (SELECT i.item_id FROM item i WHERE i.item_id=$item_id1)");
        $r->execute();
        return $r;

    }

            public function  displaynotselectedboth($item_id1,$item_id2){
        global $con;
        $r=$con->prepare("SELECT * FROM item i WHERE i.item_id NOT IN (SELECT i.item_id FROM item i WHERE i.item_id=$item_id1  OR i.item_id=$item_id2)");
        $r->execute();
        return $r;

    }

        public function  getTheRowCount(){
        global $con;
        $r=$con->prepare("SELECT * FROM item i,category c WHERE i.cat_id=c.cat_id AND c.cat_name!='miscellaneous'  ORDER BY i.item_id ASC");
        $r->execute();
        return $r;

    }
        public function  viewitemLimited($start,$limit){
        global $con;
        $r=$con->prepare("SELECT * FROM item i,category c WHERE i.cat_id=c.cat_id AND c.cat_name!='miscellaneous' ORDER BY i.item_id ASC LIMIT $start,$limit");
        $r->execute(array($start,$limit));
        return $r;
    }
     public function  viewTempItems(){
        global $con;
        $r=$con->prepare("SELECT * FROM temp_order i,category c WHERE i.cat_id=c.cat_id ORDER BY i.item_id DESC");
        $r->execute();
        return $r;

    }
    
        public function  viewItemsCategory($cat_id){
        global $con;
        $r=$con->prepare("SELECT * FROM item i,category c WHERE i.cat_id=c.cat_id  AND c.cat_id=$cat_id");
        $r->execute();
        return $r;

    }


    public function  viewItemImage($item_id){
        global $con;
        $r=$con->prepare("SELECT * FROM item_image WHERE item_id=? LIMIT 1");
        
        $r->execute(array($item_id));
        return $r;

    }

    public function  viewAnItem($item_id){
        global $con;
        $r=$con->prepare("SELECT * FROM item i,category c WHERE i.cat_id=c.cat_id AND i.item_id=?"); 
        $r->execute(array($item_id));
        return $r;
        
    }


    public function  viewAItem($item_id){
        global $con;
        $r=$con->prepare("SELECT * FROM item i,category c WHERE i.cat_id=c.cat_id AND i.item_id=$item_id");
        $r->execute(array($item_id));
        return $r;

    }




    public function  addItem($arr){
        global $con;
        
        $r=$con->prepare("INSERT INTO `item`(`item_id`, `item_name`, `item_price`, `item_des`, `cat_id`, `item_status`, `item_image`, `item_size`) VALUES (?,?,?,?,?,?,?,?)");
        $r->execute(array(NULL,$arr['item_name'],$arr['item_price'],$arr['item_des'],$arr['cat_id'],'Active','',$arr['size_name']));

        $item_id=$con->lastinsertId();

        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position

        }
        return $item_id;
    }

    // public function  addImage($ii_name,$item_id){
    //     global $con;
    //     $r=$con->prepare("INSERT INTO item_image(ii_name,ii_status,item_id)VALUES(?,?,?)");
    //     $r->execute(array($ii_name,"Active",$item_id));

    //     return $r;
    //     if($r->errorCode()!=0){
    //         $errors=$r->errorInfo();
    //         echo $errors[2];// error is in array 2 means error namme position

    //     }

    // }

         public function updateItemImage($item_id,$item_image_new,$item_tmp){
        global $con;
        $r=$con->prepare("UPDATE item SET item_image=? WHERE item_id=?");
        $r->execute(array($item_image_new,$item_id));
        if($r){
            $path="../images/item_images/".$item_image_new;
            move_uploaded_file($item_tmp,$path);
        }
        if($r->errorCode() != 0){
            $errors = $r->errorinfo();
            echo $errors[2];
        }
        return $r;
    }


    public function  updateItem($arr,$item_id){
        global $con;
        $r=$con->prepare("UPDATE item SET  cat_id=?,item_name=?,item_price=?,item_des=?  WHERE item_id=?");
        $r->execute(array($arr['cat_id'],$arr['item_name'],$arr['item_price'],$arr['item_des'],$item_id));


        return $r;
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position

        }

    }

    public function  updateItemStatus($item_id,$item_status){
        global $con;
        $r=$con->prepare("UPDATE item SET  item_status=?  WHERE item_id=?");
        $r->execute(array($item_status,$item_id));



        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position

        }
        return $r;

    }


    public function  deleteAnItem($item_id){
        global $con;
        $r=$con->prepare("DELETE FROM item WHERE item_id=?");
        $r->execute(array($item_id));


        return $r;
        if($r->errorCode()!=0){
            $errors=$r->errorInfo();
            echo $errors[2];// error is in array 2 means error namme position

        }

    }

        public function  viewAnItemcategory($cat_id){
        global $con;
        $r=$con->prepare("SELECT * FROM item  WHERE cat_id=$cat_id"); 
        $r->execute(array($cat_id));
        return $r;
        
    }

}

?>
