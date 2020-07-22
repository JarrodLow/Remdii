<?php

include('includes/database_connection.php');

session_start();
$message = '';

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];

if (isset($_POST["update"])) {
    $currentPassword = trim($_POST["currentpassword"]);
    $newpassword = trim($_POST["newpassword"]);
    $confirmPassword = trim($_POST["confirmPassword"]);

    $query = " 
    SELECT * FROM login 
WHERE user_id = $user_id 
";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':user_id' => $user_id
        )
    );
    $count = $statement->rowCount();

    if ($count > 0) {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            if (password_verify(
                $currentPassword,
                $row["password"]
            )) {
                //update
                if ($newpassword != $confirmPassword) {
                    $message = '<p><label>New Password not match</label></p>';
                }
                if ($message == '') {
                    $data = array(
                        ':password'  => password_hash($newpassword, PASSWORD_DEFAULT)
                    );
                    $query = "
                    UPDATE login 
                    SET password = :password
                    WHERE user_id = $user_id 
                    ";
                    $statement = $connect->prepare($query);
                    if ($statement->execute($data)) {
                        $message = "<label>Update Completed</label>";
                    }
                }
            } else {
                $message = "<label>Wrong Current Password</label>";
            }
        }
    } else {
        $message = "<label>Something went wrong</labe>";
    }
}

$conn = mysqli_connect("localhost", "root", "", "remdiichat");

if (isset($_POST['updateImage'])) {

    $profileImageName = $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "profilePic/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if ($_FILES['profileImage']['size'] > 200000) {
        $msg = "Image size should not be greated than 200Kb";
        $msg_class = "alert-danger";
    }

    $query = " 
    SELECT * FROM login 
WHERE user_id = $user_id 
";
    $statement = $connect->prepare($query);
    $query = " 
    SELECT * FROM login 
WHERE user_id = $user_id 
";
    $statement = $connect->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();

    $retrieve = "select * from login WHERE email='$email';";
    $res = mysqli_query($conn, $retrieve);
    if (mysqli_num_rows($res) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($res);
    } else {
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
            $sql = "UPDATE login SET profile_image='$profileImageName' WHERE user_id = $user_id";
            if (mysqli_query($conn, $sql)) {
                $msg = "Image uploaded and saved in the Database";
                header("Location:homepage.php");
                
                $_SESSION['profile_image'] = $profileImageName;
                $msg_class = "alert-success";
            } else {
                $msg = "There was an error in the database";
                $msg_class = "alert-danger";
            }
        } else {
            $error = "There was an error uploading the file";
            $msg = "alert-danger";
        }
    }
}


?>

<html>

<head>
    <title>Chat Application using PHP Ajax Jquery</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div class="container">
        <br />

        <h3 align="center">Remdii</a></h3><br />
        <br />

        <div class="table-responsive">
            <h4 align="center">Online User</h4>

            <p align="right">Hi - <?php echo $_SESSION['username'];  ?>
                <div id="user_details"></div>
                <div id="user_model_details"></div>
                <div><a href="homepage.php">Back</a></div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Setting</div>
        <div class="panel-body">
            <form action="setting.php" method="post" enctype="multipart/form-data">
                <?php if (!empty($msg)) : ?>
                    <div class="alert <?php echo $msg_class ?>" role="alert">
                        <?php echo $msg; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group text-center" style="position: relative;">
                    <span class="img-div">
                        <div class="text-center img-placeholder" onClick="triggerClick()">
                            <h4>Update image</h4>
                        </div>
                        <img src="<?php echo 'profilePic/' . $_SESSION['profile_image'] ?>" onClick="triggerClick()" id="profileDisplay" width="90" height="90" alt="">
                    </span>
                    </span>
                    <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                    <label>Profile Image</label>
                </div>
                <div class="form-group">
                    <button type="submit" name="updateImage" class="btn btn-primary btn-block">Update Image</button>
            </form>

        </div>
        <form action="setting.php" method="post" onSubmit="return validatePassword()">
            <div class="message"><?php if (isset($message)) {
                                        echo $message;
                                    } ?></div>
            <div class="form-group">
                <label>Enter Current Password</label>
                <input type="password" name="currentpassword" id="currentPassword" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Enter New Password</label>
                <input type="password" name="newpassword" id="newpassword" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Re-enter New Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="submit" name="update" class="btn btn-info" value="Update" />
            </div>
        </form>
    </div>

</body>

</html>

<script>
    function triggerClick(e) {
        document.querySelector('#profileImage').click();
    }

    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>