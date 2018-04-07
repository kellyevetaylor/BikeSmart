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
        <?php

        $host = "devweb2017.cis.strath.ac.uk";
        $user = "mad3_a";
        $password = "Haihoo3shiop";
        $database = "mad3_a";
        $conn = new mysqli($host, $user, $password, $database);


        if (isset($_POST["hireBike"])) {

            $sql = "SELECT * FROM `Accounts` WHERE `id` =1";

            $result = $conn->query($sql);
            if ($conn->connect_error) {
                die("Connection Failed :" . $conn->connect_error); //FIXME remove once working.
            }


            if ($result)
                $row = $result->fetch_assoc();
            $bikeNumber = $row["bikeHired"];
            $hubNumber = $row["bikesHub"];
            $name = $row["first name"];

            echo "Hello";
            echo "$bikeNumber";
            echo "$hubNumber";
            echo "$name";


        }
        else{
        ?>
        <header>
            <h1>Hire Bike
                <button class="logoutButton" onclick="location.href='LoginPage.php';">Logout</button>
            </h1>
        </header>

        <div id="googleMap">

        </div>

        <?php
        /* $sql = "SELECT * FROM `Bikes` WHERE `RentedBy` = \"kellytaylor\"";
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

         else{*/
        ?>

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
                    echo "<td>";
                    echo $row["distance"];
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


                        $sql = "UPDATE `BikeHubs` SET `available` = `available`-1 WHERE `id` = '$i'";
                        $conn->multi_query($sql);

                        $sql = "UPDATE `Bikes` SET `user` = 1 WHERE `hub` = '$i' AND `user` = 0 AND `bike` = '$j'";
                        $conn->multi_query($sql);

                        $sql = "UPDATE `Accounts` SET `bikeHired` = '$i' WHERE `Accounts`.`id` = 1;";
                        $conn->multi_query($sql);


                        $sql = "UPDATE `Accounts` SET `bikesHub` = '$j' WHERE `Accounts`.`id` = 1;";
                        $conn->multi_query($sql);


                        //bike number $j at hub $i

                        ?>
                        <input type="hidden" name="hireBike" value="hireBike"><br>
<?php
                        unset($_POST["Hire$i"]);
                        header('location:BikeHubPage.php');
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
    <button class="tabButton" onclick="location.href='NewsFeedPage.html';"><img src="Images/NewsFeed.png"></button>
    <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png">
    </button>
    <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/HireBike.png"></button>
    <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png"></button>
</div>
<script src="JavaScript/HirebikePage.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-ld-Jrm4iRR45vbE3NVNYSqZ1C8QbroM&callback=googleMap">
</script>

</html>