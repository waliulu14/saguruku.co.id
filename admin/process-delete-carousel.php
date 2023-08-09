<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the ID parameter is present in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: carousel.php');
    exit();
}

$id = $_GET['id'];

// Fetch the carousel data for the given ID
$sql = "SELECT * FROM carousel WHERE id = $id";
$result = mysqli_query($conn, $sql);

// Check if the carousel record exists
if (mysqli_num_rows($result) === 0) {
    header('Location: carousel.php');
    exit();
}

// Fetch the image filename from the database
$row = mysqli_fetch_assoc($result);
$imageFilename = $row['image_filename'];

// Delete the carousel record from the database
$sql_delete = "DELETE FROM carousel WHERE id = $id";
$result_delete = mysqli_query($conn, $sql_delete);

if ($result_delete) {
    // If deletion is successful, delete the image file from the uploads folder
    $imagePath = '../uploads/' . $imageFilename;
    if (file_exists($imagePath)) {
        unlink($imagePath); // Deletes the image file
    }

    // Redirect to the carousel.php page with a success message
    header('Location: carousel.php?status=success');
} else {
    // If there was an error in deletion, redirect to the carousel.php page with an error message
    header('Location: carousel.php?status=error');
}
