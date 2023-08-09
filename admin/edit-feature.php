<?php
include '../include/config.php';
include 'include/navbar.php';

// Initialize variables
$main_feature_id = $main_feature_data = '';

// Check if the main feature ID is provided in the URL
if (isset($_GET['id'])) {
    $main_feature_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch data for the specific main feature by ID
    $sql = "SELECT * FROM main_features WHERE id = '$main_feature_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $main_feature_data = mysqli_fetch_assoc($result);
    } else {
        // Main feature with the provided ID was not found. You may handle this case accordingly.
        echo "Main feature not found.";
    }
} else {
    // Main feature ID is not provided in the URL. You may handle this case accordingly.
    echo "Invalid request.";
}
?>

<!-- Edit Form -->
<div class="container mt-4">
    <h2>Edit Main Feature</h2>
    <form action="update-feature.php" method="POST">
        <input type="hidden" name="main_feature_id" value="<?php echo $main_feature_id; ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" id="title" value="<?php echo $main_feature_data['title']; ?>">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description"><?php echo $main_feature_data['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Main Feature</button>
    </form>
</div>

<!-- Button to go back to feature.php -->
<div class="container mt-4">
    <a href="feature.php" class="btn btn-secondary">Back to Features</a>
</div>
