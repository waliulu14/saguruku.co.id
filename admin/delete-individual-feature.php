<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Retrieve the 'id' parameter from the URL
    $individual_feature_id = $_GET['id'];

    // Prepare and execute the SQL query to delete the individual feature from the database
    $sql = "DELETE FROM individual_features WHERE id = $individual_feature_id";
    $result = mysqli_query($conn, $sql);

    // Check if the query is successful
    if ($result) {
        // Redirect to the main features page after successful deletion
        header("Location: feature.php");
        exit;
    } else {
        // Handle the error if the query fails
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect to the main features page if 'id' parameter is missing or empty
    header("Location: main-features.php");
    exit;
}
?>
