<?php
session_start();
if (empty($_SESSION['id'])) {
    session_destroy();
    header("Location: LoginPage.php");
    exit();
}
$userID = $_SESSION["id"];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>BikeSmart</title>

    <link rel="stylesheet" type="text/css" href="CSS/OverallStandard.css">
    <link rel="stylesheet" type="text/css" href="CSS/HireBike.css">
    <link rel="stylesheet" type="text/css" href="CSS/Tabs.css">


    <link rel="icon" sizes="192x192" href="Images/icon.png"/>
    <link rel="apple-touch-icon" href="Images/icon.png"/>
    <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>
</head>


<main>
    <header>
        <h1>Hire Bike
            <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button>
        </h1>
    </header>
    <form method="post">
        <?php

        $host = "devweb2017.cis.strath.ac.uk";
        $user = "mad3_a";
        $password = "Haihoo3shiop";
        $database = "mad3_a";
        $conn = new mysqli($host, $user, $password, $database);

        $sql = "SELECT * FROM `Accounts` WHERE `id` = '$userID'";
        $result = $conn->query($sql);

        if ($result)
            $row = $result->fetch_assoc();
        $hiring = $row["hiring"];

        if ($hiring == 1){
            header('location:ConfirmBikeHire.php');
        }else{

        $sql = "UPDATE `Accounts` SET `bikeHired` = 0 WHERE `id` = '$userID'";
        $conn->multi_query($sql);

        $sql = "UPDATE `Accounts` SET `bikesHub` = 0 WHERE `id` = '$userID'";
        $conn->multi_query($sql);

        ?>

        <div id="googleMap">

        </div>
        </div>
        <table>
            <tr>
                <th>Bike Hub</th>
                <th>Bikes Available</th>
                <th>Distance</th>
            </tr>
            <?php
            $sql = "SELECT * FROM `BikeHubs`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $i = $row["id"];
                    $j = $row["available"];

                    echo "<tr>";
                    echo "<td>";

                    switch ($row["id"]) {
                        case 1:
                            echo "A";
                            break;
                        case 2:
                            echo "B";
                            break;
                        case 3:
                            echo "C";
                            break;
                        case 4:
                            echo "D";
                            break;
                    }

                    echo "</td>";
                    echo "<td>";
                    echo $row["available"];
                    echo "<td >";
                    echo "<div id=\"distanceTest" . $row["id"] . "\">";

                    echo "</div>";

                    echo "</td>";
                    echo "<td>";
                    ?>
                    <input type='submit' name="<?php echo "Hire" . $i; ?>" class="submitButton"
                           value='Hire Bike'
                           formaction='BikeHubPage.php'>


                    <?php
                    echo "</td>";
                    echo "</tr>";


                    if (isset($_POST["Hire$i"])) {

                        if ($j <= 0) {
                            echo '<script type="text/javascript">alert("This hub currently has no bikes available.");</script>';
                        } else {
                            $sql = "UPDATE `Bikes` SET `user` = 1 WHERE `hub` = '$i' AND `user` = 0 AND `bike` = '$j'";
                            $conn->multi_query($sql);

                            $sql = "UPDATE `Accounts` SET `bikeHired` = '$j' WHERE `Accounts`.`id` = $userID;";
                            $conn->multi_query($sql);

                            $sql = "UPDATE `Accounts` SET `bikesHub` = '$i' WHERE `Accounts`.`id` = $userID;";
                            $conn->multi_query($sql);


                            ?>
                            <input type="hidden" name="hireBike" value="hireBike"><br>
                            <?php
                            unset($_POST["Hire$i"]);
                            header('location:ConfirmBikeHire.php');

                        }
                    }

                }
            }
            ?>
        </table>
    </form>
    <?php
    }
    ?>
</main>

<div class="tabs">
    <button class="tabButton" onclick="location.href='NewsFeedPage.php';"><img src="Images/NewsFeed.png"></button>
    <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png">
    </button>
    <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/keyOld.png"></button>
    <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png"></button>
</div>
<script src="JavaScript/HirebikePage.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-ld-Jrm4iRR45vbE3NVNYSqZ1C8QbroM&callback=googleMap">
</script>


</html>