<?php
   if(isset($_FILES['image'])){
      $errors= array();
      //$file_name = $_FILES['image']['name'];
      
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
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"uploads/".$file_name);

         $name = rand(1000,9000);
         $url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/uploads/'.$file_name; 
         $rand = rand(1000,9000).'@gmail.com';

         $dbcon = mysqli_connect('localhost','root','','iqexpert') or die('Unable to Connect...');
         $sql = "INSERT INTO `users` (`unique_id`, `email`, `ProfilePic`) VALUES ('$name' ,'$rand', '$url')";
         
         if(mysqli_query($dbcon,$sql)){
               
            //filling response array with values 
            $response['error'] = false; 
            $response['url'] = $url; 
            $response['name'] = $name;
         }else{
         
            $response['error'] = true; 
            $response['url'] = $url;
         }

         echo json_encode($response);
         echo "Success";
      }else{
         
         print_r($errors);
      }
   }
?>
<html>
   <body>
      
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit"/>
      </form>
      
   </body>
</html>
