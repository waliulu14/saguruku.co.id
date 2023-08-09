<?php
// Include the config.php file to establish a database connection
require '../include/config.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the admin ID from the URL
    $admin_id = $_GET['id'];

    // Prepare and execute the SQL query to delete the admin from the admins table
    $sql = "DELETE FROM admins WHERE id = $admin_id";
    mysqli_query($conn, $sql);

    // Redirect back to the data admin page after successful deletion
    header("Location: tabel-admin.php");
    exit();
} else {
    // Redirect to the data admin page if the ID parameter is not set in the URL
    header("Location: tabel-admin.php");
    exit();
}
?>
