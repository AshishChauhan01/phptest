<?php
include('header.php'); ?>
<?php
$query = "SELECT * FROM students as st 
LEFT JOIN cities as c ON st.city = c.c_id 
LEFT JOIN states as s ON st.state = s.s_id";
$result = mysqli_query($conn, $query);

?>
<section class="main-content">
    <div class="container">
        <h2 class="fs-24 mt-4">
            All Records
        </h2>
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-striped mt-2 table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Address</th>
                        <th>Actine</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                        <tr class="text-start">
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['name']; ?></td>
                            <td><?php echo $data['class']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $data['city_name']; ?></td>
                            <td><?php echo $data['state_name']; ?></td>
                            <td><?php echo $data['address']; ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="text-muted fs-4">*Records not found.</p>
        <?php } ?>
    </div>
</section>

<?php include('footer.php'); ?>