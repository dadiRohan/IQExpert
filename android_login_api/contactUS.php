<?php
ini_set('display_errors','on');
/*
Firstname
Lastname
EmailID
MobNo
Country 
State
City
*/

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

if(isset($_REQUEST['Firstname']) && isset($_REQUEST['Lastname']) && isset($_REQUEST['EmailID']) && isset($_REQUEST['MobNo']) && isset($_REQUEST['Country']) && isset($_REQUEST['State']) && isset($_REQUEST['City'])){


	$Firstname 	=	$_REQUEST['Firstname'];
	$Lastname	=	$_REQUEST['Lastname'];
	$EmailID	=	$_REQUEST['EmailID'];
	$MobNo		=	$_REQUEST['MobNo'];
	$Country	=	$_REQUEST['Country'];
	$City  		=	$_REQUEST['City'];
	$State      =   $_REQUEST['State'];

	if($contact = $db->contactUs($Firstname,$Lastname,$EmailID,$MobNo,$Country,$State,$City)){

		// echo 'Valid';
		$response['error'] = FALSE;
		$response['contact']['Firstname'] = $Firstname;
        $response['contact']['Lastname'] = $Lastname;
        $response['contact']['EmailID'] = $EmailID;
        //$response['contact']['MobNo'] = $MobNo;
        $response['contact']['Country'] = $Country;
        // $response['contact']['State'] = $State;

        echo json_encode($response);
	}else{

		// echo ' NOT contact';
	}
}else{

    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode($response);
}

?>