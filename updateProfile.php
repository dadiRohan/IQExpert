<?php

if(isset($_REQUEST['submit'])){

    $dbHost = 'localhost';//localhost
    $dbUsername = 'root';//ideator1_admin
    $dbPassword = '';//admin@2017
    $dbName = 'iqexpert';//ideator1_iqexpert
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    if ($db->connect_error) {
        die("Unable to connect database: " . $db->connect_error);
    }
    
    if(isset($_REQUEST['uid'])){
		$UID = $_REQUEST['uid'];
	}

	if(isset($_REQUEST['flag'])){
		$FLAG = $_REQUEST['flag'];
	}


    // $query = $db->query("SELECT * FROM `users` WHERE user_id = {$_GET['id']}");
     $query = $db->query("UPDATE `users` SET `flag` = '$FLAG' WHERE `users`.`user_id` = '$UID';");
    // if($query->num_rows > 0){
    	header("Location:userDetails.php");
    // }
}



?>