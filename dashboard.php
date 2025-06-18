<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

$sec = "10";
header("Refresh: $sec;");

require 'header.php';

require_once 'cURLFunction.php';

$url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/counter.php';
$request = array();

$curlObj = new CURL;
$response = $curlObj->getjsondata($url,$request);

//echo $response;

$result = json_decode($response,true);
// print_r($result);

$currentRegisterUsers =  isset($result['count']['currentRegisterUsers']) ? $result['count']['currentRegisterUsers'] : 0 ;

$currentbidAllUsers   =  isset($result['count']['currentbidAllUsers']) ? $result['count']['currentbidAllUsers'] : 0 ;

$currentbidHighUsers  =  isset($result['count']['currentbidHighUsers']) ? $result['count']['currentbidHighUsers'] : 0 ;

$currentbidLowUsers   =   isset($result['count']['currentbidLowUsers']) ? $result['count']['currentbidLowUsers'] : 0;
?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <br>
                                                <h2><?php echo $currentRegisterUsers; ?></h2>
                                                <span>Register members</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <br>
                                                <h2><?php echo $currentbidAllUsers; ?></h2>
                                                <span>Current Slot Users</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <br>
                                                <h2><?php echo $currentbidHighUsers; ?></h2>
                                                <span>Users For High Bid</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <br>
                                                <h2><?php echo $currentbidLowUsers ?></h2>
                                                <span>Users For Low Bid</span>
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