<?php
/**
 * Created by IntelliJ IDEA.
 * User: hong
 * Date: 03/04/2018
 * Time: 13:26
 */

function connectOrDie(){
    $username="mad3_a";$password="Haihoo3shiop"; $database="mad3_a"; $servername="devweb2017.cis.strath.ac.uk";

    $mysqli = new mysqli($servername,$username,$password,$database);
    if($mysqli->connect_errno) {
        die("Connect failed: %s " . $mysqli->connect_error);
    }
    return $mysqli;
}

function addNewPost($mysqli, $post, $postID){
    if($mysqli->query('INSERT INTO Newsfeed(`message`,`id`)VALUES(\''.$post.'\','.$postID.')')){
        return $postID;
    }else{
        die("Query failed: %s ".$mysqli->error);
    }
}

$mysqli = connectOrDie();
$post = $mysqli->real_escape_string(urldecode($_POST["msg"]));
$postID = $mysqli->real_escape_string(urldecode($_POST["id"]));
$id = addNewPost($mysqli, $post, $postID);
echo "$id";