<?php


class category
{
    function displayAllCategory()
    {
        global $con;
        $r = $con->prepare("SELECT * FROM category ORDER BY cat_id");
        $r->execute();
        
        
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorInfo();
            echo $errors[2];
            
        }
        
        return $r;
        
    }
    function displayAllCategoryExceptmiscellaneous()
    {
        global $con;
        $r = $con->prepare("SELECT * FROM category WHERE cat_name!='miscellaneous' ORDER BY cat_id");
        $r->execute();
        
        
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorInfo();
            echo $errors[2];
            
        }
        
        return $r;
        
    }
    
    public function addCategory($arr)
    {
        global $con;
        
        $r = $con->prepare("INSERT INTO `category`(`cat_id`,`cat_name`,`cat_image`,`cat_des`,`cat_status`) VALUES (?,?,?,?,?)");
        $r->execute(array(
            NULL,
            $arr['cat_name'],
            '',
            $arr['cat_des'],
            "Active"
        ));
        $cat_id = $con->lastinsertId();
        return $cat_id;
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }
    public function updateCategory($arr, $cat_id)
    {
        global $con;
        $r = $con->prepare("UPDATE category SET  cat_name=?,cat_des=?  WHERE cat_id=?");
        $r->execute(array(
            $arr['cat_name'],
            $arr['cat_des'],
            $cat_id
        ));
        
        
        return $r;
        if ($r->errorCode() != 0) {
            $errors = $r->errorInfo();
            echo $errors[2]; // error is in array 2 means error namme position
            
        }
        
    }
    
    
    public function updateCategoryImage($cat_id, $cat_image_new, $cat_tmp)
    {
        global $con;
        $r = $con->prepare("UPDATE category SET cat_image=? WHERE cat_id=?");
        $r->execute(array(
            $cat_image_new,
            $cat_id
        ));
        if ($r) {
            $path = "../images/cat_images/" . $cat_image_new;
            move_uploaded_file($cat_tmp, $path);
        }
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
        return $r;
    }
    
    public function updateCategoryStatus($cat_id, $cat_status)
    {
        global $con;
        $r = $con->prepare("UPDATE category SET  cat_status=?  WHERE cat_id=?");
        $r->execute(array(
            $cat_status,
            $cat_id
        ));
        
        
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorInfo();
            echo $errors[2]; // error is in array 2 means error namme position
            
        }
        return $r;
        
    }
    
    public function viewACategory($cat_id)
    {
        global $con;
        $r = $con->prepare("SELECT * FROM category WHERE cat_id=?");
        $r->execute(array(
            $cat_id
        ));
        return $r;
        
    }
    
    public function deleteACategory($cat_id)
    {
        global $con;
        $r = $con->prepare("DELETE FROM category WHERE cat_id=?");
        $r->execute(array(
            $cat_id
        ));
        
        
        return $r;
        if ($r->errorCode() != 0) {
            $errors = $r->errorInfo();
            echo $errors[2]; // error is in array 2 means error namme position
            
        }
        
    }
    
    public function viewCategoryBy($category) //view users by their status
    {
        global $con;
        $r = $con->prepare("SELECT * FROM category  WHERE cat_name=?");
        $r->execute(array(
            $category
        ));
        return $r;
    }
    
    
}


?>
