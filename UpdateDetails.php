<?php
session_start();
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
    <link rel="stylesheet" type="text/css" href="CSS/Tabs.css">

    <link rel="stylesheet" type="text/css" href="CSS/AccountPage.css">


    <link rel="icon" sizes="192x192" href="Images/icon.png"/>
    <link rel="apple-touch-icon" href="Images/icon.png"/>
    <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>
</head>


<header>
    <h1 class="header">Update details
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

    $action = isset($_POST["action"]);



    if (isset($_POST["submit"])) {
        changePassword($conn);
    } else if (isset($_POST["update"])) {
        updateDetails($conn);
        header("location:AccountPage.php");
    }

    function updateDetails($conn)
    {
        $fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
        $sname = isset($_POST["sname"]) ? $_POST["sname"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $username = isset($_POST["username"]) ? $_POST["username"] : "";

        //this works if you hard code a name but not when you use the variable
        if ($fname != "") {
            $sql = "UPDATE `Accounts` SET `first name` = '$fname' WHERE `Accounts`.`id` = $userID";
            $conn->query($sql);
        }
        if ($sname != "") {
            $sql = "UPDATE `Accounts` SET `second name` = '$sname' WHERE `Accounts`.`id` = $userID";
            $conn->query($sql);
        }
        if ($email != "") {
            $sql = "UPDATE `Accounts` SET `email` = '$email' WHERE `Accounts`.`id` = $userID";
            $conn->query($sql);
        }
        if ($username != "") {
            $sql = "UPDATE `Accounts` SET `username` = '$username' WHERE `Accounts`.`id` = $userID";
            $conn->query($sql);
        }
        echo '<script type="text/javascript">alert("Update successful.");</script>';
    }

    function changePassword($conn)
    {
        $oldPassword = isset($_POST["oldPassword"]) ? $_POST["oldPassword"] : "";
        $newPassword1 = isset($_POST["newPassword1"]) ? $_POST["newPassword1"] : "";
        $newPassword2 = isset($_POST["newPassword2"]) ? $_POST["newPassword2"] : "";

        if ($oldPassword == "" || $newPassword1 == "" || $newPassword2 == "") {
            echo '<script type="text/javascript">alert("All fields must be filled.");</script>';
        } else {
            $userID = $_SESSION["id"];

            $sql = "SELECT `password` FROM `Accounts`";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                //checking that password exists within the database
                if ($row["password"] == $oldPassword /*&& $row[id] == session id*/) {
                    if ($newPassword1 == $newPassword2) {
                        //id will be changed when sessions are in place
                        $sql = "UPDATE `Accounts` SET `password` = $newPassword1 WHERE `Accounts`.`id` = '$userID'";
                        $conn->query($sql);
                        echo '<script type="text/javascript">alert("Update successful.");</script>';
                    } else {
                        echo '<script type="text/javascript">alert("Your passwords do not match.");</script>';
                    }
                } else {
                    echo '<script type="text/javascript">alert("Your old password is incorrect.");</script>';
                }
            }
        }
    }

    ?>

    <form method="POST" action="UpdateDetails.php">
        <table style="width: 30%">
            <tr>
                <td>First name:</td>
                <td><input type="text" class="inputBox" name="fname"></td>
            </tr>
            <tr>
                <td>Second name:</td>
                <td><input type="text" class="inputBox" name="sname"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" class="inputBox" name="email"></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" class="inputBox" name="username"></td>
            </tr>
        </table>
        <span style="display: inline;">
        <p id="update"><input type="submit" class="update" name="update" value="Update"></p>
        </span>
    </form>

    <p><button onclick="location.href = 'AccountPage.php'">Cancel</button></p>
    <p>
        <button onclick="myFunction()" class="changePassword">Change password</button>
    </p>

    <div id="dropdownP" class="dropdownContent">
        <form method="POST" action="UpdateDetails.php">
            <table>
                <tr>
                    <td>Old password:</td>
                    <td><input type="text" class="inputBox" name="oldPassword"></td>
                </tr>
                <tr>
                    <td>New password:</td>
                    <td><input type="text" class="inputBox" name="newPassword1"></td>
                </tr>
                <tr>
                    <td>Retype password:</td>
                    <td><input type="text" class="inputBox" name="newPassword2"></td>
                </tr>
            </table>
            <input type="submit" class="submit" name="submit">
        </form>
    </div>
</main>
<div class="tabs">
    <button class="tabButton" onclick="location.href='NewsFeedPage.php';"><img src="Images/NewsFeed.png" ></button>
    <button class="tabButton" onclick="location.href='QuickstartPage.php';"><img src="Images/QuickstartIcon2.png" ></button>
    <button class="tabButton" onclick="location.href='BikeHubPage.php';"><img src="Images/HireBike.png" ></button>
    <button class="tabButton" onclick="location.href='AccountPage.php';"><img src="Images/AccountIcon2.png" ></button>
</div>
<script src="JavaScript/AccountPage.js"></script>
</html>