<?php 
  session_start();
if (isset($_SESSION['user_id'])) {
    header('location:upload.php');
  }
require_once('../PHPMailer-5.2-stable/PHPMailerAutoload.php');
$conn = mysqli_connect("localhost", "root", "", "remdiichat");

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth= true;
$mail->SMTPSecure ='ssl';
$mail->Host ='smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username='developertest1245@gmail.com';
$mail->Password='Zen1220!';
$mail->SetFrom('no-reply@howcode.org');
$mail->Subject ='Verify Ur Email to use AIREMDII';
$mail->Body= 'Your OTP is as follow. Please fill in to verified your account. '.$_SESSION['otp'].'';
$mail->AddAddress($_SESSION['email']);


$mail->Send();
if(isset($_POST["submit"]))
{
    if(empty($_POST["user_otp"]))
    {
        $error_user_otp = 'Enter OTP Number';
    }
    else
    {
        $user_otp = trim($_POST["user_otp"]);
        $email = trim($_POST["email"]);
            
            $query = "
            UPDATE login 
            SET verified = 'true' 
            WHERE email = '".$email."'
            AND otp ='".$user_otp."'
            ";

            $statement = $conn->prepare($query);
			$statement->execute();
			$total_row = mysqli_affected_rows($conn);
            if($total_row >0)
            {
				header('location:login.php');

			}
			else
			{
				$message = '<label class="text-danger">Invalid OTP Number</label>';

			}
        

    }
}





?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Registration with Email Verification using OTP</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="http://code.jquery.com/jquery.js"></script>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">Validating Remdii Account</h3>
			<br />

			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Please Enter OTP Number</h3>
				</div>
				<div class="panel-body">
					<form method="POST">
                       <div class="form-group">
                            <input type="hidden" name="email" value ="<?php echo $_SESSION['email'];?>" class="form-control"  />
                        </div>
						<div class="form-group">
							<label>Enter OTP Number</label>
							<input type="text" name="user_otp" class="form-control"  required/>
						</div>
						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-success" value="Submit" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<br />
		<br />
	</body>
</html>
