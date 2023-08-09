<?php
// Include the config.php file to establish a database connection
include '../include/config.php';
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">About Us Data</h1>
    </div>

    <!-- Row -->
    <div class="row justify-content-center">
        <?php
        // Prepare and execute the SQL query to fetch data from the about_us table
        $sql = "SELECT * FROM about_us";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <!-- Display about us data using cards -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-6">
                                <img src="../uploads/<?php echo $row['image1_url']; ?>" class="card-img-top" alt="Image 1">
                            </div>
                            <div class="col-6">
                                <img src="../uploads/<?php echo $row['image2_url']; ?>" class="card-img-top" alt="Image 2">
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['heading']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <a href="edit-about.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
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
