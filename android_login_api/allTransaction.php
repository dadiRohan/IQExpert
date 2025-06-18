<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

/*$allTransaction = $db->allTransaction();
print_r($allTransaction);*/

$data = $db->allTransaction();

$data1 = 0;

if($data1 == 0){

}else{

	$response["error"] = TRUE;
    $response["error_msg"] = "User`s not available!";
    echo json_encode($response);	
}

// print_r($data);

?>