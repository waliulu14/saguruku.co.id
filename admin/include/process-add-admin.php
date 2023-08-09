<?php
// Include the config.php file to establish a database connection
require '../../include/config.php';

// Check if the form is submitted
if (isset($_POST['new_username']) && isset($_POST['new_password']) && isset($_POST['new_email']) && isset($_POST['new_no_telp'])) {
    // Retrieve the new admin details from the form
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $new_email = $_POST['new_email'];
    $new_no_telp = $_POST['new_no_telp'];
    $admin_photo = $_FILES['admin_photo']['name'];

    // Encrypt the password before storing it in the database
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Prepare and execute the SQL query to insert the new admin data into the admins table
    $sql = "INSERT INTO admins (username, password, email, no_telp, images) VALUES ('$new_username', '$hashed_password', '$new_email', '$new_no_telp', '$admin_photo')";
    mysqli_query($conn, $sql);

    // Handle the admin photo upload
    if (!empty($admin_photo)) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($admin_photo);
        move_uploaded_file($_FILES["admin_photo"]["tmp_name"], $target_file);
    }

    // Redirect back to the data admin page after successful addition
    header("Location: ../tabel-admin.php");
    exit();
}
?>
