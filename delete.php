<?php include('header.php') ?>
<?php
$query = "SELECT * FROM students as st LEFT JOIN cities as c ON st.city = c.c_id LEFT JOIN states as s on st.state = s.s_id";
$results = mysqli_query($conn, $query);

?>
<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="fs-3">Update Record</h2>
                <?php if (mysqli_num_rows($results)) { ?>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Select Record<sup><b>[*That one you want to delete.]</b></sup></label>
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
                <?php if (isset($_POST['show_record'])) { ?>
                    <?php
                    $record_id = $_POST['custom_id'];
                    $query = $query . " WHERE id =  '$record_id' ";
                    $fetch_record = mysqli_query($conn, $query);
                    $record = mysqli_fetch_assoc($fetch_record);
                    ?>
                    <div class="text-end mt-4">
                        <a href="delete_query.php?id=<?= $record_id; ?>" class="btn btn-danger btn-sm">Delete Record</a>
                    </div>
                    <div class="show-details mt-2">
                        <div class="row">
                            <div class="col-md-12">
                                <b>Id:</b> <?= $record['id']; ?>
                            </div>
                            <div class="col-md-6">
                                <b>Name:</b> <?= $record['name']; ?>
                            </div>
                            <div class="col-md-6">
                                <b>Class:</b> <?= $record['class']; ?>
                            </div>
                            <div class="col-md-6">
                                <b>Phone:</b> <?= $record['phone']; ?>
                            </div>
                            <div class="col-md-6">
                                <b>City:</b> <?= $record['city_name']; ?>
                            </div>
                            <div class="col-md-6">
                                <b>State:</b> <?= $record['state_name']; ?>
                            </div>
                            <div class="col-md-6">
                                <b>Address:</b> <?= $record['address']; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php') ?>