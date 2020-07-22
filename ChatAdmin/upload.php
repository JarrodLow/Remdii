<?php
  $conn = mysqli_connect("localhost", "root", "", "remdiichat");


  $msg = "";
  $msg_class = "";

  if (isset($_POST['save_profile'])) {
    // for the database
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $hashpass = password_hash($password,PASSWORD_DEFAULT);
    $user_type = "user";
    $profileImageName =$_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "profilePic/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['profileImage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }        
    
    $retrieve="select * from login where email='$email';";
    $res=mysqli_query($conn,$retrieve);
    if (mysqli_num_rows($res) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($res);
    if($email==$row['email'])
    {
        $msg ="Email already exists";
    }
    }else {            // Upload image only if no errors
        
        if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
          $sql = "INSERT INTO login SET username='$username', email='$email', password='$hashpass', user_type='$user_type', profile_image='$profileImageName'";
          if(mysqli_query($conn, $sql)){
            $msg = "Image uploaded and saved in the Database";
            header("Location:registersucess.php");
            $msg_class = "alert-success";
          } else {
            $msg = "There was an error in the database";
            $msg_class = "alert-danger";
          }
        } else {
          $error = "There was an erro uploading the file";
          $msg = "alert-danger";
        }
    }



      

       
     }





  
?>