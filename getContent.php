<?php
require 'header.php';

echo '<br><br><br>';

if(!empty($_GET['id'])){
    //DB details
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'iqexpert';

/*    $dbHost = 'localhost';
    $dbUsername = 'ideator1_admin';
    $dbPassword = 'admin@2017';
    $dbName = 'ideator1_iqexpert';*/


    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    if ($db->connect_error) {
        die("Unable to connect database: " . $db->connect_error);
    }
    
    // $query = $db->query("SELECT * FROM `users` WHERE user_id = {$_GET['id']}");
     $query = $db->query("SELECT * FROM `users` as ur INNER JOIN `tbl_user_device` as tud ON ur.user_id = tud.user_id   WHERE ur.user_id = {$_GET['id']}");
    
    if($query->num_rows > 0){
        $cmsData = $query->fetch_assoc();
?>



<div class="card border-primary mb-3" style="max-width: 30rem;">

  <h3 class="card-header">Profile</h3>
   <a href="userDetails.php" class="btn btn-outline-primary">Back</a>
  <div class="card-body">
    <h5>
     <img src="<?php echo $cmsData['ProfilePic'];?>" alt="NoPic" style="height: 100px;width: 100px;" class="rounded img-thumbnail"/>
     <span style="text-decoration:underline;"><?php echo $cmsData['name']; ?></span>
    </h5> 
  </div>

  <ul class="list-group list-group-flush">
    <li class="list-group-item"><p><b>Email ID   : </b><?php  echo $cmsData['email']; ?></p></li>
    <li class="list-group-item"><p><b>Mobile No  : </b><?php  echo $cmsData['mobnumber']; ?></p></li>
    <li class="list-group-item"><p><b>Device  : </b><?php  echo $cmsData['device_type']; ?></p></li>
    <li class="list-group-item"><p><b>Status : </b><?php  echo $cmsData['flag']; ?></p></li>
  </ul>
  <!-- <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div> -->
  <div class="card-footer text-muted">
    <p><b>Created At : </b><?php  echo $cmsData['created_at']; ?></p>
  </div>
</div>


<?php

    }else{
        echo 'Content not found....';
    }
}else{
    echo 'Content not found....';
}
?>

<?php
require 'footer.php';
?>
