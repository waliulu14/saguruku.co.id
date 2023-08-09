<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Initialize variables to store form data
$title = $description = $image_url = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form was submitted via POST

    // Validate and sanitize user input (you should do proper validation here)
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Upload image
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_url = 'service_' . time() . '_' . $image_name; // Generate a unique image name
        move_uploaded_file($image_tmp, '../uploads/' . $image_url);
    } else {
        // Handle image upload error
        $error = "Failed to upload image. Please try again.";
    }

    if (!$error) {
        // Prepare and execute the SQL query to insert the new service data into the services table
        $sql_insert = "INSERT INTO services (title, description, image_url) VALUES ('$title', '$description', '$image_url')";
        $result_insert = mysqli_query($conn, $sql_insert);

        if ($result_insert) {
            // Insert successful, redirect back to service.php with success message
            header("Location: service.php?success=1");
            exit();
        } else {
            // Insert failed, handle the error (e.g., display an error message or log the error)
            $error = "Failed to add new service. Please try again.";
        }
    }
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Service</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
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
                            <input type="file" class="form-control" name="image" id="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Service</button>
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
