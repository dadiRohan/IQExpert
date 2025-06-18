<?php
// session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'header.php';
    
    if(isset($_REQUEST['newPassword'])){
        // $currPassword = trim($_REQUEST['currPassword']);
        $newPassword  = trim($_REQUEST['newPassword']);
        $rePassword   = trim($_REQUEST['rePassword']);
    //for update password

    $con = mysqli_connect("localhost","root","","iqexpert");
    // $con = mysqli_connect("localhost","ideator1_admin","admin@2017","ideator1_iqexpert");
    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if($newPassword == $rePassword){

        $newPassword = base64_encode($newPassword);

        $query = "UPDATE `tbl_admin` SET `password` = '".$newPassword."' WHERE `tbl_admin`.`username` = '".$username."'";
        $result = mysqli_query($con,$query) or die(mysql_error());
        
        $err_msg = 'Password has been Changed Successfully new password is : '.$rePassword.'';
    }else{

        $err_msg = 'Does not Matched Password!';
    }
}

//UPDATE `tbl_admin` SET `password` = 'QWRtaW5AMTIz=' WHERE `tbl_admin`.`username` = 'Zafar'

?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid ">
                        
                        <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">Change Password</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2"></h3>
                                        </div>
                                        <hr>
                                        <form action="" method="post" >
                                            <!-- <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Current Password</label>
                                                <input id="cc-pament" name="currPassword" type="password" class="form-control" >
                                            </div> -->
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Create New Password</label>
                                                <input id="cc-name" name="newPassword" type="password" class="form-control" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Retype New Password</label>
                                                <input id="cc-number" name="rePassword" type="password" class="form-control" required="required">
                                            </div>
                                            <div class="form-group">
                                                <?php if (isset($err_msg)) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <?php
                                                        echo $err_msg;
                                                    ?>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Submit</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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