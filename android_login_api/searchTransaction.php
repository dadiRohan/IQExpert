<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

/*$searchTransaction = $db->searchTransaction();
print_r($searchTransaction);*/

if(isset($_REQUEST['character'])){

	$character 			=	 $_REQUEST['character'];
	$searchTransaction 	=	 $db->searchTransaction($character);
	// echo 'done';

	echo json_encode($searchTransaction);

}else{

	$response["error"] = TRUE;
    $response["error_msg"] = "User`s not available!";
    echo json_encode($response);	
}


?>