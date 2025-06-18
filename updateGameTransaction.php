<?php

if(isset($_REQUEST['submit'])){

    $dbHost = 'localhost';//localhost
    $dbUsername = 'ideator1_admin';//root //ideator1_admin
    $dbPassword = 'admin@2017';// //admin@2017
    $dbName = 'ideator1_iqexpert';//iqexpert //ideator1_iqexpert
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    if ($db->connect_error) {
        die("Unable to connect database: " . $db->connect_error);
    }
    
    if(isset($_REQUEST['tid'])){
		$tid = $_REQUEST['tid'];
	}

	if(isset($_REQUEST['PaymentStatus'])){
		$PaymentStatus = $_REQUEST['PaymentStatus'];
	}

    //UPDATE `tbl_bid_transaction` SET `Payment_Status` = 'Done' WHERE `tbl_bid_transaction`.`t_id` = 2;
    $query = $db->query("UPDATE `tbl_bid_transaction` SET `Payment_Status` = '$PaymentStatus' WHERE `t_id` = '$tid';");
   	header("Location:GameTransaction.php");
}



?>