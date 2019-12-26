<?php

//To get remote ip address - http://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php
function get_ip_address()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = "UNKNOWN";
    }
    return $ipaddress;
}

function checkModuleRole($m_id, $role_id) //check if a user has a permission to a perticular model
{
    global $con;
    
    $r = $con->prepare("SELECT * FROM module_role  WHERE m_id=? AND role_id=?");
    
    $r->execute(array(
        $m_id,
        $role_id
    ));
    $count = $r->rowCount();
    if ($r->errorCode() != 0) {
        $errors = $r->errorInfo();
        echo $errors[2];
        
    }
    
    return $count;
}

function highlightKeyWord($search, $data) //highlight the searched word in user management module
{
    
    return str_ireplace($search, "<span class='alert-success'>{$search}</span>", $data);
    
}

function checkDelete($table, $item_id, $id) //check delete when trying to delete an item
{
    global $con;
    $r = $con->prepare("SELECT * FROM $table WHERE $item_id=$id");
    $r->execute();
    $count = $r->rowCount();
    
    
    if ($r->errorCode() != 0) {
        $errors = $r->errorInfo();
        echo $errors[2];
        
    }
    
    
    return $count;
}

function checkDeletecategory($table, $cat_id, $id) //check tables when deleting a category
{
    global $con;
    $r = $con->prepare("SELECT * FROM $table WHERE $cat_id=$id");
    $r->execute();
    $count = $r->rowCount();
    
    
    if ($r->errorCode() != 0) {
        $errors = $r->errorInfo();
        echo $errors[2];
        
    }
    
    
    return $count;
}


function checkCusDelete($table, $cus_id, $id) //check customer delete
{
    global $con;
    $r = $con->prepare("SELECT * FROM $table WHERE $cus_id=$id");
    $r->execute();
    $count = $r->rowCount();
    
    
    //echo $count;
    return $count;
}

function checkDriverDelete($table, $driver_id, $id) //check when deleting a driver 
{
    global $con;
    $r = $con->prepare("SELECT * FROM $table WHERE $driver_id=$id");
    $r->execute();
    $count = $r->rowCount();
    
    
    //echo $count;
    return $count;
}

function checkVehicleDelete($table, $v_id, $id) //check the record when deleting the vehicle
{
    global $con;
    $r = $con->prepare("SELECT * FROM $table WHERE $v_id=$id");
    $r->execute();
    $count = $r->rowCount();
    
    
    //echo $count;
    return $count;
}

function checkPackage($table, $package_id, $id) //check package when deleting
{
    global $con;
    $r = $con->prepare("SELECT * FROM $table WHERE $package_id=$id");
    $r->execute();
    $count = $r->rowCount();
    
    
    //echo $count;
    return $count;
}

function checkOrder($table, $order_id, $id) //check order when deleting order record
{
    global $con;
    $r = $con->prepare("SELECT * FROM $table WHERE $order_id=$id");
    $r->execute();
    $count = $r->rowCount();
    
    
    //echo $count;
    return $count;
}