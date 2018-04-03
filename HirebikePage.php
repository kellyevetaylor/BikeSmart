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

</head>


<main>
    <form method="post">
    <header><h1>Hire Bike</h1></header>
    <body>

    <?php

$host = "devweb2017.cis.strath.ac.uk";
$user = "mad3_a";
$password = "Haihoo3shiop";
$database = "mad3_a";
$conn = new mysqli($host, $user, $password, $database);

    $sql = "SELECT * FROM `Bikes` WHERE `RentedBy` = \"kellytaylor\"";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "You are already renting a bike";
    }

    else{
    ?>

    <table>
        <tr>
            <td>Bike ID</td>
            <td>Bike Hub</td>
            <td>Available</td>
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
                    echo "<td>" . "<br>";
                    echo $row["ID"];
                    echo "</td>" . "<br>";
                    echo "<td>" . "<br>";
                    echo $row["Bike_Hub"];
                    echo "<td>" . "<br>";
                    echo $row["Available"];
                    echo "</td>" . "<br>";
                    echo "<td>" . "<br>";
                    ?>
                    <input type='submit' name="<?php echo "Hire" . $i; ?>" value='Hire Bike'
                           formaction='HirebikePage.php'>

                    <?php
                    echo "</td>" . "<br>";
                    echo "</tr>";
                    if (isset($_POST["Hire$i"])) {
                        $sql = "UPDATE `Bikes` SET `RentedBy` = \"kellytaylor\" WHERE `ID`=$i";
                        $conn->query($sql);

                        $sql = "UPDATE `Bikes` SET `Available` = 0 WHERE `ID`=$i";
                        $conn->query($sql);


                        unset($_POST["Hire$i"]);
                        header('location:HirebikePage.php');


                    }

                }
            }

        }
        }
    ?>
</form>
</table>
</body>
</main>

<div class="tabs">
    <button class="tabButton" onclick="location.href='NewsFeedPage.html'">News Feed</button>
    <button class="tabButton" onclick= "location.href='AccountPage.html';">Account</button>
    <button class="tabButton" onclick="location.href='QuickstartPage.html';">Quickstart</button>
</div>

</html>