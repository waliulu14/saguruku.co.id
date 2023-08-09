<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the image_url of the blog detail entry
    $sql = "SELECT image_url FROM blog_details WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $image_url = $row['image_url'];

        // Delete the blog detail entry from the database
        $delete_sql = "DELETE FROM blog_details WHERE id = $id";
        if (mysqli_query($conn, $delete_sql)) {
            // Delete the corresponding image from the ../uploads directory
            $image_path = "../blog/" . $image_url;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            // Redirect back to the blog details page
            header('Location: our-blog.php');
            exit();
        } else {
            // If there's an error deleting the entry from the database
            echo "Error deleting entry: " . mysqli_error($conn);
        }
    } else {
        // If the specified id does not exist in the database
        echo "Invalid id.";
    }
} else {
    // If the id parameter is not provided in the URL or the request method is not GET
    echo "Invalid request.";
}
?>
