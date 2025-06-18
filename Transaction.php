<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'header.php';

require_once 'cURLFunction.php';

$url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/allTransaction.php';
$request = array();

$curlObj = new CURL;
$response = $curlObj->getjsondata($url,$request);


$result = json_decode($response,true);

// print_r($result);

// $value = $_REQUEST['value'];

?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid ">
                        <div class="overview-wrap">
                            <?php
                             // echo $value;
                            ?>
                            <h2 class="title-1"><i class="zmdi zmdi-account-calendar"></i> User's Transaction</h2>
                            <?php
                                /*foreach ($result as $key => $value) {
                                    echo $value['name'];
                                    echo $value['u_id'];
                                    echo $value['HighValue'];
                                    echo $value['LowValue'];
                                    echo $value['TotalValue'];
                                    echo '<br>';
                                }*/
                            ?>
                        </div>
                        <br>
                        <div class="table-responsive table--no-card m-b-30">
                        <table id="example" class="table table-striped table-borderless table-earning" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>High Amount</th>
                                    <th>Low Amount</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($result as $key => $value) {
                                ?>
                                <tr>
                                    <td><b><?php echo $value['name']; ?></b></td>
                                    <td><span class="fa fa-inr"></span> <?php echo $value['HighValue']; ?></td>
                                    <td><span class="fa fa-inr"></span> <?php echo $value['LowValue']; ?></td>
                                    <td><span class="fa fa-inr"></span> <?php echo $value['TotalValue']; ?></td>
                                </tr>
                             <?php       
                                }
                            ?>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="">Name</th>
                                    <th class="">High Amount</th>
                                    <th class="">Low Amount</th>
                                    <th class="">Total Amount</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        
                        <!-- <div class="row"> -->
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="SearchTransaction.php?value=A" class="btn btn-outline-primary">A</a>
                        
                            <a href="SearchTransaction.php?value=B" class="btn btn-outline-primary">B</a>
                        
                            <a href="SearchTransaction.php?value=C" class="btn btn-outline-primary">C</a>
                        
                            <a href="SearchTransaction.php?value=D" class="btn btn-outline-primary">D</a>
                        
                            <a href="SearchTransaction.php?value=E" class="btn btn-outline-primary">E</a>
                        
                            <a href="SearchTransaction.php?value=F" class="btn btn-outline-primary">F</a>
                        
                            <a href="SearchTransaction.php?value=G" class="btn btn-outline-primary">G</a>
                        
                            <a href="SearchTransaction.php?value=H" class="btn btn-outline-primary">H</a>
                        
                            <a href="SearchTransaction.php?value=I" class="btn btn-outline-primary">I</a>
                        
                            <a href="SearchTransaction.php?value=J" class="btn btn-outline-primary">J</a>
                        
                            <a href="SearchTransaction.php?value=K" class="btn btn-outline-primary">K</a>
                        
                            <a href="SearchTransaction.php?value=L" class="btn btn-outline-primary">L</a>
                        
                            <a href="SearchTransaction.php?value=M" class="btn btn-outline-primary">M</a>
                        
                            <a href="SearchTransaction.php?value=N" class="btn btn-outline-primary">N</a>
                        
                            <a href="SearchTransaction.php?value=O" class="btn btn-outline-primary">O</a>
                        
                            <a href="SearchTransaction.php?value=P" class="btn btn-outline-primary">P</a>
                        
                            <a href="SearchTransaction.php?value=Q" class="btn btn-outline-primary">Q</a>
                        
                            <a href="SearchTransaction.php?value=R" class="btn btn-outline-primary">R</a>
                        
                            <a href="SearchTransaction.php?value=S" class="btn btn-outline-primary">S</a>
                        
                            <a href="SearchTransaction.php?value=T" class="btn btn-outline-primary">T</a>
                        
                            <a href="SearchTransaction.php?value=U" class="btn btn-outline-primary">U</a>
                        
                            <a href="SearchTransaction.php?value=V" class="btn btn-outline-primary">V</a>
                        
                            <a href="SearchTransaction.php?value=W" class="btn btn-outline-primary">W</a>
                        
                            <a href="SearchTransaction.php?value=X" class="btn btn-outline-primary">X</a>
                        
                            <a href="SearchTransaction.php?value=Y" class="btn btn-outline-primary">Y</a>
                        
                            <a href="SearchTransaction.php?value=Z" class="btn btn-outline-primary">Z</a>
                        </div>
                        <!-- </div> -->

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