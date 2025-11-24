<?php include("header.php"); ?>
<?php
$city_query = "SELECT * FROM cities";
$cities_data = mysqli_query($conn, $city_query);

$state_query = "SELECT * FROM states";
$states_data = mysqli_query($conn, $state_query);
if (isset($_POST['submit'])) {
    // $name = $_POST['name'];
    // $class = $_POST['class'];
    // $phone = $_POST['phone'];
    // $city = $_POST['city'];
    // $state = $_POST['state'];
    // $address = $_POST['address'];

    // // Escape all input (PREVENT SQL INJECTION)
    // $name = mysqli_real_escape_string($conn, $name);
    // $class = mysqli_real_escape_string($conn, $class);
    // $phone = mysqli_real_escape_string($conn, $phone);
    // $city = mysqli_real_escape_string($conn, $city);
    // $state = mysqli_real_escape_string($conn, $state);
    // $address = mysqli_real_escape_string($conn, $address);

    $fields = ["name", "class", "phone", "city", "state", "address"];
    foreach ($fields as $field) {
        $$field = mysqli_real_escape_string($conn, $_POST[$field]);
    }
    $query = "INSERT INTO students(`name`, `class`, `phone`, `city`, `state`, `address`) VALUES ('$name', '$class', '$phone', '$city', '$state', '$address')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . "?error=1");
    }
    exit();
}
if (isset($_GET["success"]) && $_GET['success'] == 1) {
    echo "<div class='alert alert-success'>Data successfully inserted</div>";
}
if (isset($_GET["error"]) && $_GET['error'] == 1) {
    echo "<div class='alert alert-danger'>Data not inserted &nbsp;</div>" . mysqli_error($conn);
}
?>
<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="fs-3">Add Record</h2>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" placeholder="Enter Name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Class</label>
                        <input type="text" placeholder="Enter Class Name" name="class" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" placeholder="Enter Phone Number" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select name="city" id="city" class="form-select">
                            <option selected disabled>Select City</option>
                            <?php if (mysqli_num_rows($cities_data) > 0) { ?>
                                <?php while ($cities = mysqli_fetch_assoc($cities_data)) { ?>
                                    <option value="<?php echo $cities['c_id']; ?>"><?php echo $cities['city_name']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <select name="state" id="state" class="form-select">
                            <option selected disabled>Select State</option>
                            <?php if (mysqli_num_rows($states_data) > 0) { ?>
                                <?php while ($states = mysqli_fetch_assoc($states_data)) { ?>
                                    <option value="<?php echo $states['s_id']; ?>"><?php echo $states['state_name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter Address"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>