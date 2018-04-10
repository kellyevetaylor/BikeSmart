<?php
session_start();

$userID = $_SESSION["id"];


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
    <link rel="stylesheet" type="text/css" href="CSS/History.css">


    <link rel="icon" sizes="192x192" href="Images/Logo.png"/>
    <link rel="apple-touch-icon" href="Images/Logo.png"/>
    <link rel="shortcut icon" href="Images/Logo.png" type="image/x-icon"/>

</head>


<header>
    <h1 class="header">Hire History
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
    $janSet = 0;
    $febSet = 0;
    $marSet = 0;
    $aprSet = 0;
    $maySet = 0;
    $juneSet = 0;
    $julySet = 0;
    $augSet = 0;
    $sepSet = 0;
    $octSet = 0;
    $novSet = 0;
    $decSet = 0;

    $sql = "SELECT * FROM `BikeHires` WHERE `user` = '$userID' ORDER BY `month` DESC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        switch ($row["month"]) {
            case 01:
                if ($janSet == 0) {
                    ?>
                    <div id="month">
                        January 2018
                    </div>
                    <?php
                    $janSet = 1;
                }
                displayInfo($row);
                break;
            case 02:
                if ($febSet == 0) {
                    ?>
                    <div id="month">
                        February 2018
                    </div>
                    <?php
                    $febSet = 1;
                }
                displayInfo($row);
                break;
            case 03:
                if ($marSet == 0) {
                    ?>
                    <div id="month">
                        March 2018
                    </div>
                    <?php
                    $marSet = 1;
                }
                displayInfo($row);
                break;
            case 04:
                if ($aprSet == 0) {
                    ?>
                    <div id="month">
                        April 2018
                    </div>
                    <?php
                    $aprSet = 1;
                }
                displayInfo($row);
                break;
            case 05:
                if ($maySet == 0) {
                    ?>
                    <div id="month">
                        May 2018
                    </div>
                    <?php
                    $maySet = 1;
                }
                displayInfo($row);
                break;
            case 06:
                if ($juneSet == 0) {
                    ?>
                    <div id="month">
                        June 2018
                    </div>
                    <?php
                    $juneSet = 1;
                }
                displayInfo($row);
                break;
            case 07:
                if ($julySet == 0) {
                    ?>
                    <div id="month">
                        July 2018
                    </div>
                    <?php
                    $julySet = 1;
                }
                displayInfo($row);
                break;
            case "08":
                if ($augSet == 0) {
                    ?>
                    <div id="month">
                        August 2018
                    </div>
                    <?php
                    $augSet = 1;
                }
                displayInfo($row);
                break;
            case "09":
                if ($sepSet == 0) {
                    ?>
                    <div id="month">
                        September 2018
                    </div>
                    <?php
                    $sepSet = 1;
                }
                displayInfo($row);
                break;
            case 10:
                if ($octSet == 0) {
                    ?>
                    <div id="month">
                        October 2018
                    </div>
                    <?php
                    $octSet = 1;
                }
                displayInfo($row);
                break;
            case 11:
                if ($novSet == 0) {
                    ?>
                    <div id="month">
                        November 2018
                    </div>
                    <?php
                    $novSet = 1;
                }
                displayInfo($row);
                break;
            case 12:
                if ($decSet == 0) {
                    ?>
                    <div id="month">
                        December 2018
                    </div>
                    <?php
                    $decSet = 1;
                }
                displayInfo($row);
                break;
        }
    }

    function displayInfo($row)
    {
        switch ($row["hub"]) {
            case 1:
                $hub = "A";
                $address = "George Square";
                break;
            case 2:
                $hub = "B";
                $address = "Livingstone Tower";
                break;
            case 3:
                $hub = "C";
                $address = "City of Glasgow College";
                break;
            case 4:
                $hub = "D";
                $address = "Glasgow Green";
                break;
        }
        ?>
        <table id="history">
            <tr>
                <th id="headings">
                    <?php echo $row["time"] ?>
                </th>
            </tr>
            <tr>
                <td>
                    <?php echo "You hired bike #" . $row["bike"] . " from Hub " . $hub . " at " . $address; ?>
                </td>
            </tr>
        </table>
        <?php
    }

    ?>
    <div class="tabs">
        <button class="tabButton" onclick="location.href='NewsFeedPage.php';"><img src="Images/NewsFeed.png"></button>
        <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png">
        </button>
        <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/HireBike.png"></button>
        <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png">
        </button>
    </div>

</html>