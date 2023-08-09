<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input data
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);

    // Check if the service_id exists in the services table
    $sql_check_service = "SELECT * FROM services WHERE id = '$service_id'";
    $result_check_service = mysqli_query($conn, $sql_check_service);

    if (mysqli_num_rows($result_check_service) > 0) {
        // Get the uploaded image files and move them to the "uploads" folder
        $image_urls = array();

        for ($i = 1; $i <= 5; $i++) {
            if ($_FILES['image_' . $i]['error'] === 0) {
                $image_tmp_name = $_FILES['image_' . $i]['tmp_name'];
                $image_name = $_FILES['image_' . $i]['name'];
                $image_url = uniqid() . '_' . $image_name; // Generate a unique name for the image
                move_uploaded_file($image_tmp_name, '../uploads/' . $image_url);
                $image_urls[] = $image_url;
            }
        }

        // Insert the image URLs into the service_images table
        $sql_insert_images = "INSERT INTO service_images (service_id, image_url1, image_url2, image_url3, image_url4, image_url5)
                            VALUES ('$service_id', '$image_urls[0]', '$image_urls[1]', '$image_urls[2]', '$image_urls[3]', '$image_urls[4]')";
        mysqli_query($conn, $sql_insert_images);

        // Redirect to the service images list page
        header('Location: detail-service.php');
        exit();
    } else {
        // Invalid service_id, redirect to an error page or display an error message
        header('Location: error-page.php');
        exit();
    }
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Service Images</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="service_id">Select Service:</label>
                            <select class="form-control" id="service_id" name="service_id" required>
                                <?php
                                // Fetch service data from the services table
                                $sql_services = "SELECT * FROM services";
                                $result_services = mysqli_query($conn, $sql_services);

                                while ($row_services = mysqli_fetch_assoc($result_services)) {
                                    echo "<option value='" . $row_services['id'] . "'>" . $row_services['title'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image_1">Image 1:</label>
                            <input type="file" class="form-control-file" id="image_1" name="image_1" required>
                        </div>
                        <div class="form-group">
                            <label for="image_2">Image 2:</label>
                            <input type="file" class="form-control-file" id="image_2" name="image_2">
                        </div>
                        <div class="form-group">
                            <label for="image_3">Image 3:</label>
                            <input type="file" class="form-control-file" id="image_3" name="image_3">
                        </div>
                        <div class="form-group">
                            <label for="image_4">Image 4:</label>
                            <input type="file" class="form-control-file" id="image_4" name="image_4">
                        </div>
                        <div class="form-group">
                            <label for="image_5">Image 5:</label>
                            <input type="file" class="form-control-file" id="image_5" name="image_5">
                        </div>

                        <button type="submit" class="btn btn-primary">Add Images</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
