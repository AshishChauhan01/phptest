<?php include('connection.php');
if (!isset($_GET['id']) ||  !is_numeric($_GET['id'])) {
    die("Invalid request.");
}
$id = intval($_GET['id']);
$query = "DELETE FROM students WHERE id = $id";
$result = mysqli_query($conn, $query);

if ($result) {
    $from = $_GET['from'] ?? '';
    if ($from === 'index') {
        header("location:index.php?delete_success=1");
        exit;
    } else {
        header("location:delete.php?delete_success=1");
    }
} else {
    echo "<div class='alert alert-danger'>Failed to delete record: " . mysqli_error($conn) . "</div>";
}
