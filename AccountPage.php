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
<main>

    <header>
        <h1>Account
            <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button>
        </h1>
    </header>

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
        <table style="width: 30%">
            <tr>
                <?php
                echo "<td> Name: </td>";
                echo "<td>" . $row["first name"] . " " . $row["second name"] . "</td>";
                ?>
            </tr>
            <tr>
                <?php
                echo "<td> Email: </td>";
                echo "<td>" . $row["email"] . "</td>";
                ?>
            </tr>
            <tr>
                <?php
                echo "<td> Username: </td>";
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
        <button class="updateDetails">View bike hire history</button>
    </p>
    <p>
        <button class="updateDetails">View ride history</button>
    </p>

    <div class="tabs">
        <button class="tabButton" onclick="location.href='NewsFeedPage.html';">News Feed</button>
        <button class="tabButton" onclick="location.href='QuickstartPage.php';">Quickstart</button>
        <button class="tabButton" onclick="location.href='HirebikePage.php';">Hire Bike</button>
        <button class="tabButton" onclick="location.href='AccountPage.php';">Account</button>
    </div>

</main>
<script src="JavaScript/AccountPage.js"></script>
</html>