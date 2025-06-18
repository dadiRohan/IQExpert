<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'cURLFunction.php';

$url = 'LINK/login.php';

if(!empty($_REQUEST['email'])){
    
    $request = array(
        "email" => $_REQUEST['email'],
        "password" => $_REQUEST['password'],
    );

    $curlObj = new CURL;
    $response = $curlObj->getarraydata($url,$request);

    // print_r($response);
    if($response['error'] == 1){

        print_r($response);
    }else{
        $_SESSION['user'] = $response['user']['name'];
        header('Location:CURL.php');
    }
}

?>


<h1>Login</h1>
<form action="" method="post" >
    <input type="email" name="email" placeholder="email" /><br/>
    <input type="password" name="password" placeholder="password" /><br/>
    <input type="submit" name="submit"/>
</form>