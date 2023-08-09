<!-- daftar.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
</head>
<body>
    <?php
    // Include the config.php file to establish a database connection
    require 'include/config.php';

    // Initialize variables to store user input
    $username = $password = $email = $no_telp = $images = '';
    $error = '';

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input from the form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $no_telp = $_POST['no_telp'];

        // You should perform validation on the input fields to prevent SQL injection and other security issues.
        // For simplicity, we will not include the validation in this example.

        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query to insert the data into the admins table
        $sql = "INSERT INTO admins (username, password, email, no_telp, images) VALUES ('$username', '$hashed_password', '$email', '$no_telp', '$images')";

        if (mysqli_query($conn, $sql)) {
            // Registration successful, redirect to login page or home page
            header("Location: login.php");
            exit;
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
    ?>

    <h2>Admin Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="no_telp">Phone Number:</label>
        <input type="text" name="no_telp" required>
        <br>
        <input type="submit" value="Register">
    </form>

    <?php
    // Display any error messages if there was an issue with registration
    if (!empty($error)) {
        echo "<p>Error: $error</p>";
    }
    ?>
</body>
</html>
