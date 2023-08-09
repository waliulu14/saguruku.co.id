<?php
include 'include/navbar.php';
include '../include/config.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the admin ID from the URL
    $admin_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch the admin data
    $sql = "SELECT * FROM admins WHERE id = $admin_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $admin_data = mysqli_fetch_assoc($result);
    } else {
        // Redirect to the data admin page if the admin ID is not found in the database
        header("Location: data-admin.php");
        exit();
    }
} else {
    // Redirect to the data admin page if the ID parameter is not set in the URL
    header("Location: data-admin.php");
    exit();
}
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Admin</h1>
    </div>

    <!-- Form edit admin -->
    <div class="row form-edit-admin">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Admin</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="process-edit-admin.php?id=<?php echo $admin_id; ?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="new_username">Username</label>
                            <input type="text" class="form-control" id="new_username" name="new_username" value="<?php echo $admin_data['username']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Leave blank to keep the current password">
                        </div>
                        <div class="form-group">
                            <label for="admin_photo">Foto Admin</label>
                            <input type="file" class="form-control-file" id="admin_photo" name="admin_photo">
                        </div>
                        <button type="submit" name="update_admin" class="btn btn-primary">Update Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!---Container Fluid-->

<!-- Footer -->
<?php include 'include/footer.php'; ?>
