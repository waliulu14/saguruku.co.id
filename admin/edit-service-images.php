<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Initialize variables to store form data and service ID
$service_id = '';
$image_url1 = '';
$image_url2 = '';
$image_url3 = '';
$image_url4 = '';
$image_url5 = '';
$success_message = '';

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $service_image_id = mysqli_real_escape_string($conn, $_GET['id']);
    // Fetch the service image data based on the provided service image ID
    $sql_service_images = "SELECT * FROM service_images WHERE id='$service_image_id'";
    $result_service_images = mysqli_query($conn, $sql_service_images);

    // Check if the service image exists
    if (mysqli_num_rows($result_service_images) > 0) {
        // Fetch the service image details
        $service_images = mysqli_fetch_assoc($result_service_images);
        $service_id = $service_images['service_id'];
        $image_url1 = $service_images['image_url1'];
        $image_url2 = $service_images['image_url2'];
        $image_url3 = $service_images['image_url3'];
        $image_url4 = $service_images['image_url4'];
        $image_url5 = $service_images['image_url5'];
    } else {
        $error_message = "Service image not found.";
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);

    // Handle file uploads for image1, image2, image3, image4, and image5 if needed
    // Check if the file inputs are empty before updating the image URLs
    if (!empty($_FILES['image1']['name'])) {
        $image_url1 = uploadImage('image1');
    }
    if (!empty($_FILES['image2']['name'])) {
        $image_url2 = uploadImage('image2');
    }
    if (!empty($_FILES['image3']['name'])) {
        $image_url3 = uploadImage('image3');
    }
    if (!empty($_FILES['image4']['name'])) {
        $image_url4 = uploadImage('image4');
    }
    if (!empty($_FILES['image5']['name'])) {
        $image_url5 = uploadImage('image5');
    }

    // Update the service images in the database
    $sql = "UPDATE service_images SET 
            service_id='$service_id',
            image_url1=IF(LENGTH('$image_url1') > 0, '$image_url1', image_url1),
            image_url2=IF(LENGTH('$image_url2') > 0, '$image_url2', image_url2),
            image_url3=IF(LENGTH('$image_url3') > 0, '$image_url3', image_url3),
            image_url4=IF(LENGTH('$image_url4') > 0, '$image_url4', image_url4),
            image_url5=IF(LENGTH('$image_url5') > 0, '$image_url5', image_url5)
            WHERE id='$service_image_id'";

    if (mysqli_query($conn, $sql)) {
        $success_message = "Service images updated successfully.";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}

// Function to handle file uploads
function uploadImage($fileInputName)
{
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES[$fileInputName]['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allow certain image file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $allowedExtensions)) {
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            // File uploaded successfully, return the image URL
            return basename($_FILES[$fileInputName]['name']);
        } else {
            // File upload failed
            return null;
        }
    } else {
        // Invalid file type
        return null;
    }
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Service Images</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-body">
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($service_images)): ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $service_image_id); ?>"
                            method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="service_id">Service Name</label>
                                <select class="form-control" id="service_id" name="service_id" required>
                                    <option value="">Select Service</option>
                                    <?php
                                    // Fetch service data from the main services table to populate the Service ID field
                                    $sql_services = "SELECT id, title FROM services";
                                    $result_services = mysqli_query($conn, $sql_services);

                                    while ($row_services = mysqli_fetch_assoc($result_services)) {
                                        $selected = ($row_services['id'] == $service_id) ? 'selected' : '';
                                        echo "<option value='" . $row_services['id'] . "' $selected>" . $row_services['title'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image1">Image 1</label>
                                <input type="file" class="form-control" id="image1" name="image1">
                                <img src="../uploads/<?php echo $image_url1; ?>" alt="Image 1" style="width: 100px; height: 100px;">
                            </div>
                            <div class="form-group">
                                <label for="image2">Image 2</label>
                                <input type="file" class="form-control" id="image2" name="image2">
                                <img src="../uploads/<?php echo $image_url2; ?>" alt="Image 2" style="width: 100px; height: 100px;">
                            </div>
                            <div class="form-group">
                                <label for="image3">Image 3</label>
                                <input type="file" class="form-control" id="image3" name="image3">
                                <img src="../uploads/<?php echo $image_url3; ?>" alt="Image 3" style="width: 100px; height: 100px;">
                            </div>
                            <div class="form-group">
                                <label for="image4">Image 4</label>
                                <input type="file" class="form-control" id="image4" name="image4">
                                <img src="../uploads/<?php echo $image_url4; ?>" alt="Image 4" style="width: 100px; height: 100px;">
                            </div>
                            <div class="form-group">
                                <label for="image5">Image 5</label>
                                <input type="file" class="form-control" id="image5" name="image5">
                                <img src="../uploads/<?php echo $image_url5; ?>" alt="Image 5" style="width: 100px; height: 100px;">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Service Images</button>
                        </form>
                    <?php else: ?>
                        <p>Service images not found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
