<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Define variables to hold form input values
$title = '';
$image_url = '';
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
    $title = test_input($_POST['title']);

    // Check if all required fields are filled
    if (empty($title)) {
        $error_message = 'Title is required.';
    } else {
        // Upload image file
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $image_url = $_FILES["image"]["name"];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error_message = 'File is not an image.';
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $error_message = 'Sorry, file already exists.';
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            $error_message = 'Sorry, your file is too large.';
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error_message = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error_message = 'Sorry, your file was not uploaded.';
        } else {
            // Try to upload the image
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Prepare and execute the SQL query to insert data into the blog_projects table
                $sql = "INSERT INTO blog_projects (title, image_url) VALUES ('$title', '$image_url')";
                if (mysqli_query($conn, $sql)) {
                    // Data inserted successfully, redirect to the blog projects page
                    header('Location: our-blog.php');
                    exit();
                } else {
                    $error_message = 'Error inserting data into the database.';
                }
            } else {
                $error_message = 'Sorry, there was an error uploading your file.';
            }
        }
    }
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Blog Project</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required value="<?php echo $title; ?>">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add Blog Project</button>
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
