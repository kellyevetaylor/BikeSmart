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

    $sql = "SELECT * FROM `BikeHires` WHERE `user` = 1";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        ?>
        <table>
            <tr>
                <th>
                    Date
                </th>
                <td>
                    <?php echo $row["time"];?>
                </td>
            </tr>
            <tr>
                <th>
                    Hub
                </th>
                <td>
                    <?php echo $row["hub"];?>
                </td>
            </tr>
            <tr>
                <th>
                    Bike
                </th>
                <td>
                    <?php echo $row["bike"];?>
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