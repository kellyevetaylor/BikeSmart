<?php
session_start();
if (empty($_SESSION['id'])) {
    session_destroy();
    header("Location: LoginPage.php");
    exit();
}
$userID = $_SESSION["id"];

?><?php
/**
 * Created by IntelliJ IDEA.
 * User: pavindersingh
 * Date: 04/04/2018
 * Time: 00:32
 */ ?>
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
    <link rel="stylesheet" type="text/css" href="CSS/NewsFeedPage.css">

    <link rel="icon" sizes="192x192" href="Images/icon.png"/>
    <link rel="apple-touch-icon" href="Images/icon.png"/>
    <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>
    <?php

    $date = date('d/m/Y H:i:s');
    $host = "devweb2017.cis.strath.ac.uk";
    $user = "mad3_a";
    $password = "Haihoo3shiop";
    $database = "mad3_a";
    $conn = new mysqli($host, $user, $password, $database);


    if ($conn->connect_error) {
    die("Connection Failed :" . $conn->connect_error); //FIXME remove once working.
    }

    $sql = "SELECT * FROM `Accounts` WHERE `id` = '$userID'";
    $result = $conn->query($sql);
    if ($result)
    $row = $result->fetch_assoc();
    $user = $row["username"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["messageText"])) {
    $message = $_POST["messageText"];
    $sql = "INSERT INTO `Newsfeed` (`message`, `userID`, `time`) VALUES ('$message', '$user', '$date')";
    $conn->query($sql);

    header('location:NewsFeedPage.php');
    }
    }

    ?>

</head>
<main>


    <header>
        <h1>News Feed
            <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button>
    </header>
    <br>
    <body>
    <form id="chatForm" method="POST">
        <input type="text" name="messageText" id="messageText"/>
        <input class="postButton" type="submit" id="postButton" value="Post"/>
        <br><br>
    </form>
    <table>

        <?php

        $sql = "SELECT * FROM `Newsfeed` ORDER BY time DESC";
        $result = mysqli_query($conn, $sql);


        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

        $username = $row["userID"];
        $sql2 = "SELECT * FROM `Accounts` WHERE `username` = '$username'";
        $result2 = $conn->query($sql2);

        $row2 = $result2->fetch_assoc();
        $pic = $row2["pic"];

        ?>
        <div id="chatFormDiv">

            <div id="pic">
                <p><img src="<?php echo $pic ?>" height="80" width="80"></p></div>
            <?php

            echo "<div id=username >";
            echo $row["userID"];
            echo "<br>";
            echo "</div>";
            ?>

            <div id="time"><?php
                echo $row["time"];
                echo "<br>";
                ?></div>

            <div id="message"><?php
                echo $row["message"];
                echo "<br>";
                ?></div><?php
            echo "<br>";
            ?>
        </div><?php
        }
        }
        $conn->close();
        ?>

    </table>
    </body>

    <script type="text/javascript">
        setInterval('window.location.reload()', 150000);
        document.getElementById("messageText").value = getSaved("messageText");

        function saveText(e) {
            var id = e.id;
            var msg = e.value;

            localStorage.setItem(id, msg);

        }

        function getSaved(v) {
            if (localStorage.getItem(v) === null) {
                return "";
            }
            return localStorage.getItem(v);

        }

    </script>
    <div class="tabs">
        <button class="tabButton" onclick="location.href='NewsFeedPage.php';"><img src="Images/NewsFeed.png"></button>
        <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png">
        </button>
        <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/keyOld.png"></button>
        <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png">
        </button>
    </div>


</main>
</html>
