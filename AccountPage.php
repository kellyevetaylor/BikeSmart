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

    <link rel="stylesheet" type="text/css" href="CSS/AccountPage.css">


    <link rel="icon" sizes="192x192" href="Images/icon.png"/>
    <link rel="apple-touch-icon" href="Images/icon.png"/>
    <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

</head>


<header>
    <h1>Account
        <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button>
    </h1>
</header>
<main>
    <?php
    $host = "devweb2017.cis.strath.ac.uk";
    $user = "mad3_a";
    $password = "Haihoo3shiop";
    $database = "mad3_a";
    $conn = new mysqli($host, $user, $password, $database);

    ?>

    <p><img src="Images/avatar.jpg" height="150" width="150"></p>

    <?php

    $sql = "SELECT `first name`, `second name`, `email` , `username` FROM `Accounts` WHERE `id` = 1";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        ?>
        <table style="width: 100%">
            <tr>
                <?php
                echo "<td>" . $row["first name"] . " " . $row["second name"] . "</td>";
                ?>
            </tr>
            <tr>
                <?php
                echo "<td>" . $row["email"] . "</td>";
                ?>
            </tr>
            <tr>
                <?php
                echo "<td>" . $row["username"] . "</td>";
                ?>
            </tr>
        </table>
        <?php
    }
    ?>

    <p>
        <button class="updateDetails" onclick="location.href = 'UpdateDetails.php'">Update details</button>
    </p>
    <p>
        <button class="updateDetails" onclick="location.href = 'HireHistory.php'">View bike hire history</button>
    </p>
    <p>
        <button class="updateDetails" onclick="location.href = 'RideHistory.php'">View ride history</button>
    </p>
</main>
<div class="tabs">
    <button class="tabButton" onclick="location.href='NewsFeedPage.php';"><img src="Images/NewsFeed.png" ></button>
    <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png" ></button>
    <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/HireBike.png" ></button>
    <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png" ></button>
</div>

<script src="JavaScript/AccountPage.js"></script>
</html>