<?php
$conn = mysqli_connect("localhost", "root", "", "remdiichat");

include('includes/database_connection.php');

session_start();

$message = '';

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

if (isset($_POST["submit"])) {
    $user_id = $_SESSION['user_id'];
    $question1 = trim($_POST["question1"]);
    $question2 = trim($_POST["question2"]);
    $question3 = trim($_POST["question3"]);
    $question4 = trim($_POST["question4"]);
    $question5 = trim($_POST["question5"]);
    $question6 = trim($_POST["question6"]);
    $question7 = trim($_POST["question7"]);
    $question8 = trim($_POST["question8"]);
    $question9 = trim($_POST["question9"]);
    $question10 = trim($_POST["question10"]);
    $question11 = trim($_POST["question11"]);
    $question12 = trim($_POST["question12"]);

    $query = "INSERT INTO questionnaire SET user_id='$user_id', question1='$question1', question2='$question2', question3='$question3', question4='$question4', question5='$question5', question6='$question6', question7='$question7', question8='$question8', question9='$question9', question10='$question10', question11='$question11', question12='$question12'";

    if (mysqli_query($conn, $query)) {
        $message = "Questionnaire has been done";
        header('location:homepage.php');
    } else {
        $message = "There was an error in the database";
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
        <h3 align="center">Questionnaire</a></h3><br />

        <p align="right">Hi - <?php echo $_SESSION['username'];  ?>

            <form method="post">
                <p class="text-danger"><?php echo $message; ?></p>
                <div class="form-group">
                    <label>1. Name</label>
                    <input type="text" name="question1" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>2. Age</label>
                    <input type="number" name="question2" class="form-control" min="1" max="100" required />
                </div>
                <div class="form-group">
                    <label>3. Gender</label>
                    <select name="question3" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>4. Family history of eczema, asthma and allergic rhinitis</label>
                    <input type="text" name="question4" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>5. Diagnosis of doctor </label>
                    <select name="question5" id="question5" required>
                        <option value="yes">YES</option>
                        <option value="no">NO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>6. Any shape to the rashes? Briefly describe.</label>
                    <input type="text" name="question6" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>7. State the current cream/oilment/lotion applied. </label>
                    <input type="text" name="question7" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>8. State the oral medication taken (if any) </label>
                    <input type="text" name="question8" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>9. Weeping? (Y/N)</label>
                    <select name="question9" id="question9" required>
                        <option value="yes">YES</option>
                        <option value="no">NO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>10. Bleeding ? (Y/N)</label>
                    <select name="question10" id="question10" required>
                        <option value="yes">YES</option>
                        <option value="no">NO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>11. Excoriation marks? (Y/N)</label>
                    <select name="question11" id="question11" required>
                        <option value="yes">YES</option>
                        <option value="no">NO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>12. Infection (Impetigo)? (Y/N)</label>
                    <select name="question12" id="question12" required>
                        <option value="yes">YES</option>
                        <option value="no">NO</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-info" value="Submit" />
                </div>
            </form>

    </div>
    </div>
</body>

</html>