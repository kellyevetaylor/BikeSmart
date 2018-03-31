<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title>New Account</title>
    <link rel="stylesheet" type="text/css" href="CSS/LoginPage.css"/>
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

$action = isset($_POST["action"]);


if ($action == "doInsert") {

    $fname = $_POST["fname"];
    $sname = $_POST["sname"];
    $username = $_POST["username"];
    $password = $_POST["password1"];

    $sql = "INSERT INTO `Accounts` (`id`, `first name`, `second name`, `username`, `password`) VALUES (NULL, '$fname', $sname, $username, $password)";
    $conn->query($sql);
} else {
    ?>
    <form name="newAccountForm" method="POST">
        <p id="p1">First name: <input type="text" name="fname" style="font-size: 1.5rem; width: 20rem;"><br></p>
        <p id="p2">Second name: <input type="text" name="sname" style="font-size: 1.5rem; width: 20rem;"><br></p>
        <p id="p2">Username: <input type="text" name="username" style="font-size: 1.5rem; width: 20rem;"><br></p>
        <p id="p2">Password <input type="text" name="password1" style="font-size: 1.5rem; width: 20rem;"><br></p>
        <p id="p2">Retype password: <input type="text" name="password2" style="font-size: 1.5rem; width: 20rem;"><br>
            <input type="hidden" name="action" value="doInsert"><br>
        <p id="submit"><input type="button" id="b1" value="Create account"></p>
    </form>
    <?php
}

?>

</body>
<script src="JavaScript/LoginPage.js"></script>
</html>
