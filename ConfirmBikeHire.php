<?php

session_start();
if (empty($_SESSION['id'])) {
    session_destroy();
    header("Location: LoginPage.php");
    exit();
}
$userID = $_SESSION["id"];

$date = date('d-m-Y');
$month = date('m');
$host = "devweb2017.cis.strath.ac.uk";
$user = "mad3_a";
$password = "Haihoo3shiop";
$database = "mad3_a";
$conn = new mysqli($host, $user, $password, $database);

$action = isset($_POST["action"]);


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

    <?php
    $date2 = date('d/m/Y H:i:s');

    $sql = "SELECT * FROM `Accounts` WHERE `id` = '$userID'";
    $result = $conn->query($sql);

    if ($result)
        $row = $result->fetch_assoc();
    $bikeHired = $row["bikeHired"];
    $hiring = $row["hiring"];

    $sql = "SELECT * FROM `Accounts` WHERE `id` = '$userID'";

    $result = $conn->query($sql);

    if ($result)
        $row = $result->fetch_assoc();
    $bike = $row["bikeHired"];
    $hub = $row["bikesHub"];


    if (isset($_POST["stop"])) {

        $sql = "UPDATE `BikeHubs` SET `available` = `available`+1 WHERE `id` = '$hub'";
        $conn->multi_query($sql);

        $sql = "UPDATE `Bikes` SET `user` = 0 WHERE `bike` = '$bike'";
        $conn->multi_query($sql);

        $sql = "UPDATE `Accounts` SET `hiring` = 0 WHERE `id` = '$userID'";
        $conn->multi_query($sql);

        $sql = "UPDATE `Accounts` SET `bikeHired` = 0 WHERE `id` = '$userID'";
        $conn->multi_query($sql);

        $sql = "UPDATE `Accounts` SET `bikesHub` = 0 WHERE `id` = '$userID'";
        $conn->multi_query($sql);

        header('location:BikeHubPage.php');
    } else {

        if ($bikeHired == 0) {
            header('location:BikeHubPage.php');
        } else {
            ?>
            <div id="googleMap"></div>
            <?php

            if (isset($_POST["confirm"])) {
                displayBikeInfo($conn);

                $sql = "UPDATE `BikeHubs` SET `available` = `available`-1 WHERE `id` = '$hub'";
                $conn->multi_query($sql);

                $sql = "UPDATE `Accounts` SET `hiring` = 1 WHERE `id` = '$userID'";
                $conn->multi_query($sql);

                $sql = "INSERT INTO `BikeHires` (`id`, `time`, `hub`, `bike`,`user`,`month`) VALUES (NULL, '$date', '$hub', '$bike', '$userID','$month')";
                $conn->multi_query($sql);

                $message = "Just hired bike #" . $bike . " from Hub " . $hub;

                $sql = "SELECT * FROM `Accounts` WHERE `id` = '$userID'";
                $result = $conn->query($sql);


                $row = $result->fetch_assoc();
                $username = $row["username"];


                $sql = "INSERT INTO `Newsfeed` (`message`, `userID`, `time`) VALUES ('$message', '$username', '$date2')";
                $conn->query($sql);

                $code1 = rand(10, 50);
                $code2 = rand(10, 50);
                $code3 = rand(10, 50);
                $code4 = rand(10, 50);

                ?>
                <div id="message">Your bike is waiting for you!</div>
                <div id="code">
                    Unlock code: <?php echo $code1 . $code2 ?></div>
                <div id="code">Lock code: <?php echo $code2 . $code3 ?></div>

                <div id="stopButton">
                    <form method="POST" action="ConfirmBikeHire.php">
                        <input type="submit" value="Stop Hiring Bike" name="stop" class="submitButton">
                    </form>
                </div>

                <?php
            } else if ($hiring == 1) {
                displayBikeInfo($conn);

                $code1 = rand(10, 50);
                $code2 = rand(10, 50);
                $code3 = rand(10, 50);
                $code4 = rand(10, 50);

                ?>
                <div id="message">Your bike is waiting for you!</div>
                <div id="code">
                    Unlock code: <?php echo $code1 . $code2 ?></div>
                <div id="code">Lock code: <?php echo $code2 . $code3 ?></div>

                <div id="stopButton">
                    <form method="POST" action="ConfirmBikeHire.php">
                        <input type="submit" value="Stop Hiring Bike" name="stop" class="submitButton">
                    </form>
                </div>

                <?php
            } else {
                displayBikeInfo($conn);
                ?>

                <div class="selectOptions">

                    <select id="confirmationTime" onchange="getTotal()">
                        <option value="30" selected>30 Minutes</option>
                        <option value="2">2 Hours</option>
                        <option value="4">4 Hours</option>
                        <option value="24">24 Hours</option>
                    </select>
                </div>

                <div id="total">
                    Total £1
                </div>

                <div id="confirmPayment">
                    <form method="POST" action="ConfirmBikeHire.php">
                        <input id="confirm" name="confirm" display="none" type="submit" value="Display Unlock Code"
                               class="submitButton">

                        <div id="paypal-button"></div>
                    </form>
                </div>

                <div id="backButton">
                    <button onclick="location.href='BikeHubPage.php'">Back</button>
                </div>
                <?php
            }
        }
    }

    function displayBikeInfo($conn)
    {
        ?>
        <div id="confirmation">

            <?php
            $userID = $_SESSION["id"];

            $sql = "SELECT * FROM `Accounts` WHERE `id` ='$userID'";

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
                    <td>
                        <div id="title">Hub:</div><?php
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
                        <?php echo "Bike: #$bikeNumber"; ?>
                    </td>
                </tr>
                <tr>
                    <td> <?php echo "Location: $address"; ?></td>
                </tr>
            </table>
        </div>
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
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script>
    var confirmBtn = document.getElementById("confirm");
    confirmBtn.style.display = 'none';


    paypal.Button.render({
        env: 'sandbox',

        client: {
            sandbox: 'AW3O_rJ39E_qL3iOvDr_s9uEw4iHII-G1pQblZ0t0X6rMkKinnN0gBcmo4tKG8uEUhIgFX0bWrIrkz23'
        },

        commit: true, // Show a 'Pay Now' button

        payment: function (data, actions) {
            var timeSelected = document.getElementById("confirmationTime");
            var timeValue = timeSelected.options[timeSelected.selectedIndex].value;
            var amount = 0;
            switch (timeValue) {
                case "30":
                    amount = '1.00';
                    break;
                case "2":
                    amount = '4.00';
                    break;
                case "4":
                    amount = '8.00';
                    break;
                case "24":
                    amount = '10.00';
                    break;
            }
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: {total: amount, currency: 'GBP'}
                        }
                    ]
                }
            });
        },

        onAuthorize: function (data, actions) {
            return actions.payment.execute().then(function (payment) {

                alert("Payment was successful");
                //need to redirect User to HireStatus
                var paypalBtn = document.getElementById("paypal-button");
                var timeSelected = document.getElementById("confirmationTime");
                var backButton = document.getElementById("backButton");
                var total = document.getElementById("total");
                backButton.style.display = 'none';
                total.style.display = 'none';
                timeSelected.style.display = 'none';
                paypalBtn.style.display = 'none';
                confirmBtn.style.display = 'inline';
            });
        }

    }, '#paypal-button');
</script>
<script src="JavaScript/ConfirmBikeHire.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-ld-Jrm4iRR45vbE3NVNYSqZ1C8QbroM&callback=googleMap">
</script>
</html>



