<?php include('header.php') ?>
<?php
$query = "SELECT * FROM students";
$results = mysqli_query($conn, $query);

$cities_query = "SELECT * FROM cities";
$cities_data = mysqli_query($conn, $cities_query);

$state_query = "SELECT * FROM states";
$states_data = mysqli_query($conn, $state_query);

if (isset($_POST['update'])) {
    $fields = ['id', 'name', 'class', 'phone', 'city', 'state', 'address'];
    foreach ($fields as $field) {
        $$field = mysqli_real_escape_string($conn, $_POST[$field]);
    }
    $update_query = "UPDATE students SET name = '$name', class = '$class', phone = '$phone', city = '$city', state = '$state', address = '$address' WHERE id = $id";
    $excute_query = mysqli_query($conn, $update_query);
    if ($excute_query) {
        echo "<div class='alert alert-success'>Record updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Record not updated successfully</div>";
    }
}
?>
<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="fs-3">Update Record</h2>
                <?php if (mysqli_num_rows($results)) { ?>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Select Record<sup><b>[*That one you want to edit.]</b></sup></label>
                            <select name="custom_id" class="form-select">
                                <option selected disabled>---Select Record---</option>
                                <?php if (mysqli_num_rows($results) > 0) {
                                    foreach ($results as $result):
                                ?>
                                        <option value="<?php echo $result['id']; ?>">
                                            <?php echo $result['name'] . "&nbsp;(" . $result['class'] . ", &nbsp;" . $result['phone'] . ")" ?>
                                        </option>
                                <?php
                                    endforeach;
                                } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-warning" name="show_record">Show Record</button>
                    </form>
                <?php } else { ?>
                    <p class="fs-4 text-muted">*Records not found.</p>
                <?php } ?>
                <?php if (isset($_POST['show_record']) && isset($_POST['custom_id'])) {
                    $custom_id = intval($_POST['custom_id']);
                    $fetch_records_query = "SELECT * FROM students WHERE id = $custom_id";
                    $fetch_records = mysqli_query($conn, $fetch_records_query);
                    if (!$fetch_records) {
                        die("Record not found");
                    }
                    $fetch_record = mysqli_fetch_assoc($fetch_records);
                ?>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" class="mt-4 mb-4">
                        <input type="hidden" name="id" value="<?php echo $custom_id; ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" placeholder="Enter Name" name="name" value="<?php echo $fetch_record['name']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="class" class="form-label">Class</label>
                            <input type="text" placeholder="Enter Class Name" name="class" value="<?php echo $fetch_record['class']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" placeholder="Enter Phone Number" name="phone" value="<?php echo $fetch_record['phone']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <select name="city" id="city" class="form-select">
                                <option disabled>Select City</option>
                                <?php if (mysqli_num_rows($cities_data) > 0) { ?>
                                    <?php while ($cities = mysqli_fetch_assoc($cities_data)) { ?>
                                        <option value="<?php echo $cities['c_id']; ?>" <?php echo $fetch_record['city'] == $cities['c_id'] ? 'selected' : '' ?>><?php echo $cities['city_name']; ?></option>
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
                                        <option value="<?php echo $states['s_id']; ?>" <?php echo $fetch_record['state'] == $states['s_id'] ? 'selected' : ''; ?>><?php echo $states['state_name']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter Address"><?php echo $fetch_record['address']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning" name="update">Update</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php') ?>