<?php
$dbServerName = "cs410-project.cpzyc87uemgs.us-east-2.rds.amazonaws.com";
$dbUserName = "admin";
$dbPassword = "qwerty12";
$dbName = "Movie_Info";

$conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

if ($conn->connect_error) {
    die('Connect error: '. $conn->connect_error);
}
