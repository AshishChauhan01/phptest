<?php
include('connection.php');
setcookie("details", "Ashish Chauhan", time() + (86400));

if (!isset($_COOKIE['details'])) {
    echo "Cookie not set yet";
} else {
    echo $_COOKIE['details'];
}

echo "<br>";
//session 

//start session
session_start();
//set session varible value
$_SESSION["name"] = "Ashish Chauhan";
$_SESSION["role"] = "Admin";
//get session value
echo $_SESSION["name"] . " " . $_SESSION["role"];
if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
    echo "<pre>";
    print_r($_FILES['image']);
    echo "</pre>";

    $file_name = $_FILES['image']['name'];
    $name = pathinfo($file_name, PATHINFO_FILENAME); //file info without extentiion
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_type = $_FILES['image']['type'];
    $file_temp_name = $_FILES['image']['tmp_name'];
    $file_error = $_FILES['image']['error'];
    $file_size = $_FILES['image']['size'];
    $file_size_kb =  round($file_size / 1024, 3);
    $file_new_name = $name . "_" . date("dmyhis") . "." . $ext;
    if (move_uploaded_file($file_temp_name, "images/" . $file_new_name)) {
        echo "File uploaded successfully.";
    } else {
        echo "File not uploaded successfully";
    }
    echo "<br>" . $file_size_kb . "kb";
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <input type="text" name="user_name">
    </div>
    <div>
        <input type="file" name="image">
    </div>
    <button type="submit">Submit</button>
</form>