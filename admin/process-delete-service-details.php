<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the service detail ID from the URL and sanitize it
    $service_detail_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Construct the SQL query to delete the service detail
    $sql = "DELETE FROM service_details WHERE id='$service_detail_id'";

    // Execute the SQL query for deletion
    if (mysqli_query($conn, $sql)) {
        // If the deletion is successful, redirect back to delete-service.php with a success message
        header("Location: detail-service.php?success=1");
        exit();
    } else {
        // If there's an error during deletion, redirect back to delete-service.php with an error message
        header("Location: detail-service.php?error=1");
        exit();
    }
} else {
    // If no 'id' parameter is provided in the URL, redirect back to delete-service.php with an error message
    header("Location: detail-service.php?error=1");
    exit();
}
?>
