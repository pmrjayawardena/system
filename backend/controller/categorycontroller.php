<?php
include '../common/dbconnection.php';
include '../model/categorymodel.php';

$obc    = new category();
$action = $_REQUEST['action'];

switch ($action) {
    case "add":
        $arr = $_POST; //get the details of the from to a variable $arr
        echo $cat_id = $obc->addCategory($arr); // add the category details
        
        $msg = 'not';
        
        
        if ($cat_id) { //If category has been added then
            if ($_FILES['cat_image']['name'] != "") { //if image is not empty
                $cat_image     = $_FILES['cat_image']['name']; //name off the image
                $cat_tmp       = $_FILES['cat_image']['tmp_name']; //temp location
                $cat_image_new = time() . "_" . $cat_id . "_" . $cat_image;
                $r             = $obc->updateCategoryImage($cat_id, $cat_image_new, $cat_tmp);
                //    print_r($r);
                
            }
            header("Location:../views/category_management.php?msg=1"); //redirection
        } else {
            header("Location:../views/add_category.php?msg=2"); //redirection
        }
        break;
    
    case "update":
        $arr    = $_POST; //get the details from the form
        $cat_id = $_REQUEST['cat_id']; //get the category id from the url
        
        $result = $obc->updateCategory($arr, $cat_id); //update the category table 
        if ($result)
            if ($_FILES['cat_image']['name'] != "") { //if image is not empty
                
                //to remove previous image
                $resultcategory = $obc->viewACategory($cat_id);
                $rowcategory    = $resultcategory->fetch(PDO::FETCH_BOTH);
                $cat_pimage     = $rowcategory['cat_image'];
                $oldpath        = "../images/cat_images/" . $cat_pimage;
                unlink($oldpath);
                
                $cat_image     = $_FILES['cat_image']['name']; //name off the image
                $cat_tmp       = $_FILES['cat_image']['tmp_name']; //temp location
                $cat_image_new = time() . "_" . $cat_id . "_" . $cat_image;
                $r             = $obc->updateCategoryImage($cat_id, $cat_image_new, $cat_tmp);
                
            } else {
                $msg    = "A record has not been updated";
                $status = "danger";
            }
        
        header("Location:../views/update_category.php?cat_id=$cat_id&msg=1"); //redirection
        break;
    
    case "Delete":
        
        $cat_id = $_REQUEST['cat_id']; //get the category id from url
        $r      = $obc->deleteACategory($cat_id); //deletea perticular category using category id
        
        if ($r) { //if the category has been deleted
            
            
            $msg = base64_encode("A record has $msg  been added");
            header("$item_id record has been deleted"); //redirection
        } else {
            
            
            $msg = base64_encode("A record has $msg  been added");
            header("$item_id record has  not been deleted"); //redirection
        }
        
        header("Location:../views/category_management.php?msg=2");
        break;
}

?>