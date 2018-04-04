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

    <p><img src="Images/avatar.jpg" height="150" width="150"></p>
    <p>Name placeholder</p>

    <button onclick="myFunction()" class="changePassword">Change password</button>

    <div id="dropdownP" class="dropdownContent">
    <table>
        <tr>
            <td>Old password:</td>
            <td><input type="text" name="oldPassword"></td>
        </tr>
        <tr>
            <td>New password:</td>
            <td><input type="text" name="newPassword1"></td>
        </tr>
        <tr>
            <td>Retype password:</td>
            <td><input type="text" name="newPassword2"></td>
        </tr>
    </table>
    <input type="submit" class="submit">
    </div>

    <div class="tabs">
        <button class="tabButton" onclick="location.href='NewsFeedPage.html';">News Feed</button>
        <button class="tabButton" onclick="location.href='QuickstartPage.php';">Quickstart</button>
        <button class="tabButton" onclick="location.href='HirebikePage.php';">Hire Bike</button>
        <button class="tabButton" onclick="location.href='AccountPage.php';">Account</button>
    </div>
</main>
<script src="JavaScript/AccountPage.js"></script>
</html>