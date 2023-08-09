<?php
include '../include/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form was submitted via POST

    // Validate and sanitize user input (you should do proper validation and sanitation here)
    $main_feature_id = $_POST['main_feature_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Prepare and execute the SQL query to update the main feature data
    $sql_update = "UPDATE main_features SET title = '$title', description = '$description' WHERE id = '$main_feature_id'";
    $result_update = mysqli_query($conn, $sql_update);

    if ($result_update) {
        // Update successful, redirect back to feature.php or display a success message
        header('Location: feature.php');
        exit();
    } else {
        // Update failed, handle the error (e.g., display an error message or log the error)
        echo "Failed to update main feature. Please try again.";
    }
} else {
    // If the form was not submitted via POST, redirect back to feature.php
    header('Location: feature.php');
    exit();
}
?>
