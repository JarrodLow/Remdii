<?php
session_start();

$message = '';

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}
$user_id = $_SESSION['user_id'];

$conn = mysqli_connect("localhost", "root", "", "remdiichat");
$results = mysqli_query($conn, "
SELECT * FROM questionnaire 
WHERE user_id = $user_id 
");
$users = mysqli_fetch_all($results, MYSQLI_ASSOC);
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
        <h3 align="center">User questionnaire detail</a></h3><br />

        <p align="right">Hi - <?php echo $_SESSION['username'];  ?> id -<?php echo $_SESSION['user_id'];  ?>

        <?php foreach ($users as $row1): ?>
            <form method="post">
                <p class="text-danger"><?php echo $message; ?></p>
                <div class="form-group">
                    <label>1. Name</label>
                    <div><?php echo $row1['question1'];  ?></div>
                </div>
                <div class="form-group">
                    <label>2. Age</label>
                    <div><?php echo $row1['question2'];  ?></div>
                </div>
                <div class="form-group">
                    <label>3. Gender</label>
                    <div><?php echo $row1['question3'];  ?></div>
                </div>
                <div class="form-group">
                    <label>4. Family history of eczema, asthma and allergic rhinitis</label>
                    <div><?php echo $row1['question4'];  ?></div>
                </div>
                <div class="form-group">
                    <label>5. Diagnosis of doctor </label>
                    <div><?php echo $row1['question5'];  ?></div>
                </div>
                <div class="form-group">
                    <label>6. Any shape to the rashes? Briefly describe.</label>
                    <div><?php echo $row1['question6'];  ?></div>
                </div>
                <div class="form-group">
                    <label>7. State the current cream/oilment/lotion applied. </label>
                    <div><?php echo $row1['question7'];  ?></div>
                </div>
                <div class="form-group">
                    <label>8. State the oral medication taken (if any) </label>
                    <div><?php echo $row1['question8'];  ?></div>
                </div>
                <div class="form-group">
                    <label>9. Weeping? (Y/N)</label>
                    <div><?php echo $row1['question9'];  ?></div>
                    </select>
                </div>
                <div class="form-group">
                    <label>10. Bleeding ? (Y/N)</label>
                    <div><?php echo $row1['question10'];  ?></div>
                    </select>
                </div>
                <div class="form-group">
                    <label>11. Excoriation marks? (Y/N)</label>
                    <div><?php echo $row1['question11'];  ?></div>
                    </select>
                </div>
                <div class="form-group">
                    <label>12. Infection (Impetigo)? (Y/N)</label>
                    <div><?php echo $row1['question12'];  ?></div>
                    </select>
                </div>
            </form>
            <?php endforeach; ?>

    </div>
    </div>
</body>

</html>