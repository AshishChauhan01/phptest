<?php
if (!isset($_COOKIE['details'])) {
    echo "Cookie not set Yet";
} else {
    echo $_COOKIE['details'];
}

setcookie("details", "", time() - (84600));

echo "<br>";

session_start();
if (isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
    $role = $_SESSION["role"];
    echo "Name:" . $name . "<br>" . "Role: " . $role;
} else {
    echo "session not set yet";
}
session_unset();
session_destroy();
