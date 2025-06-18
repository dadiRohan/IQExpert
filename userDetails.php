<?php
// session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'header.php';

require_once 'cURLFunction.php';

$url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/userDetails.php';
// $url = 'http://iqexpert.in/android_login_api/userDetails.php';
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
                            <h2 class="title-1"><i class="zmdi zmdi-account-calendar"></i> User Details</h2>
                        </div>
                        <br>
                        <div class="table-responsive table--no-card m-b-30">
                        <table id="example" class="table table-striped table-borderless table-earning" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>UPDATE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($result)){
                                    foreach ($result as $key => $value) {
                                ?>
                                <tr>
                                    <td>
                                        <?php 
                                            if(isset($value['ProfilePic'])){
                                            ?>
                                            <!-- <a href="#" data-href="getContent.php?id=<?php echo $value['user_id']; ?>" class="openPopup"> -->
                                            <a href="getContent.php?id=<?php echo $value['user_id']; ?>" data-href="#" class="openPopup">
                                            <img src="<?php echo $value['ProfilePic']; ?>" alt="NoPic" style="height: 55px;width: 55px;" class="rounded img-thumbnail"/>
                                            </a>
                                            <?php    
                                            }
                                        ?>
                                        <b><?php echo $value['name']; ?></b>
                                    </td>
                                    <td><?php echo $value['email']; ?></td>
                                    <form action="updateProfile.php" method="post">
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" name="flag">
                                                <option value="<?php echo $value['flag']; ?>"><?php echo $value['flag']; ?></option>
                                                <?php if($value['flag'] == 'Enable') {?>
                                                <option value="Disable">Disable</option>
                                                <?php }else{ ?>
                                                <option value="Enable">Enable</option>
                                                <?php }?>    
                                            </select>
                                        </div>
                                        <input type="hidden" name="uid" value="<?php echo $value['user_id']; ?>">
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
                                    <th class="">Name</th>
                                    <th class="">Email</th>
                                    <th class="">status</th>
                                    <th class="">update</th>
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