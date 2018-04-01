<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title>New Account</title>
    <link rel="stylesheet" type="text/css" href="CSS/LoginPage.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/OverallStandard.css"/>
</head>
<style>
    p {
        padding: 2vh;
    }
</style>

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
    $fname = isset($_POST["fname"]) ? $_POST["fname"]: "";
    $sname = isset($_POST["sname"]) ? $_POST["sname"]: "";
    $username = isset($_POST["username"]) ? $_POST["username"]: "";
    $password = isset($_POST["password1"]) ? $_POST["password1"]: "";
/*
    $fname = isset($_POST["fname"]);
    $sname = $_POST["sname"];
    $username = $_POST["username"];
    $password = $_POST["password1"];
*/

    $sql = "INSERT INTO `Accounts` (`id`, `first name`, `second name`, `username`, `password`) VALUES (NULL, '$fname', '$sname', '$username', '$password')";
   $result= $conn->query($sql);
    if (!$result === TRUE) {
        die("Error on insert" . $conn->error);
    }


    header('location:NewsFeedPage.html');


} else {
    ?>
    <form name="newAccountForm" method="POST">
        <p id="p1" >First name: <input type="text" name="fname" class="NewAccountEntries"><br></p>
        <p id="p2" >Second name: <input type="text" name="sname" class="NewAccountEntries"><br></p>
        <p id="p2">Username: <input type="text" name="username" class="NewAccountEntries"><br></p>
        <p id="p2" >Password <input type="text" name="password1" class="NewAccountEntries"><br></p>
        <p id="p2" >Retype password: <input type="text" name="password2" class="NewAccountEntries"><br>
        <p id="submit"><input type="submit" id="b1" value="Create account"></p>
        <input type="hidden" name="action" value="doInsert"><br>


    </form>
    <?php
}

?>

</body>
<script src="JavaScript/LoginPage.js"></script>
</html>
