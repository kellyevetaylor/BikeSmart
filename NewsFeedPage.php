<?php
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
    if (!empty($_POST["messageText"])) {
        $message = $_POST["messageText"];
        $sql = "INSERT INTO `Newsfeed` (`message`, `userID`, `time`, `comment`) VALUES ('$message', '1', '$date', 'Comments.comment')";
        $conn->query($sql);

        header('location:NewsFeedPage.php');
    }
}
?>

</head>
<main>

    <header>
        <h1>News Feed
            <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button></h1>
    </header>
    <body>
    <div id="chatHistoryDiv"></div>
    <div id="chatFormDiv">
        <table>
            <tr>
                <th>
                    User ID
                </th>
                <th>
                    Message
                </th>
            </tr>
            <?php
            $sql = "SELECT * FROM `Newsfeed`";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo"<tr>";
                        echo"<td>";
                            echo $row["time"];
                        echo"<td>";
                        echo"<td>";
                            echo$row["id"];
                        echo"<td>";
                        echo"<td>";
                            echo $row["message"];
                        echo"<td>";
                        echo"<td>";
                            ?> //Counter comments <button class="postButton" onclick="location.href='CommentPage.php';">Add Comment</button>
                        <?php echo"<td>";
                    echo"<tr>";
                }
            }
            $conn->close();
            ?>

        </table>
        <form id="chatForm" method="POST">
            <input type="text" name="messageText" id="messageText"/>
            <input class="postButton" type="submit" id="postButton" value="Post"/>
            <br>
        </form>
    </div>
    </body>
    <script type="text/javascript">
        setInterval('window.location.reload()', 15000);
    </script>
</main>

<div class="tabs">
    <button class="tabButton" onclick="location.href='NewsFeedPage.php';"><img src="Images/NewsFeed.png" ></button>
    <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png" ></button>
    <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/HireBike.png" ></button>
    <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png" ></button>
</div>
</html>
