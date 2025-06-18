<?php 
echo$product_name = $_REQUEST["product_name"];
echo$price = $_REQUEST["product_price"];
echo$name = $_REQUEST["name"];
echo$phone = $_REQUEST["phone"];
echo$email = $_REQUEST["email"];


include 'src/instamojo.php';

$api = new Instamojo\Instamojo('test_4c95f3cd9379e34c6d2d6661993', 'test_bea7043298a73b4243d707f1fb5','https://test.instamojo.com/api/1.1/');


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $product_name,
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
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
  ?>

<!--  

http://iqexpert.in/android_login_api/instamojo/pay.php?product_name=test&product_price=200&name=rohan&phone=1234512345&email=test@gmail.com  

==================================

https://test.instamojo.com/
Ideators@123

-->