<?php
include '../include/config.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the admin ID from the URL
    $admin_id = $_GET['id'];

    // Check if the form is submitted
    if (isset($_POST['update_admin'])) {
        // Retrieve the updated admin details from the form
        $new_username = $_POST['new_username'];
        $new_password = $_POST['new_password'];
        $admin_photo = $_FILES['admin_photo']['name'];

        // Encrypt the password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the admin details in the database
        $sql = "UPDATE admins SET username = '$new_username'";
        
        // Check if a new password is provided
        if (!empty($new_password)) {
            $sql .= ", password = '$hashed_password'";
        }
        
        $sql .= " WHERE id = $admin_id";
        mysqli_query($conn, $sql);

        // Handle the admin photo upload if a new photo is selected
        if (!empty($admin_photo)) {
            // Remove the old photo file from the "uploads" folder
            $sql = "SELECT images FROM admins WHERE id = $admin_id";
            $result = mysqli_query($conn, $sql);
            $admin_data = mysqli_fetch_assoc($result);
            $old_photo = $admin_data['images'];

            if (file_exists("uploads/$old_photo")) {
                unlink("uploads/$old_photo");
            }

            // Upload the new photo file to the "uploads" folder
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($admin_photo);
            move_uploaded_file($_FILES["admin_photo"]["tmp_name"], $target_file);

            // Update the admin photo filename in the database
            $sql = "UPDATE admins SET images = '$admin_photo' WHERE id = $admin_id";
            mysqli_query($conn, $sql);
        }

        // Redirect to the data admin page after the update is completed
        header("Location: tabel-admin.php");
        exit();
    }
} else {
    // Redirect to the data admin page if the ID parameter is not set in the URL
    header("Location: tabel-admin.php");
    exit();
}
?>
