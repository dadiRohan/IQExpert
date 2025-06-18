<?php

ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

//FOR CURRENT SLOT CHECK
date_default_timezone_set('Asia/Calcutta');


// MAIN LOGIC
$userDetails	 	=	$db->GetPayUMoneyWithDrawl();

if($userDetails == 0){

}else{

	$response['error'] = TRUE;
	$response['error_msg'] = 'Data does not exist';

	echo json_encode($response);
}
?>