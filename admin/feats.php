<?php
// Include the config.php file to establish a database connection
include '../include/config.php';
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Facts Data</h1>
    </div>

    <!-- Row -->
    <div class="row justify-content-center">
        <?php
        // Prepare and execute the SQL query to fetch data from the facts table
        $sql = "SELECT * FROM facts";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <!-- Display facts data using cards -->
                <div class="col-lg-4 mb-4">
                    <div class="card bg-warning">
                        <div class="card-body">
                            <i class="<?php echo $row['icon_class']; ?>"></i>
                            <h5 class="card-title text-white">
                                <?php echo $row['count']; ?>
                            </h5>
                            <p class="card-text text-white">
                                <?php echo $row['label']; ?>
                            </p>
                            <a href="edit-feats.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p>No data available.</p>';
        }
        ?>
    </div>

</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>