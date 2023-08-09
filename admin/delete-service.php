<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Check if the request method is GET and the "id" parameter is provided

    $id = $_GET['id'];

    // Prepare and execute the SQL query to fetch the image URL of the service
    $sql_select_image = "SELECT image_url FROM services WHERE id = '$id'";
    $result_select_image = mysqli_query($conn, $sql_select_image);

    if (mysqli_num_rows($result_select_image) > 0) {
        $row = mysqli_fetch_assoc($result_select_image);
        $image_url = $row['image_url'];

        // Delete the service and image from the database
        $sql_delete = "DELETE FROM services WHERE id = '$id'";
        $result_delete = mysqli_query($conn, $sql_delete);

        if ($result_delete) {
            // Delete successful, also delete the image from the "uploads" directory
            unlink('../uploads/' . $image_url);

            // Redirect back to service.php with success message
            header("Location: service.php?success=1");
            exit();
        } else {
            // Delete failed, handle the error (e.g., display an error message or log the error)
            echo "Failed to delete service. Please try again.";
        }
    } else {
        // Service with the provided ID was not found. You may handle this case accordingly.
        echo "Service not found.";
    }
} else {
    // If the "id" parameter is not provided in the URL or the request method is not GET, redirect back to service.php
    header("Location: service.php");
    exit();
}
?>
