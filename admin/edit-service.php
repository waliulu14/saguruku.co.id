<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Initialize variables to store form data
$title = $description = $image_url = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form was submitted via POST

    // Validate and sanitize user input (you should do proper validation here)
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Check if a new image is uploaded
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_url = 'service_' . time() . '_' . $image_name; // Generate a unique image name
        move_uploaded_file($image_tmp, '../uploads/' . $image_url);
    } else {
        // Keep the existing image if no new image is uploaded
        $image_url = $_POST['existing_image'];
    }

    if (!$error) {
        // Prepare and execute the SQL query to update the service data in the services table
        $sql_update = "UPDATE services SET title = '$title', description = '$description', image_url = '$image_url' WHERE id = '$id'";
        $result_update = mysqli_query($conn, $sql_update);

        if ($result_update) {
            // Update successful, redirect back to service.php with success message
            header("Location: service.php?success=1");
            exit();
        } else {
            // Update failed, handle the error (e.g., display an error message or log the error)
            $error = "Failed to update service. Please try again.";
        }
    }
} else {
    // Check if the service ID is provided in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare and execute the SQL query to fetch data for the specific service by ID
        $sql = "SELECT * FROM services WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['title'];
            $description = $row['description'];
            $image_url = $row['image_url'];
        } else {
            // Service with the provided ID was not found. You may handle this case accordingly.
            echo "Service not found.";
            exit();
        }
    } else {
        // Service ID is not provided in the URL. You may handle this case accordingly.
        echo "Invalid request.";
        exit();
    }
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Service</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="existing_image" value="<?php echo $image_url; ?>">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description" required><?php echo $description; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Service</button>
                    </form>
                    <?php if ($error) : ?>
                        <div class="mt-3 alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
