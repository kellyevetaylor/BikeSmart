<!DOCTYPE html>
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
    <form method="post">
        <header>
            <h1>Hire Bike
                <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button>
            </h1>
        </header>

            <div id="googleMap">

            </div>

            <?php

            $host = "devweb2017.cis.strath.ac.uk";
            $user = "mad3_a";
            $password = "Haihoo3shiop";
            $database = "mad3_a";
            $conn = new mysqli($host, $user, $password, $database);

            $sql = "SELECT * FROM `Bikes` WHERE `RentedBy` = \"kellytaylor\"";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row["ID"];

                    echo "You are already renting a bike";

                    echo "Bike ID: " . $row["ID"];
                    echo "Bike Hub: " . $row["Bike_Hub"];
                    ?>
                    <form method="post">
                        <input type="submit" name="unhire" value="Unhire Bike!">
                    </form><?php

                    if (isset($_POST["unhire"])) {
                        $sql = "UPDATE `Bikes` SET `Available` = 1 WHERE `ID` = $id ";
                        $conn->query($sql);
                        $sql = "UPDATE `Bikes` SET `RentedBy` = NULL WHERE `ID` = $id ";
                        $conn->query($sql);
                        header('location:BikeHubPage.php');

                    }
                }
            }

            else{
            ?>

            <table>
                <tr>
                    <th>Bike Hub</th>
                    <th>Bikes Available</th>
                    <th>Distance</th>
                </tr>
                <?php
                $sql = "SELECT * FROM `Bikes`";
                $result = $conn->query($sql);
                if (!$result === TRUE) {
                    die("Error on insert" . $conn->error);
                }
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $i = $row["ID"];

                        if ($row["Available"] == 1) {
                            echo "<tr>";
                            echo "<td>" ;
                            echo $row["Bike_Hub"];
                            echo "</td>";
                            echo "<td>";
                            echo $row["Available"];
                            echo "<td>";
                            echo $row["ID"];
                            echo "</td>";
                            echo "<td>";
                            ?>
                            <input type='submit' name="<?php echo "Hire" . $i; ?>" class="submitButton"
                                   value='Hire Bike'
                                   formaction='HirePage.php'>

                            <?php
                            echo "</td>";
                            echo "</tr>";
                            if (isset($_POST["Hire$i"])) {
                                $sql = "UPDATE `Bikes` SET `RentedBy` = \"kellytaylor\" WHERE `ID`=$i";
                                $conn->query($sql);

                                $sql = "UPDATE `Bikes` SET `Available` = 0 WHERE `ID`=$i";
                                $conn->query($sql);

                                unset($_POST["Hire$i"]);
                                header('location:BikeHubPage.php');
                            }
                        }
                    }
                }
                }
                ?>
            </table>

        <div id="distanceT">HERE: </div>
    </form>
</main>

<div class="tabs">
    <button class="tabButton" onclick="location.href='NewsFeedPage.html';">News Feed</button>
    <button class="tabButton" onclick="location.href='QuickstartPage.php';">Quickstart</button>
    <button class="tabButton" onclick="location.href='BikeHubPage.php';">Hire Bike</button>
    <button class="tabButton" onclick="location.href='AccountPage.php';">Account</button>
</div>

<script src="JavaScript/HirebikePage.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-ld-Jrm4iRR45vbE3NVNYSqZ1C8QbroM&callback=googleMap">
</script>

</html>