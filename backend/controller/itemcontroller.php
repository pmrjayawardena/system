<?php

include '../common/dbconnection.php';
include '../model/itemmodel.php';

$obitem = new item(); //create an object using item class

$action = $_REQUEST['action'];

switch ($action) {
    case "add":
        $arr     = $_POST; //get the form data to the variable $arr
        $item_id = $obitem->addItem($arr); //add item details to the database
        
        if ($item_id) { //If user has been added then
            if ($_FILES['item_image']['name'] != "") { //if image is not empty
                $item_image     = $_FILES['item_image']['name']; //name off the image
                $item_tmp       = $_FILES['item_image']['tmp_name']; //temp location
                $item_image_new = time() . "_" . $item_id . "_" . $item_image;
                $r              = $obitem->updateItemImage($item_id, $item_image_new, $item_tmp);
                //    print_r($r);
                
            }
            $msg1 = base64_encode("A record has $msg been added");
            header("Location:../views/item_management.php?msg=1"); //redirection
        } else {
            $msg2 = base64_encode("A record has $msg been added");
            header("Location:../view/addcategory.php?msg=2"); //redirection
        }
        break;
    
    
    case "update": //update an item
        $arr     = $_POST; //get the form data from the updateitem page
        $item_id = $_REQUEST['item_id']; //get the item id from the url
        
        $result = $obitem->updateItem($arr, $item_id); //update a perticular item using item id got from the url
        if ($result)
            if ($_FILES['item_image']['name'] != "") { //if image is not empty
                
                //to remove previous image
                $resultitem  = $obitem->viewAnItem($item_id);
                $rowitem     = $resultitem->fetch(PDO::FETCH_BOTH);
                $item_pimage = $rowitem['item_image'];
                $oldpath     = "../images/item_images/" . $item_pimage;
                unlink($oldpath);
                
                $item_image     = $_FILES['item_image']['name']; //name off the image
                $item_tmp       = $_FILES['item_image']['tmp_name']; //temp location
                $item_image_new = time() . "_" . $item_id . "_" . $item_image;
                $r              = $obitem->updateItemImage($item_id, $item_image_new, $item_tmp);
                
            } else {
                $msg    = "A record has not been updated";
                $status = "danger";
            }
        
        header("Location:../views/update_item.php?item_id=$item_id&msg=1"); //redirection
        break;
    
    case "ACDAC": // new case for active deactive 
        
        $item_id = $_REQUEST['item_id']; //get the item id from the url
        $status  = $_REQUEST['status'];
        
        if ($status) {
            
            $item_status = "Unavailable"; //if the status is 1 set the new item status to unavailable in item status
            
            
        } else {
            
            $item_status = "Available"; //if the status is 0 set the new item status to available in item status
        }
        
        $r = $obitem->updateItemStatus($item_id, $item_status); //update the status of the item in db
        if ($r) {
            
            header("Location:../views/item_management.php?msg=3"); //redirection
            
        }
        break;
    
    case "Delete": //delete an item from db
        
        $item_id = $_REQUEST['item_id']; //get the item id that passed from the button
        $r       = $obitem->deleteAnItem($item_id); //delete an item ising item id
        
        if ($r) { //if the item is deleted 
            
            
            $msg = base64_encode("A record has $msg  been added");
            header("$item_id record has been deleted"); //redirection
        } else {
            
            
            $msg = base64_encode("A record has $msg  been added");
            header("$item_id record has  not been deleted"); //redirection
        }
        
        header("Location:../views/item_management.php?msg=4"); //redirection
        break;
        
}



?>
