<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Define variables to hold form input values and error message
$id = $title = '';
$error_message = '';

// Function to sanitize and validate form inputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize form inputs
    $id = test_input($_POST['id']);
    $title = test_input($_POST['title']);

    // Check if all required fields are filled
    if (empty($title)) {
        $error_message = 'Title is required.';
    } else {
        // Check if an image file is uploaded
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $image_url = $_FILES["image"]["name"];
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                $error_message = 'File is not an image.';
                $uploadOk = 0;
            }

            // Check file size (set to unlimited in this case)
            // if ($_FILES["image"]["size"] > 500000) {
            //     $error_message = 'Sorry, your file is too large.';
            //     $uploadOk = 0;
            // }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $error_message = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error_message = 'Sorry, your file was not uploaded.';
            } else {
                // Remove the old image if it exists and upload the new image
                $sql = "SELECT image_url FROM blog_projects WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $old_image_url = $row['image_url'];
                    if ($old_image_url !== $image_url && file_exists("../uploads/$old_image_url")) {
                        unlink("../uploads/$old_image_url");
                    }

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // Update the blog project entry with the new image_url
                        $update_sql = "UPDATE blog_projects SET title = '$title', image_url = '$image_url' WHERE id = $id";
                        if (mysqli_query($conn, $update_sql)) {
                            // Data updated successfully, redirect to the blog projects page
                            header('Location: our-blog.php');
                            exit();
                        } else {
                            $error_message = 'Error updating data in the database.';
                        }
                    } else {
                        $error_message = 'Sorry, there was an error uploading your file.';
                    }
                } else {
                    // If the specified id does not exist in the database
                    $error_message = 'Invalid id.';
                }
            }
        } else {
            // If no image file is uploaded, update the blog project entry without changing the image_url
            $update_sql = "UPDATE blog_projects SET title = '$title' WHERE id = $id";
            if (mysqli_query($conn, $update_sql)) {
                // Data updated successfully, redirect to the blog projects page
                header('Location: our-blog.php');
                exit();
            } else {
                $error_message = 'Error updating data in the database.';
            }
        }
    }
} else {
    // Check if the id parameter is provided in the URL and fetch the existing data
    if (isset($_GET['id'])) {
        $id = test_input($_GET['id']);
        $sql = "SELECT id, title, image_url FROM blog_projects WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['title'];
        } else {
            // If the specified id does not exist in the database
            echo "Invalid id.";
            exit();
        }
    } else {
        // If the id parameter is not provided in the URL
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
        <h1 class="h3 mb-0 text-gray-800">Edit Blog Project</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                        <?php if (!empty($error_message)) : ?>
                            <div class="text-center mt-3">
                                <p class="text-danger"><?php echo $error_message; ?></p>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
