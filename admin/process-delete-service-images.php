<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the service image ID from the URL and sanitize it
    $service_image_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Construct the SQL query to fetch the image URLs before deleting the service image
    $sql_get_images = "SELECT image_url1, image_url2, image_url3, image_url4, image_url5 FROM service_images WHERE id='$service_image_id'";
    $result_get_images = mysqli_query($conn, $sql_get_images);

    // Check if the service image exists
    if (mysqli_num_rows($result_get_images) > 0) {
        // Fetch the image URLs
        $row_images = mysqli_fetch_assoc($result_get_images);
        $image_url1 = $row_images['image_url1'];
        $image_url2 = $row_images['image_url2'];
        $image_url3 = $row_images['image_url3'];
        $image_url4 = $row_images['image_url4'];
        $image_url5 = $row_images['image_url5'];

        // Delete the service image from the database
        $sql_delete_image = "DELETE FROM service_images WHERE id='$service_image_id'";
        if (mysqli_query($conn, $sql_delete_image)) {
            // If the deletion is successful, delete the image files from the server
            if (!empty($image_url1) && file_exists("../uploads/$image_url1")) {
                unlink("../uploads/$image_url1");
            }
            if (!empty($image_url2) && file_exists("../uploads/$image_url2")) {
                unlink("../uploads/$image_url2");
            }
            if (!empty($image_url3) && file_exists("../uploads/$image_url3")) {
                unlink("../uploads/$image_url3");
            }
            if (!empty($image_url4) && file_exists("../uploads/$image_url4")) {
                unlink("../uploads/$image_url4");
            }
            if (!empty($image_url5) && file_exists("../uploads/$image_url5")) {
                unlink("../uploads/$image_url5");
            }

            // Redirect back to the page that displayed the service images with a success message
            header("Location: detail-service.php?success=1");
            exit();
        } else {
            // If there's an error during deletion, redirect back to the page with an error message
            header("Location: detail-service.php?error=1");
            exit();
        }
    } else {
        $error_message = "Service image not found.";
    }
} else {
    // If no 'id' parameter is provided in the URL, redirect back to the page with an error message
    header("Location: detail-service.php?error=1");
    exit();
}
?>
