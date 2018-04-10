<?php
session_start();
$userID = $_SESSION["id"];

?><?php
/**
 * Created by IntelliJ IDEA.
 * User: Ryan
 * Date: 03/04/2018
 * Time: 13:15
 */

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


    <link rel="icon" sizes="192x192" href="Images/Logo.png"/>
    <link rel="apple-touch-icon" href="Images/Logo.png"/>
    <link rel="shortcut icon" href="Images/Logo.png" type="image/x-icon"/>

</head>


<?php
$date = date('Y-m-d');
$date2 = date('Y-m-d H:i:s');
$month = date('m');

$host = "devweb2017.cis.strath.ac.uk";
$user = "mad3_a";
$password = "Haihoo3shiop";
$database = "mad3_a";
$conn = new mysqli($host, $user, $password, $database);

$action = isset($_POST["action"]);

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$distance = isset($_POST["distance"]) ? $_POST["distance"] : "";
$time = isset($_POST["time"]) ? $_POST["time"] : "";
$startLocation = isset($_POST["startLocation"]) ? $_POST["startLocation"] : "";
$endLocation = isset($_POST["endLocation"]) ? $_POST["endLocation"] : "";


if ($action == "Finish") {

$sql = "INSERT INTO `QuickstartTable` (`id`, `distance`, `time`, `startLocation`,`endLocation`,`date`,`month`) VALUES (Null, '0', '$time', '0', '0','$date','$month')";
$conn->query($sql);

$message = "Distance: " . $distance . " Time: " . $time;

$sql = "SELECT * FROM `Accounts` WHERE `id` = '$userID'";
$result=$conn->query($sql);

if ($result){
    $row = $result->fetch_assoc();
    $username = $row["username"];
}








$sql = "INSERT INTO `Newsfeed` (`message`, `userID`, `time`) VALUES ('$message', '$username', '$date2')";
$conn->query($sql);


$action = "";
header('location:NewsFeedPage.php');


} else {


?>



    <header>
        <h1>Quickstart
            <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button>
        </h1>
    </header>
    <main>
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
                <audio id="audioStart">
                    <source src="Sounds/Start.mp3" type="audio/mp3">
                </audio>
            </div>
            <div class="column">
                <button id="QuickstopBtn" onclick="stopTimer()">Pause</button>

                <audio id="audioPause">
                    <source src="Sounds/Pause.mp3" type="audio/mp3">
                </audio>
            </div>

        </div>
        <form id="submitForm" method="POST">
            <div id="logActivity">
                <audio id="audioFinish">
                    <source src="Sounds/Finish.mp3" type="audio/mp3">
                </audio>
                <input type="hidden" id="lbltime" name="time" value="00:00:00">
                <input type="hidden" name="action" value="Finish"><br>
                <input type="submit" id="button" class="submitButton" value="Finish" name="Finish">
            </div>

        </body>
        </form>
    </main>
    <div class="tabs">
        <button class="tabButton" onclick="location.href='NewsFeedPage.php';"><img src="Images/NewsFeed.png"></button>
        <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png">
        </button>
        <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/HireBike.png"></button>
        <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png">
        </button>
    </div>
    <script src="JavaScript/QuickstartPage.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-ld-Jrm4iRR45vbE3NVNYSqZ1C8QbroM&callback=googleMap">
    </script>

<?php
}
?>
</html>




