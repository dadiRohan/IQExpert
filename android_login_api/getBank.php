<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();


if(isset($_REQUEST['uid'])){

	$uid = $_REQUEST['uid'];
	$getBank = $db->getUserBank($uid);

	if($getBank){

       	echo json_encode(array('AllBanks' =>$getBank));
	}
}else{

	$response['error'] = FALSE;
	$response['msg'] = 'Kindly need UID';

	echo json_encode($response);
}
