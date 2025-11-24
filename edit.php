<?php include('header.php');

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$data_id = intval($_GET['id']);

$query = "SELECT * FROM students WHERE id = $data_id";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);
if (!$result) {
    die("Record not found");
}
$cities_query = "SELECT * FROM cities";
$cities_data = mysqli_query($conn, $cities_query);

$state_query = "SELECT * FROM states";
$states_data = mysqli_query($conn, $state_query);

if (isset($_POST['update'])) {
    $fields = ['name', 'class', 'phone', 'city', 'state', 'address'];
    foreach ($fields as $field) {
        $$field = mysqli_real_escape_string($conn, $_POST[$field]);
    }

    $update_query = "UPDATE students SET name = '$name', class= '$class', phone = '$phone', city = '$city', state = '$state', address = '$address' WHERE id = $data_id";
    $excute_query = mysqli_query($conn, $update_query);
    if ($excute_query) {
        header("location: index.php?update_success=1");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Record not updated : " . mysqli_error($conn) . " </div>";
    }
    exit();
}

?>

<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="fs-3">Edit Record</h2>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $data_id; ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" placeholder="Enter Name" name="name" value="<?php echo $result['name']; ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Class</label>
                        <input type="text" placeholder="Enter Class Name" name="class" value="<?php echo $result['class']; ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" placeholder="Enter Phone Number" name="phone" value="<?php echo $result['phone']; ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select name="city" id="city" class="form-select">
                            <option disabled>Select City</option>
                            <?php if (mysqli_num_rows($cities_data) > 0) { ?>
                                <?php while ($cities = mysqli_fetch_assoc($cities_data)) { ?>
                                    <option value="<?php echo $cities['c_id']; ?>" <?php echo $result['city'] == $cities['c_id'] ? 'selected' : '' ?>><?php echo $cities['city_name']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <select name="state" id="state" class="form-select">
                            <option disabled>Select State</option>
                            <?php if (mysqli_num_rows($states_data) > 0) { ?>
                                <?php while ($states = mysqli_fetch_assoc($states_data)) { ?>
                                    <option value="<?php echo $states['s_id']; ?>" <?php echo $result['state'] == $states['s_id'] ? 'selected' : ''; ?>><?php echo $states['state_name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter Address"><?php echo $result['address']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>