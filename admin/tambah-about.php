<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Initialize variables to store form data
$image1_url = '';
$image2_url = '';
$heading = '';
$description = '';
$experience_years = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $heading = $_POST['heading'];
    $description = $_POST['description'];
    $experience_years = $_POST['experience_years'];

    // File upload handling for Image 1
    if (isset($_FILES['image1'])) {
        $image1_filename = $_FILES['image1']['name'];
        $image1_tmp_path = $_FILES['image1']['tmp_name'];
        $image1_url = '../uploads/' . $image1_filename;
        move_uploaded_file($image1_tmp_path, $image1_url);
    }

    // File upload handling for Image 2
    if (isset($_FILES['image2'])) {
        $image2_filename = $_FILES['image2']['name'];
        $image2_tmp_path = $_FILES['image2']['tmp_name'];
        $image2_url = '../uploads/' . $image2_filename;
        move_uploaded_file($image2_tmp_path, $image2_url);
    }

    // Insert data into the "about_us" table
    $sql = "INSERT INTO about_us (image1_url, image2_url, heading, description, experience_years)
            VALUES ('$image1_url', '$image2_url', '$heading', '$description', '$experience_years')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the "about.php" page after successful insertion
        header("Location: about.php");
        exit();
    } else {
        // Handle error if the insertion fails
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>
<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah About Us Data</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <!-- Form to add new about us data -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah About Us Data</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="image1" class="form-label">Image 1</label>
                            <input type="file" class="form-control" name="image1" id="image1" required>
                        </div>
                        <div class="mb-3">
                            <label for="image2" class="form-label">Image 2</label>
                            <input type="file" class="form-control" name="image2" id="image2" required>
                        </div>
                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" class="form-control" name="heading" id="heading" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="experience_years" class="form-label">Experience Years</label>
                            <input type="number" class="form-control" name="experience_years" id="experience_years"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>