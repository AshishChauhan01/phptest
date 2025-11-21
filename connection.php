<?php
$coonection_page = true;

$server = "localhost";
$user_name = "root";
$password = "";
$db_name = "php";

$conn = mysqli_connect($server, $user_name, $password, $db_name);


if (isset($connection_page)) {
    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    } else {
        echo "Database Connected Successfully";
    }
}
