<?php

class dbconnection //create a class name dbconnection
{
    
    function dbcon() //create a method in the class dbconnection as dbcon
    {
        
        
        //to connect database
        $host = "localhost";
        $un   = "root"; //username
        $pd   = "78952"; //root password
        $db   = "ocs"; //database name
        
        
        
        $con = new PDO("mysql:host=$host;dbname=$db", "$un", "$pd"); //Create a Database Connection
        
        return $con;
        
    }
}

$ob  = new dbconnection(); //create an object using the class dbconnection
$con = $ob->dbcon();
