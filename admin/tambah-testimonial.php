<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Define variables to store form input values
$client_name = '';
$profession = '';
$testimonial_text = '';
$image_url = '';
$error_msg = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $profession = mysqli_real_escape_string($conn, $_POST['profession']);
    $testimonial_text = mysqli_real_escape_string($conn, $_POST['testimonial_text']);

    // Validate form data
    if (empty($client_name) || empty($profession) || empty($testimonial_text)) {
        $error_msg = "Please fill in all the required fields.";
    } else {
        // Check if an image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Process the uploaded image
            $image_info = getimagesize($_FILES['image']['tmp_name']);
            if ($image_info !== false) {
                $target_dir = "../testimonial/";
                $image_name = basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $image_name;

                // Move the uploaded image to the target directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // Insert the testimonial data into the database
                    $sql = "INSERT INTO testimonials (client_name, profession, testimonial_text, image_url) 
                            VALUES ('$client_name', '$profession', '$testimonial_text', '$image_name')";
                    if (mysqli_query($conn, $sql)) {
                        // Redirect to the testimonial.php page after successful insertion
                        header("Location: testimonial.php");
                        exit();
                    } else {
                        $error_msg = "Error inserting data into the database: " . mysqli_error($conn);
                    }
                } else {
                    $error_msg = "Error uploading the image.";
                }
            } else {
                $error_msg = "Invalid image file.";
            }
        } else {
            $error_msg = "Please upload an image.";
        }
    }
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Testimonial</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="client_name">Client Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="client_name" id="client_name" value="<?php echo $client_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="profession">Profession<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="profession" id="profession" value="<?php echo $profession; ?>">
                        </div>
                        <div class="form-group">
                            <label for="testimonial_text">Testimonial Text<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="testimonial_text" id="testimonial_text" rows="4"><?php echo $testimonial_text; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload Image<span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" name="image" id="image">
                        </div>
                        <?php if ($error_msg) : ?>
                            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary">Add Testimonial</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
