<?php

include('includes/database_connection.php');

session_start();

$message = '';

if (isset($_SESSION['user_id'])) {
  header('location:homepage.php');
}

if (isset($_POST["login"])) {
  $query = "
   SELECT * FROM login 
    WHERE email = :email
    AND verified = 'true'
 ";
  $statement = $connect->prepare($query);
  $statement->execute(
    array(
      ':email' => $_POST["email"]
    )
  );

  $count = $statement->rowCount();
  if ($count > 0) {
    $result = $statement->fetchAll();
    foreach ($result as $row) {
      if ($row["user_type"] == "admin") {
        if (password_verify(
          $_POST["password"],
          $row["password"]
        )) {
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['profile_image'] = $row['profile_image'];
          $sub_query = "
        INSERT INTO login_details 
        (user_id) 
        VALUES ('" . $row['user_id'] . "')
        ";
          $statement = $connect->prepare($sub_query);
          $statement->execute();
          $_SESSION['login_details_id'] = $connect->lastInsertId();
          header("location:homepage.php");
        } else {
          $message = "<label>Wrong Password</label>";
        }
      } else {
        $message = "<label>This is an user account</label>";
      }
    }
  } else {
    $message = "<label>Email Not verified yet</labe>";
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
    <div class="panel panel-default">
      <div class="panel-heading">Remdii Login</div>
      <div class="panel-body">
        <form method="post">
          <p class="text-danger"><?php echo $message; ?></p>
          <div class="form-group">
            <label>Enter Email</label>
            <input type="text" name="email" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Enter Password</label>
            <input type="password" name="password" class="form-control" required />
          </div>
          <div class="form-group">
            <input type="submit" name="login" class="btn btn-info" value="Login" />
          </div>
          <div align="left">
            <a href="registerAdmin.php">Register</a>
          </div>
          <div align="right">
            <a href="forgetAdminpass.php">Forget Password? CLICK here</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>