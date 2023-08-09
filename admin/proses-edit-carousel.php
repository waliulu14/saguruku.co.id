<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id = $_POST['id'];
    $caption_title = $_POST['caption_title'];
    $caption_subtitle = $_POST['caption_subtitle'];

    // Handle image upload (if a new image is provided)
    if ($_FILES['image_file']['size'] > 0) {
        $upload_dir = '../uploads/';
        $image_file = $_FILES['image_file']['name'];
        $tmp_name = $_FILES['image_file']['tmp_name'];
        $target_file = $upload_dir . basename($image_file);

        // Move the uploaded image to the uploads folder
        if (move_uploaded_file($tmp_name, $target_file)) {
            // Update the data in the carousel table with the new image
            $sql = "UPDATE carousel SET image_url = '$image_file', caption_title = '$caption_title', caption_subtitle = '$caption_subtitle' WHERE id = $id";
        } else {
            // If there was an error in image upload, redirect back to the edit-carousel.php page with an error message
            header('Location: edit-carousel.php?id=' . $id . '&status=upload_error');
            exit();
        }
    } else {
        // Update the data in the carousel table without changing the image
        $sql = "UPDATE carousel SET caption_title = '$caption_title', caption_subtitle = '$caption_subtitle' WHERE id = $id";
    }

    $result = mysqli_query($conn, $sql);

    // Check if the update was successful
    if ($result) {
        // Redirect to the carousel.php page with a success message
        header('Location: carousel.php?status=success');
    } else {
        // Redirect to the edit-carousel.php page with an error message
        header('Location: edit-carousel.php?id=' . $id . '&status=error');
    }
} else {
    // If the form is not submitted, redirect back to the edit-carousel.php page
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        header('Location: edit-carousel.php?id=' . $id);
    } else {
        header('Location: carousel.php');
    }
}
?>
