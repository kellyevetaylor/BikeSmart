<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ryan
 * Date: 07/04/2018
 * Time: 21:03
 */


$host = "devweb2017.cis.strath.ac.uk";
$user = "mad3_a";
$password = "Haihoo3shiop";
$database = "mad3_a";
$conn = new mysqli($host, $user, $password, $database);


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
    <link rel="stylesheet" type="text/css" href="CSS/Tabs.css">
    <link rel="stylesheet" type="text/css" href="CSS/ConfirmBikeHire.css">


    <link rel="icon" sizes="192x192" href="Images/icon.png"/>
    <link rel="apple-touch-icon" href="Images/icon.png"/>
    <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

</head>
<main>

    <header>
        <h1>Confirm Hire
            <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button>
        </h1>
    </header>
    <body>


    <div id="googleMap">


    </div>

    <div id="confirmation">

        <?php

        $sql = "SELECT * FROM `Accounts` WHERE `id` =1";

        $result = $conn->query($sql);

        if ($result)
            $row = $result->fetch_assoc();
        $bikeNumber = $row["bikeHired"];
        $hubNumber = $row["bikesHub"];

        $sql2 = "SELECT * FROM `BikeHubs` WHERE `id` = '$hubNumber'";

        $result2 = $conn->query($sql2);

        if ($result2)
            $row2 = $result2->fetch_assoc();
        $address = $row2["address"];

        ?>
        <table id="confirmationTable">
            <tr>
                <td><div id="title">Hub</div><?php
                    switch ($hubNumber) {
                        case 1:
                            ?>
                            <div id="hub">A</div><?php
                            break;
                        case 2:
                            ?>
                            <div id="hub">B</div><?php
                            break;
                        case 3:
                            ?>
                            <div id="hub">C</div><?php
                            break;
                        case 4:
                            ?>
                            <div id="hub">D</div><?php
                            break;
                    } ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo "Bike #$bikeNumber"; ?>
                </td>
            </tr>
            <tr>
                <td> <?php echo "$address"; ?></td>
            </tr>
        </table>
    </div>

    <?php
    if (isset($_POST["confirm"])) {
        $code1 = rand(10, 50);
        $code2 = rand(10, 50);
        $code3 = rand(10, 50);
        $code4 = rand(10, 50);

        ?>
        <div id="message">Your bike is waiting for you!</div>
        <div id="code">
            Unlock code: <?php echo $code1 . $code2 ?></div>
        <div id="code">Lock code: <?php echo $code2 . $code3 ?></div>

        <?php
    } else {
        ?>

        <div class="selectOptions">

            <select id="confirmationTime" onchange="getTotal()">
                <option>Time</option>
                <option value="30">30 Minutes</option>
                <option value="2">2 Hours</option>
                <option value="4">4 Hours</option>
                <option value="24">24 Hours</option>
            </select>
        </div>

        <div id="total">
            Total -
        </div>

        <div id="confirmPayment">
            <form method="POST" action="ConfirmBikeHire.php">
                <input type="submit" value="Confirm Payment (PayPal?)" name="confirm" class="submitButton">
            </form>
        </div>
        <?php
    } ?>
</main>

<div class="tabs">
    <button class="tabButton" onclick="location.href='NewsFeedPage.php';"><img src="Images/NewsFeed.png"></button>
    <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png">
    </button>
    <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/HireBike.png"></button>
    <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png"></button>
</div>
<script src="JavaScript/confirmBikeHire.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-ld-Jrm4iRR45vbE3NVNYSqZ1C8QbroM&callback=googleMap">
</script>
</html>



