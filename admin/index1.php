<?php
// Start the PHP session at the beginning of the file
session_start();

// Include the config.php file to establish a database connection
require '../include/config.php';

// Check if the user_id is set in the session
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Prepare and execute the SQL query to fetch the username from the admins table
    $sql = "SELECT username FROM admins WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
    }
} else {
    // If the user_id is not set in the session, redirect to the login page
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <!-- ... Rest of the head section ... -->
</head>
<body>
    <!-- Navbar section -->
    <nav>
        <ul>
            <li>Welcome, <?php echo $username; ?></li>
            <li><a href="logout.php">Logout</a></li> <!-- Create a logout.php file to handle logout and destroy the session -->
        </ul>
    </nav>

    <!-- Rest of the admin dashboard content -->

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
