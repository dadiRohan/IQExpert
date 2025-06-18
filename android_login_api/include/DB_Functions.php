<?php
class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password, $mobnumber, $uu_id, $device_type, $device_id){

        date_default_timezone_set('Asia/Calcutta');

        $uuid = uniqid('', true);

        $ProfilePic = 'http://iqexpert.in/android_login_api/card/ICO.jpg'; //For Profile Pic URL

        $encrypted_password = base64_encode($password);            

        $date = date('Y-m-d H:i:s');

        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, name, email, encrypted_password, mobnumber , ProfilePic, created_at) VALUES(?, ?, ?, ?, ?, ?, '$date')");
        $stmt->bind_param("ssssss", $uuid, $name, $email, $encrypted_password, $mobnumber, $ProfilePic);
        $result = $stmt->execute();

    /*For Values insert into second Table Start*/
        $curr_id = $this->conn->insert_id; 

        $stmt = $this->conn->prepare("INSERT INTO `tbl_user_device` (`user_id`, `uuid`, `device_type`, `device_id`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, '$date', '$date')");
        $stmt->bind_param("isss", $curr_id, $uu_id, $device_type, $device_id);
        $result_next = $stmt->execute();
    /*For Values insert into second Table End*/

        $stmt->close();

       // More condition for user device table     
        if($result_next){ 

            // INNER JOIN For 2 Tables                
            $result_next = mysqli_query($this->conn,"SELECT * FROM `tbl_user_device` INNER JOIN `users` ON `tbl_user_device`.`user_id` = `users`.`user_id` WHERE `users`.`email` = '$email'");
 
            if(mysqli_num_rows($result_next) > 0){
                while($user_next = mysqli_fetch_assoc($result_next)){
                    return $user_next;
                }  
            }
        // check for successful store
        }else if ($result) {

            $result = mysqli_query($this->conn,"SELECT * FROM users WHERE email = '$email'");
            
            if(mysqli_num_rows($result) > 0){
                while($user = mysqli_fetch_assoc($result)){
                    return $user;
                }  
             }
        }else {
     
            return false;
        }
    }



    /*
     * FCM Push Notification Get All DeviceID's
     * returns details
     *
     */
    public function getDeviceID(){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $data = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $curr = "SELECT device_id FROM `tbl_user_device` WHERE 1";
        $result = mysqli_query($conn,$curr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($getDeviceID = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $getDeviceID;
            }
        }
    }   


    /**
     * Updating existing user
     * returns details
     */
    public function updateUser($uniqueId){
        
        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';
      
        // Create connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } 

        //UPDATE `users` SET `unique_id` = '5b03e8c91a09d8.57302206', `name` = 'Rohan', `email` = 'rohansable1@gmail.com', `encrypted_password` = '6WsLat8EqsxLzmi9EOTDqE3zQDo4Y2FkOTRmODUy=', `mobnumber` = '1893939393', `ProfilePic` = 'http://test.com', `created_at` = '', `updated_at` = '2018-05-22 19:24:17' WHERE `users`.`user_id` = 1;

        $name       =   $_REQUEST['name'];
        $email      =   $_REQUEST['email'];

        //NEW CODE FOR Profile PIC Start
            $temp = explode(".", $_FILES["image"]["name"]);
            $file_name = round(microtime(true)) . '.' . end($temp);

            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
          
            $expensions= array("jpeg","jpg","png");
          
            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
          
            /*if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }*/
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"uploads/".$file_name);
                //$url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/uploads/'.$file_name;
                $url = 'http://iqexpert.in/android_login_api/uploads/'.$file_name;
                }else{
                $url = 'NO DATA';
            }    
        //NEW CODE FOR Profile PIC End

        $mobnumber  =   $_REQUEST['mobnumber'];
        $updated_at =   date('Y-m-d H:i:s');
           
        $result = "UPDATE `users` SET `name` = '$name', `email` = '$email', `mobnumber` = '$mobnumber', `ProfilePic` = '$url', `updated_at` = '$updated_at' WHERE `users`.`unique_id` = '$uniqueId'";

        if(mysqli_query($conn,$result)){

            // return true;
            $response['error'] = FALSE;
            $response['user']['uid'] = $uniqueId;
            $response['user']['name'] = $name;
            $response['user']['email'] = $email;
            $response['user']['ProfilePic'] = $url;
            $response['user']['mobnumber'] = $mobnumber;

            $response['user']['uuid'] = $_REQUEST['uuid'];

            echo json_encode($response);
        }else{

            return false;
        }
    }

    /**
     * Deleting existing user
     * returns details
     */
    public function deleteUser($uniqueId){

        require_once 'Config.php';
      
        // Create connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } 

        $result = "UPDATE `users` SET `flag` = 'Disable' WHERE `users`.`unique_id` = '$uniqueId'";

        if(mysqli_query($conn,$result)){

            return true;
        }else{

            return false;
        }
    }

    /**
     * Get user by email and password
     */
        public function getUserByEmailAndPassword($email, $password, $DeviceID) {
        
        $encrypted_password = base64_encode($password);

          
        $result = mysqli_query($this->conn,"SELECT * FROM `users` INNER JOIN `tbl_user_device` ON `users`.`user_id` = `tbl_user_device`.`user_id` WHERE `users`.email = '$email' AND `users`.`encrypted_password` = '$encrypted_password' AND flag='Enable';");    
        if(mysqli_num_rows($result) > 0){

            //For Update Device
            $updateDevice = mysqli_query($this->conn,"UPDATE users AS ur INNER JOIN tbl_user_device AS tud ON ur.user_id = tud.user_id SET tud.device_id = '$DeviceID' WHERE ur.email = '$email' AND ur.`encrypted_password` = '$encrypted_password' AND ur.flag='Enable';");

            while($user = mysqli_fetch_assoc($result)){
                return $user;
            }
        }
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_decode(sha1($password . $salt) . $salt);

        return $hash;
    }



    /**
     * Storing Slot Data method 
     */
    function putRand(){

        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';
      
        // Create connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        //for checking latest data
        $date       =   date("Y-m-d");
        //for checking latest time
        $time       =   date("H:").'00';

        //for created date
        $createdDate   =   date("Y-m-d H:i:s");

        //for updated date
        $updatedDate   =   date("Y-m-d H:i:s");

        // 12 Slots
        $playSlotName0 = 'AA';
        $playSlotName1 = 'A';
        $playSlotName2 = 'B';
        $playSlotName3 = 'C';
        $playSlotName4 = 'D';
        $playSlotName5 = 'E';
        $playSlotName6 = 'F';
        $playSlotName7 = 'G';
        $playSlotName8 = 'H';
        $playSlotName9 = 'I';
        $playSlotName10 = 'J';
        $playSlotName11 = 'K';
        $playSlotName12 = 'L';

        // 12 Random values for every slot 
        $digits = 6;
        $value0 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value1 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value2 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value3 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value4 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value5 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value6 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value7 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value8 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value9 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value10 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value11 = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $value12 = rand(pow(10, $digits-1), pow(10, $digits)-1);


        /*$sql ="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate`) VALUES ('$playSlotName1', '$date', '10:00', '$value1', '$createdDate', '$updatedDate');";*/
        $sql ="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate`) VALUES ('$playSlotName0', '$date', '09:00', '$value0', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate`) VALUES ('$playSlotName1', '$date', '10:00', '$value1', '$createdDate', '$updatedDate');";

        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName2', '$date', '11:00', '$value2', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName3', '$date', '12:00', '$value3', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName4', '$date', '13:00', '$value4', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName5', '$date', '14:00', '$value5', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName6', '$date', '15:00', '$value6', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate`) VALUES ('$playSlotName7', '$date', '16:00', '$value7', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName8', '$date', '17:00', '$value8', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName9', '$date', '18:00', '$value9', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName10', '$date', '19:00', '$value10', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName11', '$date', '20:00', '$value11', '$createdDate', '$updatedDate');";
        $sql .="INSERT INTO `tbl_gen_rand` (`playSlot`, `date`, `time`, `randValue`, `CreatedDate`, `updatedDate` ) VALUES ('$playSlotName12', '$date', '21:00', '$value12', '$createdDate', '$updatedDate');";
        
        
        if ($conn->multi_query($sql) === TRUE) {
  
            // echo "New record created successfully";
            $response["error"] = FALSE;
            $response[]["msg"] = "Data has been inserted Successfully !";

            echo json_encode($response);
            // return $response;
        } else {
  
            // echo "Error: " . $sql . "<br>" . $conn->error;
            $response["error"] = TRUE;
            $response[]["msg"] = "Error: " . $sql . "<br>" . $conn->error;
      
            echo json_encode($response);
            // return $response;
        }
    }

    /**
     * Update Slot Data 
     */
    function updateRand(){

        date_default_timezone_set('Asia/Calcutta'); 

        // Create connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        $today_date = date("Y-m-d");
        
        $currTime = date("H:").'00';
        $result = mysqli_query($conn,"UPDATE `tbl_gen_rand` SET `status` = 'active' WHERE `tbl_gen_rand`.`date` = '$today_date' AND `tbl_gen_rand`.`time` = '$currTime';");

        $prevresult = mysqli_query($conn,"UPDATE `tbl_gen_rand` SET `status` = 'pending' WHERE `tbl_gen_rand`.`date` = '$today_date' AND `tbl_gen_rand`.`time` > '$currTime';");

        $nextresult = mysqli_query($conn,"UPDATE `tbl_gen_rand` SET `status` = 'inactive' WHERE `tbl_gen_rand`.`date` = '$today_date' AND `tbl_gen_rand`.`time` < '$currTime';");
        

        if (($result)>0 && ($prevresult)>0 &&($nextresult)>0) {

            // echo "New record updated successfully";
            return $result;
        } else {

            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }

    /**
     * Get Slot Data 
     */    
    function getRand(){

        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';
      
        // Create connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        $today_date = date("Y-m-d");    

        //For 1st Attempt not inactive
        /*if(date('H:i') < '11:00'){
            $result = mysqli_query($conn,"SELECT * FROM `tbl_gen_rand` WHERE `date` = '$today_date';");
        }else{
            $result = mysqli_query($conn,"SELECT * FROM `tbl_gen_rand` WHERE `date` = '$today_date' AND `status` != 'inactive';");
        }*/

        // $result = mysqli_query($conn,"SELECT * FROM `tbl_gen_rand` WHERE `date` = '$today_date';");
        $result = mysqli_query($conn,"SELECT * FROM `tbl_gen_rand` WHERE `date` = '$today_date' AND `status` != 'inactive';");
        

        if (mysqli_num_rows($result)>0) {

            // echo "New record created successfully";
        } else {

            echo "Error: " . $result . "<br>" . $conn->error;
        }

        while($row = mysqli_fetch_all($result,MYSQLI_ASSOC)){
            return $row;
        }
    }


    /**
     * Add User Bank Details
     * returns details
     */
    public function addUserBank($uid,$bankUUID,$bankName,$accHolderName,$bankBranch,$AccNo,$IFSC){

        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d H:i:s');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        $bank = "INSERT INTO `tbl_bank_details` (`bank_id`, `bank_uuid`,`unique_id`, `bank_name`, `acc_holder_name`, `bank_branch`, `acc_no`, `IFSC_code`, `created_at`, `updated_at`) VALUES (NULL, '$bankUUID','$uid','$bankName', '$accHolderName', '$bankBranch', '$AccNo', '$IFSC', '$date', '0000-00-00 00:00:00')";

        //$bank = "INSERT INTO `tbl_bank_details` (`unique_id`, `card_number`, `card_validity`, `card_cvv`, `card_name`, `card_type`, `created_at`) VALUES ('$uid', '$cardNumber', '$cardValidity', '$cardCVV', '$cardName','$cardType', '$date')";

        if(mysqli_query($conn,$bank)){

            return true;
        }else{

            // return false;
            $response['error'] = TRUE;
            $response['error_msg'] = ' Kindly Enter Correct Details !';

            echo json_encode($response);
        }
    }


    /**
     * UPDATE User Bank Details
     * returns details
     */
    public function updateUserBank($uid,$bankUUID,$bankName,$accHolderName,$bankBranch,$AccNo,$IFSC){
        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $date = date("Y-m-d H:i:s");

        $sql = "UPDATE `tbl_bank_details` SET `acc_holder_name` = '$accHolderName', `bank_branch` = '$bankBranch', `acc_no` = '$AccNo', `IFSC_code` = '$IFSC', `updated_at` = '$date', `bank_name` = '$bankName', `unique_id` = '$uid' WHERE `bank_uuid` = '$bankUUID' ";

        // $sql = "UPDATE `tbl_bank_details` SET `card_number` = '$cardNumber', `card_validity` = '$cardValidity', `card_cvv` = '$cardCVV', `updated_at` = '$date' WHERE `tbl_bank_details`.`unique_id` = '$uid' AND `tbl_bank_details`.`card_name` = '$cardName'";

        if(mysqli_query($conn,$sql)){

            return true;
        }else{

            return false;
        }        
    }


    /**
     * DELETE User Bank Details
     * returns details
     */
    // public function deleteBank($uid,$bankName){
    public function deleteBank($uid,$bankUUID){
        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $date = date("Y-m-d H:i:s");

        // $sql = "DELETE FROM `tbl_bank_details` WHERE unique_id = '$uid' AND bank_name = '$bankName';";
        $sql = "DELETE FROM `tbl_bank_details` WHERE unique_id = '$uid' AND bank_uuid = '$bankUUID';";

        if(mysqli_query($conn,$sql)){

            return true;
        }else{

            return false;
        }        
    }

    /**
     * Count User Bank Details
     * returns details
     */
    public function countBank($uid){
        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $date = date("Y-m-d H:i:s");

       //SELECT count(*) as count FROM `tbl_bank_details` WHERE unique_id = '5b16384f4b8504.39394722';
        $sql = "SELECT count(*) as count FROM `tbl_bank_details` WHERE unique_id = '$uid'";

        $result = mysqli_query($conn,$sql);

        while($count = mysqli_fetch_all($result,MYSQLI_ASSOC)){
            return $count[0]['count'];
        }
    } 

    /**
     * GET User Bank Details
     * returns details
    */
    public function getUserBank($uid){

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $result = mysqli_query($conn,"SELECT * FROM `tbl_bank_details` WHERE `unique_id` = '$uid'");
        

        if (mysqli_num_rows($result)>0) {

            // echo "New record created successfully";
        } else {

            //echo "Error: " . $result . "<br>" . $conn->error;
            $response['error'] = TRUE;
            $response['msg'] = 'Data didn`t Get';

            echo json_encode($response);
        }

        while($userBank = mysqli_fetch_all($result,MYSQLI_ASSOC)){
            return $userBank;
        }
    }    

    /**
     * Add Generate wallet Details
     * returns details
     */
    public function generateWallet($uid){

        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $walletUniqueId = rand(1000,9000);

        $wallet = "INSERT INTO `tbl_wallet` (`unique_id`, `wallet_unique_id`, `created_at`) VALUES ('$uid', '$walletUniqueId', NOW())";

        if(mysqli_query($conn,$wallet)){

            return true;
        }else{

            return false;
        }
    }


    /**
     * Add User wallet Details
     * returns details
     */
    public function userWallet($uid,$amount){

        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        if($conn->connect_error){

            die("Connection failed :" . $conn->connect_error);
        }
        //INSERT INTO `tbl_user_wallet` (`wallet_user_id`, `unique_id`, `wallet_unique_id`, `initial_amount`, `deposit_amount`, `total_amount`, `created_at`, `modified_at`) VALUES (NULL, '5b0e4fa30932f8.68641195', '5838', '200', '100', '100', '13', '');
        $userWallet = "INSERT INTO `tbl_user_wallet` (`unique_id`, `wallet_unique_id`, `initial_amount`, `deposit_amount`, `total_amount`, `created_at`) VALUES ('$uid', '5838', '$amt', '0', '0', NOW())";

        if(mysqli_query($conn,$userWallet)){

            return true;
        }else{

            return false;
        }
    }


    /**
     * Add User Bank Details
     * returns details
     */
    public function bankCardValidation($cardNumber){

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        $validCard = "SELECT *  FROM `tbl_bank_details` WHERE `card_number` = '$cardNumber'";

        if(mysqli_query($conn,$validCard)){

            // return false;
            $response['error'] = FALSE;
            $response['error']['cardNumber'] = ' '.$cardNumber.' Already Exist !';

            echo json_encode($response);
        }else{

            return false;
        }
    }

    
    /* 
     * Add Bid Transaction Against Each User  WALLET UPDATE
     * returns details
     */
    public function bidTransaction($SlotID,$SlotNumber,$randValue,$bid,$amount,$status,$orderId,$paymentId,$token,$UID,$email,$mobnumber){

        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d H:i:s');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        $wallet = "UPDATE tbl_users_wallet SET totalAmount = totalAmount-'$amount' WHERE unique_id = '$UID';";
        mysqli_query($conn,$wallet);

        $inset = "INSERT INTO `tbl_bid_transaction` (`slot_id`,`slot_number`, `randValue`, `bid`, `amount`, `status`, `order_id`, `payment_id`, `token`, `u_id`, `email`, `mobnumber`, `created_at`) VALUES ('$SlotID','$SlotNumber', '$randValue','$bid', '$amount', '$status', '$orderId', '$paymentId', '$token', '$UID', '$email', '$mobnumber', '$date')";

        if(mysqli_query($conn,$inset)){

            return true;
        }else{

            return false;
        }
    }

    /**
     * Count Bid Users in Current Slot
     * returns details
     */
    public function countbidUsers($SlotNumber){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        //SELECT count(*)  FROM `tbl_bid_transaction` WHERE `slot_id` = 'A' AND `created_at` LIKE '%2018-06-05%'
        $inset = mysqli_query($conn,"SELECT count(*) as ctn  FROM `tbl_bid_transaction` WHERE `slot_id` = '$SlotNumber' AND `created_at` LIKE '%$date%'" ) or die(mysqli_error($conn));

        $countAll = mysqli_fetch_object($inset);

        $count = $countAll->ctn;        
        return $count;
    }

    /**
     * Create New Random Number because Suffle
     * returns details
     */
    public function generateNewRandom($SlotNumber,$randValue,$newrandValue){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        if($conn->connect_error) {
            die("connection failed: ". $conn->connect_error);
        }

        $gen = "UPDATE `tbl_gen_rand` SET `new_randValue` = '$newrandValue' WHERE `tbl_gen_rand`.`playSlot` = '$SlotNumber' AND `tbl_gen_rand`.`date` = '$date' AND `tbl_gen_rand`.`randValue` = '$randValue'";
        mysqli_query($conn,$gen);
        
        $get = "SELECT `playSlot`,`randValue`,`new_randValue` FROM `tbl_gen_rand` WHERE `tbl_gen_rand`.`playSlot` = '$SlotNumber' AND `tbl_gen_rand`.`date` = '$date' AND `tbl_gen_rand`.`randValue` = '$randValue'";

        $result = mysqli_query($conn,$get);
        if(mysqli_num_rows($result) > 0){
            while($user = mysqli_fetch_assoc($result)){
                return $user;
            }
        }
    }


    /**
     * Display New Random Number because Suffle
     * returns details
     */
    public function updatedNewRandom($SlotNumber){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        if($conn->connect_error) {
            die("connection failed: ". $conn->connect_error);
        }
        
        $get = "SELECT `playSlot`,`randValue`,`new_randValue` FROM `tbl_gen_rand` WHERE `tbl_gen_rand`.`playSlot` = '$SlotNumber' AND `tbl_gen_rand`.`date` = '$date'";

        $result = mysqli_query($conn,$get);
        if(mysqli_num_rows($result) > 0){
            while($user = mysqli_fetch_assoc($result)){
                return $user;
            }
        }
    }


    /** #with CALL PROCEDURE
     *
     * Get Bid Users Details in current Slot
     * returns details
     *
     */
    public function getbidUsersDetails($SlotNumber){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $data = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        $call = "CALL BidMgmt('$SlotNumber')";
        //$call = "CALL BidMgmtwithdate('$SlotNumber','$data')";
        mysqli_query($conn,$call);

        //$inset = "SELECT *  FROM `tbl_bid_transaction` WHERE `slot_number` = '$SlotNumber' AND `created_at` LIKE '%$data%'";

        $inset = "SELECT slot_number as SlotNumber,slot_id as SlotID,randValue,bid as bidStatus,amount,bid_pro_loss as bidProLoss,finalAmount as finalAmount, u_id as UID FROM `tbl_bid_transaction` WHERE `slot_number` = '$SlotNumber' AND `created_at` LIKE '%$data%'";

        $result = mysqli_query($conn,$inset);

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($bid = mysqli_fetch_all($result,MYSQLI_ASSOC)){
            // while($bid = mysqli_fetch_assoc($result)){
                return $bid;
            }
        }
    }

    /*
     * Get Current Play Result
     * returns details
     *
     */
    public function currPlayResult($SlotID,$SlotNumber){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $data = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $curr = "SELECT slot_number, slot_id, u_id, amount, bid_pro_loss, created_at FROM `tbl_bid_transaction` WHERE slot_id='$SlotID' AND slot_number='$SlotNumber'";
        // $curr = "CALL currPlayResult('$SlotID','$SlotNumber')";
        $result = mysqli_query($conn,$curr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($currPlayResult = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $currPlayResult;
            }
        }
    }   


     /*
     * Search HISTORY Play Result 
     * returns details
     *
     */
    public function searchHistoryPlay($UID,$IndexID = 0,$fromDate,$toData){
        require_once 'Config.php';        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        
        
        $Initial = $IndexID.'0';

        $sear =  "SELECT slot_id as SlotNumber,randValue,bid,amount,bid_pro_loss as bidProLoss,status,created_at FROM `tbl_bid_transaction` WHERE u_id = '$UID' AND  created_at >= '$fromDate' AND created_at <= '$toData' LIMIT $Initial,10";       
        $result = mysqli_query($conn,$sear) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($searchHistoryPlay = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $searchHistoryPlay;
            }
        }            
    }


    /*
     * Get HISTORY Play Result with Pagination
     * returns details
     *
     */
    public function getHistoryPlay($UID,$indexID = 0){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $data = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $initial = $indexID.'0';
        $limit   = '10';

        $curr = "SELECT slot_id as SlotNumber,randValue,bid,amount,bid_pro_loss as bidProLoss,status,created_at FROM `tbl_bid_transaction` WHERE u_id = '$UID' LIMIT $initial,$limit";
        $result = mysqli_query($conn,$curr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($getHistoryPlay = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $getHistoryPlay;
            }
        }
    }




    /*
     * Get HISTORY Payment Result with Pagination
     * returns details
     *
     */
    public function getHistoryPayment($UID,$indexID){

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $initial = $indexID.'0';
        $limit   = '10';

        // $curr = "SELECT * FROM `tbl_bid_transaction` WHERE u_id = '$UID' LIMIT $initial,$limit";
        $curr = "SELECT slot_id as SlotNumber,randValue,bid,amount,status as status,created_at FROM `tbl_bid_transaction` WHERE u_id = '$UID' LIMIT $initial,$limit";
        $result = mysqli_query($conn,$curr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($getHistoryPayment = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $getHistoryPayment;
            }
        }        
    }

   /*
     * Search HISTORY Payment Result 
     * returns details
     *
     */
    public function searchHistoryPayment($UID,$IndexID,$fromDate,$toData){
        require_once 'Config.php';        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        
        
        $Initial = $IndexID.'0';
        $sear =  "SELECT slot_id as SlotNumber,randValue,bid,amount,status as status,created_at FROM `tbl_bid_transaction` WHERE u_id = '$UID' AND  created_at >= '$fromDate' AND created_at <= '$toData' LIMIT $Initial,10";       
        $result = mysqli_query($conn,$sear) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($searchHistoryPayment = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $searchHistoryPayment;
            }
        }                    
    }


   /*
     * Search SlotID For Desktop Application 
     * returns details
     *
     */
    public function searchSlotID($time){

        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        // SELECT * FROM `tbl_gen_rand` WHERE time LIKE '%10%' AND date = '2018-08-20'
        
        $sear =  "SELECT * FROM `tbl_gen_rand` WHERE time LIKE '%$time%' AND date = '$date'";       
        $result = mysqli_query($conn,$sear) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($searchHistoryPayment = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $searchHistoryPayment[0];
            }
        }                    
    }

    /**
     * Add PayUMoneyDeposit Details
     * returns details
     */
    public function PayUMoneyDeposit($uid,$FullName,$BankName,$AccountID,$IFSC,$type,$Amount){    

        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d H:i:s');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        $call = "CALL WalletDeposit('$uid','$FullName','$BankName', '$AccountID', '$IFSC','$type','$Amount','$date');";
        $result = mysqli_query($conn,$call);

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($bid = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $bid[0]['totalAmount'];
            }
        }
    }


    /**
     * Add PayUMoneyProcess Details for Bulk Entries
     * returns details
     */
    public function PayUMoneyProcess($uid,$Amount){    

        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d H:i:s');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }
        //CALL WalletProcess('5b16384f4b8504.39394722','100','2018-09-05 00:00:00');
        $call = "CALL WalletProcess('$uid','$Amount','$date');";
        $result = mysqli_query($conn,$call);

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($bid = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $bid;
            }
        }
    }

    /**
     * Add PayUMoneyWithDrawl Details
     * returns details
     */
    public function PayUMoneyWithDrawl($uid,$FullName,$BankName,$AccountID,$IFSC,$type,$withdrawalAmount){    

        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d H:i:s');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }
        //CALL WalletProcess('5b16384f4b8504.39394722','100','2018-09-05 00:00:00');
        $call = "CALL WalletWithdrawal('$uid','$FullName','$BankName', '$AccountID', '$IFSC','$type','$withdrawalAmount','$date');";
        $result = mysqli_query($conn,$call);

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($bid = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $bid[0]['totalAmount'];
            }
        }
    }


    /**
     * PAYUWALLET Details
     * returns details
     */
    public function PayUWallet($uid){    

        date_default_timezone_set('Asia/Calcutta'); 

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d H:i:s');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }
        //SELECT unique_id,totalAmount FROM `tbl_users_wallet` WHERE unique_id = '5b114c25de5d92.04415953'
        $call = "SELECT unique_id as uid,totalAmount as amount FROM `tbl_users_wallet` WHERE unique_id = '$uid'";
        $result = mysqli_query($conn,$call);
        // return true;
        if(mysqli_num_rows($result) > 0){
            while($bid = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $bid[0];
            }
        }
    }


     /*
     * Search HISTORY PayUTransaction Result 
     * returns details
     *
     */
    public function searchHistoryPayUTransaction($UID,$IndexID = 0,$fromDate,$toData){
        require_once 'Config.php';        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        
        
        $Initial = $IndexID.'0';

        $sear =  "SELECT * FROM `tbl_payumoney_transaction` WHERE unique_id = '$UID' AND  created_at >= '$fromDate' AND created_at <= '$toData' LIMIT $Initial,10";       
        $result = mysqli_query($conn,$sear) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($searchHistoryPayUTransaction = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $searchHistoryPayUTransaction;
            }
        }            
    }
    /*
     * Get HISTORY PayUTransaction with Pagination
     * returns details
     *
     */
    public function getHistoryPayUTransaction($UID,$indexID = 0){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $data = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $initial = $indexID.'0';
        $limit   = '10';

        $curr = "SELECT * FROM `tbl_payumoney_transaction` WHERE unique_id = '$UID' LIMIT $initial,$limit";
        $result = mysqli_query($conn,$curr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($getHistoryPayUTransaction = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $getHistoryPayUTransaction;
            }
        }
    }



/*********


API FOR DASBOARD AND ADMIN PANEL


*********/

    /**
     * Count Bid Users in Current Slot
     * returns details
     */
    public function currentbidAllUsers($SlotNumber){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        //SELECT count(*) as ctnAll  FROM `tbl_bid_transaction` WHERE `slot_id` = 'B' AND `created_at` LIKE '%2018-06-21%'
        $inset = mysqli_query($conn,"SELECT count(*) as ctnAll  FROM `tbl_bid_transaction` WHERE `slot_id` = '$SlotNumber' AND `created_at` LIKE '%$date%'" ) or die(mysqli_error($conn));

        $countAll = mysqli_fetch_object($inset);

        $count = $countAll->ctnAll;        
        return $count;
    }

    /**
     * Count Bid Users in Current Slot which play for High
     * returns details
     */
    public function currentbidHighUsers($SlotNumber){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        //SELECT count(*) as ctnHigh  FROM `tbl_bid_transaction` WHERE `slot_id` = 'B' AND `bid` = 'high' AND `created_at` LIKE '%2018-06-21%'
        $inset = mysqli_query($conn,"SELECT count(*) as ctnHigh  FROM `tbl_bid_transaction` WHERE `slot_id` = '$SlotNumber' AND `bid` = 'high' AND `created_at` LIKE '%$date%'" ) or die(mysqli_error($conn));

        $countAll = mysqli_fetch_object($inset);

        $count = $countAll->ctnHigh;        
        return $count;
    }

    /**
     * Count Bid Users in Current Slot which play for Low
     * returns details
     */
    public function currentbidLowUsers($SlotNumber){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        //SELECT count(*) as ctnLow  FROM `tbl_bid_transaction` WHERE `slot_id` = 'B' AND `bid` = 'low' AND `created_at` LIKE '%2018-06-21%'
        $inset = mysqli_query($conn,"SELECT count(*) as ctnLow  FROM `tbl_bid_transaction` WHERE `slot_id` = '$SlotNumber' AND `bid` = 'low' AND `created_at` LIKE '%$date%'" ) or die(mysqli_error($conn));

        $countAll = mysqli_fetch_object($inset);

        $count = $countAll->ctnLow;        
        return $count;
    }

    /**
     * Count Register Users
     * returns details
     */
    public function currentRegisterUsers(){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }

        //SELECT count(*) as ctnReg  FROM `users`
        $inset = mysqli_query($conn,"SELECT count(*) as ctnReg  FROM `users`" ) or die(mysqli_error($conn));

        $countAll = mysqli_fetch_object($inset);

        $count = $countAll->ctnReg;        
        return $count;
    }
    
    /**
     * Total Transaction to All Users
     * returns details
     */
    public function allTransaction(){
        require_once 'Config.php';        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        
        
        $allTr = "CALL allTransaction();";
        $result = mysqli_query($conn,$allTr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($allTransaction = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                // return $allTransaction;
                echo json_encode($allTransaction);
            }
        }                    
    }


    /**
     * Search Transaction to All Users
     * returns details
     */
    public function searchTransaction($character){
        require_once 'Config.php';        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

       //SELECT Q.name as name, Q.u_id as uid, Q.HighValue as HighValue, Q.LowValue as LowValue, Q.TotalValue as TotalValue FROM ( SELECT ur.name, bt1.u_id, bt1.HighValue, bt2.LowValue, sum(bt1.HighValue + bt2.LowValue) As 'TotalValue' FROM ( ( SELECT bt.u_id, SUM(bt.amount) As 'HighValue' FROM tbl_bid_transaction as bt WHERE bt.bid='High' GROUP BY bt.u_id ) AS bt1 INNER JOIN ( SELECT bt.u_id, SUM(bt.amount) As 'LowValue' FROM tbl_bid_transaction AS bt WHERE bt.bid='Low' GROUP BY bt.u_id ) AS bt2 ON bt1.u_id=bt2.u_id INNER JOIN ( SELECT name,unique_id FROM users ) AS ur ON bt1.u_id = ur.unique_id ) GROUP BY bt1.u_id, bt1.HighValue, bt2.LowValue, ur.unique_id UNION SELECT ur.name, bt.u_id, SUM(0) As 'HighValue', SUM(bt.amount) As 'LowValue', sum(0 + bt.amount) As 'TotalValue' FROM tbl_bid_transaction AS bt INNER JOIN ( SELECT name,unique_id FROM users ) AS ur ON bt.u_id = ur.unique_id WHERE (bt.bid='Low' AND bt.amount IS NOT NULL) GROUP BY ur.name, bt.u_id UNION SELECT ur.name, bt.u_id, SUM(bt.amount) As 'HighValue', SUM(0) As 'LowValue', sum(bt.amount + 0) As 'TotalValue' FROM tbl_bid_transaction AS bt INNER JOIN ( SELECT name,unique_id FROM users ) AS ur ON bt.u_id = ur.unique_id WHERE (bt.bid='High' AND bt.amount IS NOT NULL) GROUP BY ur.name, bt.u_id ) As Q WHERE Q.name LIKE 'a%' GROUP BY Q.name, Q.u_id 
        $saTr = "SELECT Q.name as name, Q.u_id as uid, Q.HighValue as HighValue, Q.LowValue as LowValue, Q.TotalValue as TotalValue FROM ( SELECT ur.name, bt1.u_id, bt1.HighValue, bt2.LowValue, sum(bt1.HighValue + bt2.LowValue) As 'TotalValue' FROM ( ( SELECT bt.u_id, SUM(bt.amount) As 'HighValue' FROM tbl_bid_transaction as bt WHERE bt.bid='High' GROUP BY bt.u_id ) AS bt1 INNER JOIN ( SELECT bt.u_id, SUM(bt.amount) As 'LowValue' FROM tbl_bid_transaction AS bt WHERE bt.bid='Low' GROUP BY bt.u_id ) AS bt2 ON bt1.u_id=bt2.u_id INNER JOIN ( SELECT name,unique_id FROM users ) AS ur ON bt1.u_id = ur.unique_id ) GROUP BY bt1.u_id, bt1.HighValue, bt2.LowValue, ur.unique_id UNION SELECT ur.name, bt.u_id, SUM(0) As 'HighValue', SUM(bt.amount) As 'LowValue', sum(0 + bt.amount) As 'TotalValue' FROM tbl_bid_transaction AS bt INNER JOIN ( SELECT name,unique_id FROM users ) AS ur ON bt.u_id = ur.unique_id WHERE (bt.bid='Low' AND bt.amount IS NOT NULL) GROUP BY ur.name, bt.u_id UNION SELECT ur.name, bt.u_id, SUM(bt.amount) As 'HighValue', SUM(0) As 'LowValue', sum(bt.amount + 0) As 'TotalValue' FROM tbl_bid_transaction AS bt INNER JOIN ( SELECT name,unique_id FROM users ) AS ur ON bt.u_id = ur.unique_id WHERE (bt.bid='High' AND bt.amount IS NOT NULL) GROUP BY ur.name, bt.u_id ) As Q WHERE Q.name LIKE '$character%' GROUP BY Q.name, Q.u_id";
        $result = mysqli_query($conn,$saTr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($searchTransaction = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                 return $searchTransaction;
                //echo json_encode($searchTransaction);
            }
        }                    
    }

   
           /*
     * Get Current Play Result
     * returns details
     *
     */
    public function livePlayStatus($SlotNumber){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        $curr = "SELECT usr.name ,tbt.slot_id, tbt.bid, tbt.amount, tbt.created_at FROM `tbl_bid_transaction` as tbt INNER JOIN users as usr ON tbt.u_id = usr.unique_id  WHERE tbt.`slot_id`='$SlotNumber' AND tbt.created_at LIKE '%$date%'";
        $result = mysqli_query($conn,$curr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($livePlayStatus = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $livePlayStatus;
            }
        }
    }     


    /**
     * User Details for Dashboard
     * returns details
     */
    public function userDetails(){
        require_once 'Config.php';        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        
        
        $allUr = "SELECT * FROM `users` ORDER BY `name` ASC";
        $result = mysqli_query($conn,$allUr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($userDetails = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                // return $userDetails;
                echo json_encode($userDetails);
            }
        }                    
    }

    /*
     * Get Current Transaction Total
     * returns details
     *
     */
    public function liveTransaction($SlotNumber){
        date_default_timezone_set('Asia/Calcutta');

        require_once 'Config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $date = date('Y-m-d');

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        

        //$curr = "SELECT slot_id, (SELECT SUM(amount) FROM `tbl_bid_transaction` WHERE bid = 'LOW' AND created_at LIKE '%$date%' ) as LOW , (SELECT SUM(amount) FROM `tbl_bid_transaction` WHERE bid = 'HIGH' AND created_at LIKE '%$date%' ) as HIGH  FROM `tbl_bid_transaction` WHERE slot_id = '$SlotNumber' GROUP BY slot_id";
                $curr = "SELECT slot_id, (SELECT SUM(amount) FROM `tbl_bid_transaction` WHERE bid = 'LOW' AND slot_id = '$SlotNumber' AND created_at LIKE '%$date%') as LOW ,(SELECT SUM(amount) FROM `tbl_bid_transaction` WHERE bid = 'HIGH' AND slot_id = '$SlotNumber' AND created_at LIKE '%$date%') as HIGH FROM `tbl_bid_transaction` WHERE slot_id = '$SlotNumber' GROUP BY slot_id";

        $result = mysqli_query($conn,$curr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($liveTransaction = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                return $liveTransaction;
            }
        }
    }     




    /**
     * User Details for GetPayUMoneyWithDrawl
     * returns details
     */
    public function GetPayUMoneyWithDrawl(){
        require_once 'Config.php';        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        
        
        $allUr = "SELECT * FROM `tbl_payumoney_transaction` WHERE withdrawalAmount <> ''";
        $result = mysqli_query($conn,$allUr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($userDetails = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                // return $userDetails;
                echo json_encode($userDetails);
            }
        }                    
    }

    /**
     * User Details for GameTransaction
     * returns details
     */
    public function GameTransaction(){
        require_once 'Config.php';        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        }        
        
        $allUr = "SELECT * FROM `tbl_bid_transaction` as tbt INNER JOIN users as usr ON tbt.u_id = usr.unique_id WHERE finalAmount <> ''";
        $result = mysqli_query($conn,$allUr) or die(mysqli_error());

        // return true;
        if(mysqli_num_rows($result) > 0){
            while($userDetails = mysqli_fetch_all($result,MYSQLI_ASSOC)){
                // return $userDetails;
                echo json_encode($userDetails);
            }
        }                    
    }
    
}

?>