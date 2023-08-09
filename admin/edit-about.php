<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Function to safely handle user input and prevent SQL injection
function cleanInput($input) {
    $cleaned = trim($input);
    $cleaned = stripslashes($cleaned);
    $cleaned = htmlspecialchars($cleaned);
    return $cleaned;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data and clean it to prevent SQL injection
    $id = cleanInput($_POST['id']);
    $heading = cleanInput($_POST['heading']);
    $description = cleanInput($_POST['description']);
    $experience_years = cleanInput($_POST['experience_years']);

    // Check if a new photo1 is uploaded
    if ($_FILES['image1_url']['name']) {
        $photo1_name = $_FILES['image1_url']['name'];
        $photo1_tmp = $_FILES['image1_url']['tmp_name'];
        $photo1_type = $_FILES['image1_url']['type'];

        // Define the upload folder path
        $upload_path = '../uploads/';

        // Create a unique file name for the uploaded photo1
        $photo1_name = uniqid() . '_' . $photo1_name;

        // Move the uploaded photo1 to the upload folder
        if (move_uploaded_file($photo1_tmp, $upload_path . $photo1_name)) {
            // Fetch the old photo1 name to delete from the folder later
            $old_photo1 = $_POST['old_photo1'];
            if (file_exists($upload_path . $old_photo1) && !empty($old_photo1)) {
                unlink($upload_path . $old_photo1);
            }
        } else {
            // Handle the file upload error
            $error_message = "Error uploading Photo 1.";
        }
    } else {
        // If no new photo1 is uploaded, use the existing one
        $photo1_name = $_POST['old_photo1'];
    }

    // Check if a new photo2 is uploaded
    if ($_FILES['image2_url']['name']) {
        $photo2_name = $_FILES['image2_url']['name'];
        $photo2_tmp = $_FILES['image2_url']['tmp_name'];
        $photo2_type = $_FILES['image2_url']['type'];

        // Define the upload folder path
        $upload_path = '../uploads/';

        // Create a unique file name for the uploaded photo2
        $photo2_name = uniqid() . '_' . $photo2_name;

        // Move the uploaded photo2 to the upload folder
        if (move_uploaded_file($photo2_tmp, $upload_path . $photo2_name)) {
            // Fetch the old photo2 name to delete from the folder later
            $old_photo2 = $_POST['old_photo2'];
            if (file_exists($upload_path . $old_photo2) && !empty($old_photo2)) {
                unlink($upload_path . $old_photo2);
            }
        } else {
            // Handle the file upload error
            $error_message = "Error uploading Photo 2.";
        }
    } else {
        // If no new photo2 is uploaded, use the existing one
        $photo2_name = $_POST['old_photo2'];
    }

    // Update the photo fields in the database
    $sql = "UPDATE about_us SET heading = '$heading', description = '$description', experience_years = '$experience_years', image1_url = '$photo1_name', image2_url = '$photo2_name' WHERE id = $id";

    // Execute the update query
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the about data page after updating
        header("Location: about.php");
        exit();
    } else {
        // Handle the database update error
        $error_message = "Error updating data in the database.";
    }
}

// Get the ID parameter from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the about us data with the given ID from the database
    $sql = "SELECT * FROM about_us WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $about_data = mysqli_fetch_assoc($result);

    // Check if the data with the given ID exists in the database
    if (!$about_data) {
        // Redirect to the about data page if no data is found
        header("Location: about-data.php");
        exit();
    }
} else {
    // Redirect to the about data page if no ID is provided
    header("Location: about-data.php");
    exit();
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit About Us Data</h1>
    </div>

    <!-- Edit Form -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-body">
                    <?php if (isset($error_message)) : ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $about_data['id']; ?>">
                        <input type="hidden" name="old_photo1" value="<?php echo $about_data['image1_url']; ?>">
                        <input type="hidden" name="old_photo2" value="<?php echo $about_data['image2_url']; ?>">
                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" class="form-control" name="heading" id="heading" value="<?php echo $about_data['heading']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4" required><?php echo $about_data['description']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="experience_years" class="form-label">Experience Years</label>
                            <input type="number" class="form-control" name="experience_years" id="experience_years" value="<?php echo $about_data['experience_years']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="image1_url" class="form-label">Photo 1</label>
                            <input type="file" class="form-control" name="image1_url" id="image1_url">
                            <p class="text-muted">Current Photo 1: <img src="../uploads/<?php echo $about_data['image1_url']; ?>" alt="Current Photo 1" style="width: 100px; height: 100px;"></p>
                        </div>
                        <div class="mb-3">
                            <label for="image2_url" class="form-label">Photo 2</label>
                            <input type="file" class="form-control" name="image2_url" id="image2_url">
                            <p class="text-muted">Current Photo 2: <img src="../uploads/<?php echo $about_data['image2_url']; ?>" alt="Current Photo 2" style="width: 100px; height: 100px;"></p>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="about.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
