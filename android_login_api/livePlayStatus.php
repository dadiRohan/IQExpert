<?php

ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

//FOR CURRENT SLOT CHECK
date_default_timezone_set('Asia/Calcutta');

$time = date('H');

if($time == '10'){
	$slot = 'A';
}elseif ($time == '11') {
	$slot = 'B';
}elseif ($time == '12') {
	$slot = 'C';
}elseif ($time == '13') {
	$slot = 'D';
}elseif ($time == '14') {
	$slot = 'E';
}elseif ($time == '15') {
	$slot = 'F';
}elseif ($time == '16') {
	$slot = 'G';
}elseif ($time == '17') {
	$slot = 'H';
}elseif ($time == '18') {
	$slot = 'I';
}elseif ($time == '19') {
	$slot = 'J';
}elseif ($time == '20') {
	$slot = 'K';
}elseif ($time == '21') {
	$slot = 'L';
}elseif ($time >= '21' && $time < '10') {
	$slot = 'L';
}

// echo $slot;

//FOR LIVE SLOT CHECK

// MAIN LOGIC
if (isset($slot)) {

	$SlotNumber = $slot;

	$livePlayStatus	 	=	$db->livePlayStatus($SlotNumber);

	// $response['error'] = FALSE; 
	$response = $livePlayStatus;
	
	echo json_encode($response);
}else{

	$response['error'] = TRUE;
	$response['error_msg'] = 'Data does not exist';

	echo json_encode($response);
}
?>