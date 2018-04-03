<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title>New Account</title>
    <link rel="stylesheet" type="text/css" href="CSS/LoginPage.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/OverallStandard.css"/>
</head>

<body>

<?php

$host = "devweb2017.cis.strath.ac.uk";
$user = "mad3_a";
$password = "Haihoo3shiop";
$database = "mad3_a";
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection Failed :" . $conn->connect_error); //FIXME remove once working.
}

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
        <p id="p1"> First name: <input type="text" name="fname" class="NewAccountEntries"><br></p>
        <p id="p2"> Second name: <input type="text" name="sname" class="NewAccountEntries"><br></p>
        <p id="p2"> Username: <input type="text" name="username" class="NewAccountEntries"><br></p>
        <p id="p2"> Password <input type="password" name="password1" class="NewAccountEntries"><br></p>
        <p id="p2"> Retype password: <input type="password" name="password2" class="NewAccountEntries"><br>
        <p id="submit"><input type="submit" id="b1" value="Create account"></p>
        <input type="hidden" name="action" value="doInsert"><br>
    </form>
    <?php
}

function insertDatabase($conn)
{
    $fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
    $sname = isset($_POST["sname"]) ? $_POST["sname"] : "";
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password1 = isset($_POST["password1"]) ? $_POST["password1"] : "";
    $password2 = isset($_POST["password2"]) ? $_POST["password2"] : "";

    $sql = "SELECT `username` FROM `Accounts`";
    $result = mysqli_query($conn, $sql);

    //TODO fix this
    while ($row = $result->fetch_assoc()) {
        echo $row["username"];
        if ($row["username"] == $username) {
            echo '<script type="text/javascript">alert("This username already exists, please choose another.");</script>';
            displayForm();
        }
    }
    if ($fname == "" || $sname == "" || $username == "" || $password1 == "" || $password2 == "") {
        echo '<script type="text/javascript">alert("All fields must be filled.");</script>';
        displayForm();
    } else if ($password1 != $password2) {
        echo '<script type="text/javascript">alert("Your passwords dont match.");</script>';
        displayForm();
    } else {
        $sql = "INSERT INTO `Accounts` (`id`, `first name`, `second name`, `username`, `password`) VALUES (NULL, '$fname', '$sname', '$username', '$password1')";
        $conn->query($sql);

        header('location:NewsFeedPage.html');
    }
}

?>

</body>
<script src="JavaScript/LoginPage.js"></script>
</html>


