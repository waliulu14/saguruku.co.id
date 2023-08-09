<?php
include '../include/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form was submitted via POST

    // Validate and sanitize user input (you should do proper validation here)
    $individual_feature_id = $_POST['individual_feature_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Prepare and execute the SQL query to update the individual feature data
    $sql_update = "UPDATE individual_features SET title = '$title', description = '$description' WHERE id = '$individual_feature_id'";
    $result_update = mysqli_query($conn, $sql_update);

    if ($result_update) {
        // Update successful, redirect back to feature.php with success message
        header("Location: feature.php?success=1");
        exit();
    } else {
        // Update failed, handle the error (e.g., display an error message or log the error)
        echo "Failed to update individual feature. Please try again.";
    }
} else {
    // If the form was not submitted via POST, redirect back to feature.php with an error message
    header("Location: feature.php?error=1");
    exit();
}
?>
