<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the ID parameter exists in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query to fetch the image URL from the database
    $sql_select_image = "SELECT image_url FROM testimonials WHERE id = '$id'";
    $result_select_image = mysqli_query($conn, $sql_select_image);

    if ($row = mysqli_fetch_assoc($result_select_image)) {
        $image_url = $row['image_url'];

        // Delete the image file from the folder
        $image_path = '../testimonial/' . $image_url;
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Prepare and execute the SQL query to delete the testimonial based on the provided ID
        $sql_delete_testimonial = "DELETE FROM testimonials WHERE id = '$id'";
        if (mysqli_query($conn, $sql_delete_testimonial)) {
            // Testimonial and image deleted successfully, redirect to testimonial.php page
            header("Location: testimonial.php");
            exit();
        } else {
            // Error deleting testimonial, redirect back to testimonial.php page with error message
            header("Location: testimonial.php?error=delete");
            exit();
        }
    } else {
        // Testimonial not found, redirect back to testimonial.php page
        header("Location: testimonial.php?error=notfound");
        exit();
    }
} else {
    // Redirect back to testimonial.php page if ID parameter is not provided
    header("Location: testimonial.php");
    exit();
}
?>
