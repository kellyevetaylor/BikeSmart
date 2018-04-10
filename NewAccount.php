

<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title>New Account</title>
    <link rel="stylesheet" type="text/css" href="CSS/OverallStandard.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/NewAccount.css"/>

</head>

<body>

<?php

$host = "devweb2017.cis.strath.ac.uk";
$user = "mad3_a";
$password = "Haihoo3shiop";
$database = "mad3_a";
$conn = new mysqli($host, $user, $password, $database);

$action = isset($_POST["action"]);


if ($action == "doInsert") {
    insertDatabase($conn);
} else {
    displayForm();
}

function displayForm()
{
    ?>
    <form name="newAccountForm" method="POST">
        <p> First name:</p><input type="text" name="fname" class="NewAccountEntries"><br>
        <p> Second name: </p><input type="text" name="sname" class="NewAccountEntries"><br>
        <p> Email: </p><input type="email" name="email" class="NewAccountEntries"><br>
        <p> Username:</p> <input type="text" name="username" class="NewAccountEntries"><br>
        <p> Password: </p><input type="password" name="password1" class="NewAccountEntries"><br>
        <p> Retype password: </p><input type="password" name="password2" class="NewAccountEntries"><br>
        <p id="submit"><input type="submit" id="b1" value="Create account"></p>
        <input type="hidden" name="action" value="doInsert"><br>
    </form>
    <?php
}

function insertDatabase($conn)
{
    $fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
    $sname = isset($_POST["sname"]) ? $_POST["sname"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password1 = isset($_POST["password1"]) ? $_POST["password1"] : "";
    $password2 = isset($_POST["password2"]) ? $_POST["password2"] : "";

    $sql = "SELECT `username` FROM `Accounts`";
   $result= $conn->query($sql);

    if ($fname == "" || $sname == "" || $email == "" || $username == "" || $password1 == "" || $password2 == "") {
        echo '<script type="text/javascript">alert("All fields must be filled.");</script>';
        displayForm();
    } else if ($password1 != $password2) {
        echo '<script type="text/javascript">alert("Your passwords do not match.");</script>';
        displayForm();
    } else {
        //doesn't work
        while ($row = $result->fetch_assoc()) {
            if ($row["username"] == $username) {
                echo '<script type="text/javascript">alert("This username already exists, please choose another.");</script>';
                displayForm();
            }
        }
        //need to check email doesn't already exist too
        $sql = "INSERT INTO `Accounts` (`id`, `first name`, `second name`, `email`,`username`, `password`) VALUES (NULL, '$fname', '$sname', '$email', '$username', '$password1')";
       $result= $conn->query($sql);
        while ($row = $result->fetch_assoc()) {

            $_SESSION["userId"]  = $row["id"];
        }




            $sql = "SELECT * FROM `Accounts` WHERE `username`= $username ";
        $conn->query($sql);

        header('location:NewsFeedPage.php');
    }
}

?>

</body>
<script src="JavaScript/LoginPage.js"></script>
</html>


