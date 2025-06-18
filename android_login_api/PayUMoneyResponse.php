<?php
//New Code
function getHashes($txnid, $amount, $productinfo, $firstname, $email, $user_credentials, $udf1, $udf2, $udf3, $udf4, $udf5,$offerKey,$cardBin)
{
      // $firstname, $email can be "", i.e empty string if needed. Same should be sent to PayU server (in request params) also.
      $key = '2lr2McyI';//'Byq8Rh9b';
      $salt = 'nEH51538If';//'J37Z00L99p';

      $payhash_str = $key . '|' . checkNull($txnid) . '|' .checkNull($amount)  . '|' .checkNull($productinfo)  . '|' . checkNull($firstname) . '|' . checkNull($email) . '|' . checkNull($udf1) . '|' . checkNull($udf2) . '|' . checkNull($udf3) . '|' . checkNull($udf4) . '|' . checkNull($udf5) . '||||||' . $salt;
      $paymentHash = strtolower(hash('sha512', $payhash_str));
      $arr['payment_hash'] = $paymentHash;

      $cmnNameMerchantCodes = 'get_merchant_ibibo_codes';
      $merchantCodesHash_str = $key . '|' . $cmnNameMerchantCodes . '|default|' . $salt ;
      $merchantCodesHash = strtolower(hash('sha512', $merchantCodesHash_str));
      $arr['get_merchant_ibibo_codes_hash'] = $merchantCodesHash;

      $cmnMobileSdk = 'vas_for_mobile_sdk';
      $mobileSdk_str = $key . '|' . $cmnMobileSdk . '|default|' . $salt;
      $mobileSdk = strtolower(hash('sha512', $mobileSdk_str));
      $arr['vas_for_mobile_sdk_hash'] = $mobileSdk;

      $cmnPaymentRelatedDetailsForMobileSdk1 = 'payment_related_details_for_mobile_sdk';
      $detailsForMobileSdk_str1 = $key  . '|' . $cmnPaymentRelatedDetailsForMobileSdk1 . '|default|' . $salt ;
      $detailsForMobileSdk1 = strtolower(hash('sha512', $detailsForMobileSdk_str1));
      $arr['payment_related_details_for_mobile_sdk_hash'] = $detailsForMobileSdk1;

      //used for verifying payment(optional)  
      $cmnVerifyPayment = 'verify_payment';
      $verifyPayment_str = $key . '|' . $cmnVerifyPayment . '|'.$txnid .'|' . $salt;
      $verifyPayment = strtolower(hash('sha512', $verifyPayment_str));
      $arr['verify_payment_hash'] = $verifyPayment;

      if($user_credentials != NULL && $user_credentials != '')
      {
            $cmnNameDeleteCard = 'delete_user_card';
            $deleteHash_str = $key  . '|' . $cmnNameDeleteCard . '|' . $user_credentials . '|' . $salt ;
            $deleteHash = strtolower(hash('sha512', $deleteHash_str));
            $arr['delete_user_card_hash'] = $deleteHash;

            $cmnNameGetUserCard = 'get_user_cards';
            $getUserCardHash_str = $key  . '|' . $cmnNameGetUserCard . '|' . $user_credentials . '|' . $salt ;
            $getUserCardHash = strtolower(hash('sha512', $getUserCardHash_str));
            $arr['get_user_cards_hash'] = $getUserCardHash;

            $cmnNameEditUserCard = 'edit_user_card';
            $editUserCardHash_str = $key  . '|' . $cmnNameEditUserCard . '|' . $user_credentials . '|' . $salt ;
            $editUserCardHash = strtolower(hash('sha512', $editUserCardHash_str));
            $arr['edit_user_card_hash'] = $editUserCardHash;

            $cmnNameSaveUserCard = 'save_user_card';
            $saveUserCardHash_str = $key  . '|' . $cmnNameSaveUserCard . '|' . $user_credentials . '|' . $salt ;
            $saveUserCardHash = strtolower(hash('sha512', $saveUserCardHash_str));
            $arr['save_user_card_hash'] = $saveUserCardHash;

            $cmnPaymentRelatedDetailsForMobileSdk = 'payment_related_details_for_mobile_sdk';
            $detailsForMobileSdk_str = $key  . '|' . $cmnPaymentRelatedDetailsForMobileSdk . '|' . $user_credentials . '|' . $salt ;
            $detailsForMobileSdk = strtolower(hash('sha512', $detailsForMobileSdk_str));
            $arr['payment_related_details_for_mobile_sdk_hash'] = $detailsForMobileSdk;
      }


      // if($udf3!=NULL && !empty($udf3)){
            $cmnSend_Sms='send_sms';
            $sendsms_str=$key . '|' . $cmnSend_Sms . '|' . $udf3 . '|' . $salt;
            $send_sms = strtolower(hash('sha512',$sendsms_str));
            $arr['send_sms_hash']=$send_sms;
      // }


      if ($offerKey!=NULL && !empty($offerKey)) {
                  $cmnCheckOfferStatus = 'check_offer_status';
                        $checkOfferStatus_str = $key  . '|' . $cmnCheckOfferStatus . '|' . $offerKey . '|' . $salt ;
                  $checkOfferStatus = strtolower(hash('sha512', $checkOfferStatus_str));
                  $arr['check_offer_status_hash']=$checkOfferStatus;
            }


            if ($cardBin!=NULL && !empty($cardBin)) {
                  $cmnCheckIsDomestic = 'check_isDomestic';
                        $checkIsDomestic_str = $key  . '|' . $cmnCheckIsDomestic . '|' . $cardBin . '|' . $salt ;
                  $checkIsDomestic = strtolower(hash('sha512', $checkIsDomestic_str));
                  $arr['check_isDomestic_hash']=$checkIsDomestic;
            }



    return $arr;
}

function checkNull($value) {
            if ($value == null) {
                  return '';
            } else {
                  return $value;
            }
      }


if(isset($_REQUEST['user_credentials'])){
      $_REQUEST['user_credentials'] = $_REQUEST['user_credentials'];
}else{
      $_REQUEST['user_credentials'] = NULL;
}

if(isset($_REQUEST['offerKey'])){
      $_REQUEST['offerKey'] = $_REQUEST['offerKey'];
}else{
      $_REQUEST['offerKey'] = NULL;
}

if(isset($_REQUEST['cardBin'])){
      $_REQUEST['cardBin'] = $_REQUEST['cardBin'];
}else{
      $_REQUEST['cardBin'] = NULL;
}


$output=getHashes($_REQUEST["txnid"], $_REQUEST["amount"], $_REQUEST["productinfo"], $_REQUEST["firstname"], $_REQUEST["email"], $_REQUEST["user_credentials"], $_REQUEST["udf1"], $_REQUEST["udf2"], $_REQUEST["udf3"], $_REQUEST["udf4"], $_REQUEST["udf5"],$_REQUEST["offerKey"],$_REQUEST["cardBin"]);

echo json_encode($output);

?>
