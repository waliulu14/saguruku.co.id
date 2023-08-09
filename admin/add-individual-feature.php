<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Initialize variables to store form data
$main_feature_id = 0;
$icon = '';
$title = '';
$description = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $main_feature_id = $_POST['main_feature_id'];
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Prepare and execute the SQL query to insert the new individual feature into the database
    $sql = "INSERT INTO individual_features (main_feature_id, icon, title, description) VALUES ('$main_feature_id', '$icon', '$title', '$description')";
    $result = mysqli_query($conn, $sql);

    // Check if the query is successful
    if ($result) {
        // Redirect to the main features page after successful insertion
        header("Location: feature.php");
        exit;
    } else {
        // Handle the error if the query fails
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve main features from the main_features table for the dropdown menu
$sql_main_features = "SELECT * FROM main_features";
$result_main_features = mysqli_query($conn, $sql_main_features);
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Individual Feature</h1>
    </div>



    <!-- Add Individual Feature Form -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="mb-3">
                            <label for="main_feature_id" class="form-label">Main Feature ID</label>
                            <select class="form-control" id="main_feature_id" name="main_feature_id" required>
                                <?php while ($row_main_feature = mysqli_fetch_assoc($result_main_features)): ?>
                                    <option value="<?php echo $row_main_feature['id']; ?>"><?php echo $row_main_feature['title']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <select class="form-control" id="icon" name="icon" required>
                                <option value="fa fa-check text-white">fa fa-check text-white</option>
                                <!-- Add more options for other icons if needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Individual Feature</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>