<?php 
ini_set('display_errors','on');

include 'include/instamojo.php';

if(isset($_REQUEST['product_name']) && isset($_REQUEST['product_price']) && isset($_REQUEST['name']) && isset($_REQUEST['phone']) && isset($_REQUEST['email'])){

    $product_name = $_REQUEST["product_name"];
    $price = $_REQUEST["product_price"];
    $name = $_REQUEST["name"];
    $phone = $_REQUEST["phone"];
    $email = $_REQUEST["email"];


    $api = new Instamojo\Instamojo('test_4c95f3cd9379e34c6d2d6661993', 'test_bea7043298a73b4243d707f1fb5','https://test.instamojo.com/api/1.1/');


    try {
        $response = $api->paymentRequestCreate(array(
            "purpose" => $product_name,
            "amount" => $price,
            "buyer_name" => $name,
            "phone" => $phone,
            "send_email" => false,
            "send_sms" => false,
            "email" => $email,
            'allow_repeated_payments' => false,
            "redirect_url" => "http://iqexpert.in/android_login_api/instamojo/thankyou.php",
            "webhook" => "http://iqexpert.in/android_login_api/instamojo/webhook.php"
            ));
        //print_r($response);

        $pay_ulr = $response['longurl'];
        
        //Redirect($response['longurl'],302); //Go to Payment page

        header("Location: $pay_ulr");
        exit();
    }
    catch (Exception $e) {
        print('Error: ' . $e->getMessage());
    }     
}
?>

<!--  

http://iqexpert.in/android_login_api/instamojo/pay.php?product_name=test&product_price=200&name=rohan&phone=1234512345&email=test@gmail.com  

==================================

Credentials
https://test.instamojo.com/
sablerohan61
Ideators@123

-->

<form action="" method="post">
    <input type="text" name="product_name" placeholder="product_name"><br>
    <input type="text" name="product_price" placeholder="product_price"><br>
    <input type="text" name="name" placeholder="name"><br>
    <input type="text" name="phone" placeholder="phone"><br>
    <input type="text" name="email" placeholder="email"><br>
    <input type="submit" name="">
</form>
