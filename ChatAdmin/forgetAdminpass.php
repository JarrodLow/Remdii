<?php 

require_once('../PHPMailer-5.2-stable/PHPMailerAutoload.php');
$conn = mysqli_connect("localhost", "root", "", "remdiichat");


if(isset($_POST["submit"]))
{
    if(empty($_POST["email"]))
    {
        $error_email = 'Enter Email';
    }
    else
    {

        $email = trim($_POST["email"]);
		$forgetpass = rand(100000000, 999999999);
		$hashpass = password_hash($forgetpass,PASSWORD_DEFAULT);
            $query = "
            UPDATE login 
            SET password = '".$hashpass."' 
            WHERE email = '".$email."'
            ";

			$statement = $conn->prepare($query);
			$statement->execute();
			$total_row = mysqli_affected_rows($conn);
            if($total_row >0)
            {
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
				$mail->Subject ='Forget Password Request';
				$mail->Body= 'Hi user this is ur newly requested password : '.$forgetpass.'';
				$mail->AddAddress($email);


				$mail->Send();
				header('location:forgetAdminsucess.php');

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
			<h3 align="center">Forget PASSWORD ENTER EMAIL TO RETRIEVE </h3>
			<br />

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Enter ur email </h3>
				</div>
				<div class="panel-body">
					<form method="POST">
                       <div class="form-group">
					   		<label>Enter Email</label>
                            <input type="text" name="email"  class="form-control" required  />
                        </div>

						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-success" value="Submit" />
						</div>
						<div align="center">
            				<a href="loginAdmin.php">Back To Login</a>
         				 </div>
					</form>
				</div>
			</div>
		</div>
		<br />
		<br />
	</body>
</html>
