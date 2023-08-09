<?php
include '../include/config.php';
include 'include/navbar.php';

// Check if the individual feature ID is provided in the URL
if (isset($_GET['id'])) {
    $individual_feature_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch data for the specific individual feature by ID
    $sql_individual_feature = "SELECT * FROM individual_features WHERE id = '$individual_feature_id'";
    $result_individual_feature = mysqli_query($conn, $sql_individual_feature);

    if (mysqli_num_rows($result_individual_feature) > 0) {
        $row_individual_feature = mysqli_fetch_assoc($result_individual_feature);
    } else {
        // Individual feature with the provided ID was not found. You may handle this case accordingly.
        echo "Individual feature not found.";
        exit();
    }
} else {
    // Individual feature ID is not provided in the URL. You may handle this case accordingly.
    echo "Invalid request.";
    exit();
}
?>

<!-- Edit Individual Feature Form -->
<div class="container mt-4">
    <h2>Edit Individual Feature</h2>
    <form action="update-individual-feature.php" method="POST">
        <input type="hidden" name="individual_feature_id" value="<?php echo $individual_feature_id; ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" id="title" value="<?php echo $row_individual_feature['title']; ?>">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description"><?php echo $row_individual_feature['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Individual Feature</button>
    </form>
</div>
