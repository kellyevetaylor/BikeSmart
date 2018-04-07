<input type="text" name="commentText" id="commentText"/>
<button class="postButton" onclick="">Post Comment</button>
<?php

$date = date('U = Y-m-d H:i:s');
$host = "devweb2017.cis.strath.ac.uk";
$user = "mad3_a";
$password = "Haihoo3shiop";
$database = "mad3_a";
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection Failed :" . $conn->connect_error); //FIXME remove once working.
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["commentText"])) {
        $comment = $_POST["commentText"];
        $sql = "INSERT INTO `column_comment` VALUES ('$comment')
        WHERE table_schema = 'mad3_a' AND table_name = 'Newsfeed'";

        $conn->query($sql);

        header('location:CommentPage.php');
    }
}

?>