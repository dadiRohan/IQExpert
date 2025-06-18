<?php
// error_reporting(E_ALL);
ini_set("display_errors", 0);

//$sec = "10";
//header("Refresh: $sec;");

require 'header.php';

require_once 'cURLFunction.php';

$url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/liveTransaction.php';
// $url = 'http://iqexpert.in/android_login_api/liveTransaction.php';
$request = array();

$curlObj = new CURL;
$response = $curlObj->getjsondata($url,$request);

//echo $response;

$result = json_decode($response,true);

$slotID =  $result[0]['slot_id'];

$LOW   =  $result[0]['LOW'];

$HIGH  =  $result[0]['HIGH'];

// print_r($result);

?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Live Bidding</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <br>
                                                <h2><?php echo $slotID; ?></h2>
                                                <span>SLOT ID</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <br>
                                                <h2><span class="fa fa-inr"></span> <?php echo $LOW; ?></h2>
                                                <span>LOW Amount</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <br>
                                                <h2><span class="fa fa-inr"></span> <?php echo $HIGH; ?></h2>
                                                <span>High Amount</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br><br><br><br><br><br><br>                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018. All rights reserved.</p>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
<?php
require 'footer.php';
?>