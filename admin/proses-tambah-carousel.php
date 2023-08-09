<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $caption_title = $_POST['caption_title'];
    $caption_subtitle = $_POST['caption_subtitle'];

    // Handle image upload
    $upload_dir = '../uploads/';
    $image_file = $_FILES['image_file']['name'];
    $tmp_name = $_FILES['image_file']['tmp_name'];
    $target_file = $upload_dir . basename($image_file);
    
    // Move the uploaded image to the uploads folder
    if (move_uploaded_file($tmp_name, $target_file)) {
        // Insert the data into the carousel table
        $sql = "INSERT INTO carousel (image_url, caption_title, caption_subtitle) VALUES ('$image_file', '$caption_title', '$caption_subtitle')";
        $result = mysqli_query($conn, $sql);

        // Check if the insertion was successful
        if ($result) {
            // Redirect to the carousel.php page with a success message
            header('Location: carousel.php?status=success');
        } else {
            // Redirect to the carousel.php page with an error message
            header('Location: carousel.php?status=error');
        }
    } else {
        // Redirect to the tambah-carousel.php page with an error message
        header('Location: tambah-carousel.php?status=upload_error');
    }
} else {
    // If the form is not submitted, redirect back to the tambah-carousel.php page
    header('Location: tambah-carousel.php');
}
?>
