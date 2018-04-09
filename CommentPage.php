<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>BikeSmart</title>
<link rel="stylesheet" type="text/css" href="CSS/OverallStandard.css">

<link rel="stylesheet" type="text/css" href="CSS/Tabs.css">


<link rel="icon" sizes="192x192" href="Images/icon.png"/>
<link rel="apple-touch-icon" href="Images/icon.png"/>
<link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

<?php

$date = date('U = Y-m-d H:i:s');
$host = "devweb2017.cis.strath.ac.uk";
$user = "mad3_a";
$password = "Haihoo3shiop";
$database = "mad3_a";
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed :" . $conn->connect_error); //FIXME remove once working.
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["commentText"])) {
        $comment = $_POST["commentText"];
        $sql = "INSERT INTO `Comments` (`post_id`, `comment`) VALUES ('23', 'hello')";

        $conn->query($sql);

        header('location:NewsFeedPage.php');
    }
}

$conn->close();
?>
</head>
<main>
    <header>
        <h1>News Feed
            <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button></h1>
    </header>

<form id="commentForm" method="POST">
    <input type="text" name="commentText" id="commentText"/>
    <input class="postButton" type="submit" value="Post" name="Post">
</form>

<script type="text/javascript">
    setInterval('window.location.reload()', 15000);
</script>

<div class="tabs">
    <button class="tabButton" onclick="location.href='NewsFeedPage.php';"><img src="Images/NewsFeed.png" ></button>
    <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png" ></button>
    <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/HireBike.png" ></button>
    <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png" ></button>
</div>
