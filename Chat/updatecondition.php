<?php
// Create database connection
include('includes/database_connection.php');
$conn = mysqli_connect("localhost", "root", "", "remdiichat");

session_start();
// Initialize message variable
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

$user_id = $_SESSION['user_id'];
$msg = "";


// If upload button is clicked ...
if (isset($_POST['upload'])) {
    // Get image name
    $condition_image = $_FILES['condition_image']['name'];
    // Get text
    $questionnaire_id = "";
    $query = " 
    SELECT * FROM questionnaire 
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
            $questionnaire_id = $row['questionnaire_id'];
        }
    }


    // image file directory
    $target = "user_condition/" . basename($condition_image);

    if ($_FILES['condition_image']['size'] > 200000) {
        $msg = "Image size should not be greated than 200Kb";
        $msg_class = "alert-danger";
    }

    if (file_exists($target)) {
        $msg = "File already exists";
        $msg_class = "alert-danger";
    }

    $sql = "INSERT INTO user_condition SET questionnaire_id = '$questionnaire_id', condition_image = '$condition_image', upload_time = now() ";
    // execute query
    $res = mysqli_query($conn, $sql);

    if (move_uploaded_file($_FILES['condition_image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
        header('location:homepage.php');

    } else {
        $msg = "Failed to upload image";
    }
}
$result = mysqli_query($conn, "SELECT * FROM user_condition") or die(mysqli_error($conn));;
?>
<!DOCTYPE html>
<html>

<head>
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
    <style type="text/css">
        #content {
            width: 50%;
            margin: 20px auto;
            border: 1px solid #cbcbcb;
        }

        form {
            width: 50%;
            margin: 20px auto;
        }

        form div {
            margin-top: 5px;
        }

        #img_div {
            width: 80%;
            padding: 5px;
            margin: 15px auto;
            border: 1px solid #cbcbcb;
        }

        #img_div:after {
            content: "";
            display: block;
            clear: both;
        }

        img {
            float: left;
            margin: 5px;
            width: 300px;
            height: 140px;
        }
    </style>
</head>

<body>
    <div id="content">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            echo "<div id='img_div'>";
            echo "<img src='user_condition/" . $row['condition_image'] . "' >";
            echo "<p>" . $row['upload_time'] . "</p>";
            echo "</div>";
        }
        ?>
        <form method="POST" action="updatecondition.php" enctype="multipart/form-data">
            <div>
                <input type="file" name="condition_image">
            </div>
            <div>
                <button type="submit" name="upload">POST</button>
            </div>
        </form>
    </div>
</body>

</html>