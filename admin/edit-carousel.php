<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    // Get the 'id' parameter from the URL
    $id = $_GET['id'];

    // Prepare and execute the SQL query to fetch the specific carousel data based on the id
    $sql = "SELECT * FROM carousel WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the carousel data
        $row = mysqli_fetch_assoc($result);
        $captionTitle = $row['caption_title'];
        $captionSubtitle = $row['caption_subtitle'];
        $imageURL = $row['image_url'];

        // Process the form submission when the user clicks the update button
        if (isset($_POST['update'])) {
            // Get the updated values from the form
            $updatedCaptionTitle = $_POST['caption_title'];
            $updatedCaptionSubtitle = $_POST['caption_subtitle'];

            // Check if a new image is uploaded
            if ($_FILES['image']['name']) {
                // Process the uploaded image
                $targetDir = "../uploads/";
                $imageName = basename($_FILES["image"]["name"]);
                $targetFilePath = $targetDir . $imageName;
                $imageFileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                // Check if the uploaded file is an image
                $allowableTypes = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array(strtolower($imageFileType), $allowableTypes)) {
                    // Move the uploaded image to the uploads directory
                    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);

                    // Update the image URL in the database
                    $imageURL = $imageName;
                } else {
                    // Display an error message if the uploaded file is not an image
                    $uploadError = "Only JPG, JPEG, PNG, and GIF files are allowed.";
                }
            }

            // Prepare and execute the SQL query to update the carousel data
            $updateSql = "UPDATE carousel SET caption_title = '$updatedCaptionTitle', caption_subtitle = '$updatedCaptionSubtitle', image_url = '$imageURL' WHERE id = '$id'";
            mysqli_query($conn, $updateSql);

            // Redirect back to the carousel data page after updating
            header("Location: carousel.php");
            exit();
        }
    } else {
        // If no carousel data is found with the given id, redirect back to the carousel data page.
        header("Location: carousel-data.php");
        exit();
    }
} else {
    // If the 'id' parameter is not present in the URL, redirect back to the carousel data page.
    header("Location: carousel-data.php");
    exit();
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Carousel Data</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <!-- Edit Form -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Carousel Data</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="caption_title">Caption Title</label>
                            <input type="text" class="form-control" name="caption_title" id="caption_title" value="<?php echo $captionTitle; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="caption_subtitle">Caption Subtitle</label>
                            <input type="text" class="form-control" name="caption_subtitle" id="caption_subtitle" value="<?php echo $captionSubtitle; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>

                        <!-- You can add other input fields for other carousel data if needed. -->

                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
