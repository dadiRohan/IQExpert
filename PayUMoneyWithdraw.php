<?php
// session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'header.php';

require_once 'cURLFunction.php';

// $url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/PayUMoneyUsers.php';
$url = 'http://iqexpert.in/android_login_api/PayUMoneyUsers.php';
$request = array(
    /*"character" => $_REQUEST['value'],*/
);

$curlObj = new CURL;
$response = $curlObj->getjsondata($url,$request);

$result = json_decode($response,true);

?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid ">
                        <div class="overview-wrap">
                            <h2 class="title-1"><i class="zmdi zmdi-account-calendar"></i> PayUMoney Details</h2>
                        </div>
                        <br>
                        <div class="table-responsive table--no-card m-b-30">
                        <table id="example" class="table table-striped table-borderless table-earning" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Bank</th>
                                    <th>Account ID</th>
                                    <th>IFSC Code</th>
                                    <th>Withdrawal Amount</th>
                                    <th>Create At</th>
                                    <th>Payment Status</th>
                                    <th>UPDATE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($result)){
                                    foreach ($result as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value['FullName']; ?></td>
                                    <td><?php echo $value['BankName']; ?></td>
                                    <td><?php echo $value['AccountID']; ?></td>
                                    <td><?php echo $value['IFSC']; ?></td>
                                    <td><?php echo $value['withdrawalAmount']; ?></td>
                                    <td><?php echo $value['created_at']; ?></td>
                                    <form action="updatePayUMoneywithdraw.php" method="post">
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" name="PaymentStatus">
                                                <option value="<?php echo $value['Payment_status']; ?>"><?php echo $value['Payment_status']; ?></option>
                                                <?php if($value['Payment_status'] == 'Pending') {?>
                                                <option value="Done">Done</option>
                                                <?php }else{ ?>
                                                <option value="Pending">Pending</option>
                                                <?php }?>    
                                            </select>
                                        </div>
                                        <input type="hidden" name="tid" value="<?php echo $value['payU_id']; ?>">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-secondary" name="submit">Update</button>
                                    </td>
                                    </form>
                                    
                                </tr>
                             <?php
                                    }       
                                }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Bank</th>
                                    <th>Account ID</th>
                                    <th>IFSC Code</th>
                                    <th>Amount</th>
                                    <th>Create At</th>
                                    <th>Payment Status</th>
                                    <th>UPDATE</th>
                                </tr>
                            </tfoot>
                        </table>
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

  <!-- Modal -->
    <div class="modal " id="myModal" role="dialog">
        <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Profile</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
          
        </div>
    </div>
  <!-- The Modal -->


<?php
require 'footer.php';
?>

<script>
/*$(document).ready(function(){
    $('.openPopup').on('click',function(){
        var dataURL = $(this).attr('data-href');
        $('.modal-body').load(dataURL,function(){
            $('#myModal').modal({show:true});
        });
    }); 
});*/
</script>