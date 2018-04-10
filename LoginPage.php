<?php
session_start();
if (!empty($_SESSION['userId'])) {
    session_destroy();
    header("Location: LoginPage.php"); /* Redirect browser */
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <p><img src = "Images/Logo.png" height= "200" width="400"></p>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/LoginPage.css"/>
    <link rel="icon" sizes="192x192" href="Images/icon.png"/>
    <link rel="apple-touch-icon" href="Images/icon.png"/>
    <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

</head>

<body>

<?php
$host = "devweb2017.cis.strath.ac.uk";
$user = "mad3_a";
$password = "Haihoo3shiop";
$database = "mad3_a";
$conn = new mysqli($host, $user, $password, $database);

if (isset($_POST["login"])) {
    if (checkDatabase($conn)) {
        header('location:NewsFeedPage.php');
    } else {
        echo '<script type="text/javascript">alert("Your username and/or password is incorrect.");</script>';
        displayForm();
    }
} else {
    displayForm();
}

function checkDatabase($conn)
{
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $sql = "SELECT * FROM `Accounts`";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        if ($row["username"] == $username && $row["password"] == $password) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["user"] = $row["username"];
            $_SESSION["name"] = $row["first name"];
            $_SESSION["sname"] = $row["second name"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["details"] = $result;
            return true;
        }
    }
    return false;
}

function displayForm()
{
    ?>
    <form name="loginForm" method="POST">
        <p>Username <input type="text" name="username" style="font-size: 1.5rem; width: 20rem;"><br></p>
        <p>Password <input type="password" name="password" style="font-size: 1.5rem; width: 20rem;"><br></p>
        <p id="submit"><input type="submit" name="login" id="b1" value="Log in"></p>
        <p id="changeAccount"><input type="button" id="b2" value="Create new account"
                                     onclick="location.href='NewAccount.php'"></p>
    </form>
    <?php
}

?>
</body>

<script src="JavaScript/LoginPage.js"></script>

</html>
