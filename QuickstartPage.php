<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ryan
 * Date: 03/04/2018
 * Time: 13:15
 */

?>


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


$id = isset($_POST["id"]) ? $_POST["id"] : "";
$distance = isset($_POST["distance"]) ? $_POST["distance"] : "";
$time = isset($_POST["time"]) ? $_POST["time"] : "";
$startLocation = isset($_POST["startLocation"]) ? $_POST["startLocation"] : "";
$endLocation = isset($_POST["endLocation"]) ? $_POST["endLocation"] : "";


if ($action == "Finish") {
    $sql = "INSERT INTO `QuickstartTable` (`id`, `distance`, `time`, `startLocation`,`endLocation`) VALUES (Null, '0', '$time', '0', '0')";

    $result = $conn->query($sql);
    if (!$result === TRUE) {
        die("Error on insert" . $conn->error);
    }

    $action = "";
    header('location:QuickstartPage.php');


} else {


?>

<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>BikeSmart</title>


    <link rel="stylesheet" type="text/css" href="CSS/OverallStandard.css">
    <link rel="stylesheet" type="text/css" href="CSS/QuickstartPage.css">
    <link rel="stylesheet" type="text/css" href="CSS/Tabs.css">


    <link rel="icon" sizes="192x192" href="Images/icon.png"/>
    <link rel="apple-touch-icon" href="Images/icon.png"/>
    <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

</head>


<header>
    <h1>Quickstart
        <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button>
    </h1>
</header>
<body>

<div id="QuickstartInfoDiv">

    <div id="googleMap">


</div>


<div class="column">
    <h4 class="QuickstartLabel">Distance:</h4><label id="distanceTraveled">0 km</label>
</div>
<div class="column">
    <h4 class="QuickstartLabel">Time:</h4>
    <label id="timer">00:00:00</label>
</div>

</div>

<div id="QuickstartButtons">
    <div class="column">
        <button id="QuickstartBtn" name=startBtn onclick="startTimer()">Start</button>
    </div>
    <div class="column">
        <button id="QuickstopBtn" onclick="stopTimer()">Pause</button>
    </div>

</div>
<form method="POST">

    <div id="logActivity">
        <input type="hidden" id="lbltime" name="time" value="00:00:00">
        <input type="hidden" name="action" value="Finish"><br>
        <input type="submit" id="button" class="submitButton" value="Finish" name="Finish">


    </div>
</body>
</form>
</main>


<div class="tabs">
    <button class="tabButton" onclick="location.href='NewsFeedPage.html';">News Feed</button>
    <button class="tabButton" onclick="location.href='QuickstartPage.php';">Quickstart</button>
    <button class="tabButton" onclick="location.href='HirebikePage.php';">Hire Bike</button>
    <button class="tabButton" onclick="location.href='AccountPage.php';">Account</button>
</div>
<script src="JavaScript/QuickstartPage.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-ld-Jrm4iRR45vbE3NVNYSqZ1C8QbroM&callback=googleMap">
</script>

<?php
}
?>
</html>




