<?php
// session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'header.php';

require_once 'cURLFunction.php';

$url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/livePlayStatus.php';
$request = array(
    /*"character" => $_REQUEST['value'],*/
);

$curlObj = new CURL;
$response = $curlObj->getjsondata($url,$request);


$result = json_decode($response,true);

// print_r($result);

// $value = $_REQUEST['value'];
date_default_timezone_set('Asia/Calcutta');
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
 
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
 
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
 
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid ">
                        <div class="overview-wrap">
                            <?php
                             // echo $value;
                            ?>
                            <h2 class="title-1"><i class="zmdi zmdi-account-calendar"></i> LIVE Status</h2>
                            <!-- <button type="button" class="btn btn-outline-primary">
                                <a href="Transaction.php">Back</a>
                            </button> -->
                            <?php
                                /*foreach ($result as $key => $value) {
                                    echo $value['name'];
                                    echo $value['slot_id'];
                                    echo $value['amount'];
                                    echo $value['created_at'];
                                    echo '<br>';
                                }*/
                                // print_r($result);
                                // echo 1;
                            ?>
                        </div>
                        <br>
                        <div class="table-responsive table--no-card m-b-30">
                        <table id="example" class="table table-striped table-borderless table-earning" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slot</th>
                                    <th>Bid</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($result)){
                                    foreach ($result as $key => $value) {
                                ?>
                                <tr>
                                    <td><b><?php echo $value['name']; ?></b></td>
                                    <td><?php echo $value['slot_id']; ?></td>
                                    <td><?php echo $value['bid']; ?></td>
                                    <td><?php echo $value['amount']; ?></td>
                                    <td><?php echo time_elapsed_string($value['created_at']); ?></td>
                                </tr>
                             <?php
                                    }       
                                }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="">Name</th>
                                    <th class="">Slot</th>
                                    <th class="">Bid</th>
                                    <th class="">Amount</th>
                                    <th class="">Created At</th>
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

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
<?php
require 'footer.php';
?>