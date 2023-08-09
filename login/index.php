<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="../img/saguruku.jpg">
	
</head>



<body class="img js-fullheight" style="background-image: url(images/bg3.jpeg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">SAGURUKU</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center">Login Admin</h3>
						<?php
						// Start a PHP session at the beginning of the file
						session_start();

						// Include the config.php file to establish a database connection
						require '../include/config.php';

						// Initialize variables to store user input
						$username = $password = '';
						$error = '';

						// Check if the form was submitted
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							// Get user input from the form
							$username = $_POST['username'];
							$password = $_POST['password'];

							// Prepare and execute the SQL query to fetch the admin details from the database
							$sql = "SELECT id, username, password FROM admins WHERE username = '$username'";
							$result = mysqli_query($conn, $sql);

							if (mysqli_num_rows($result) > 0) {
								$row = mysqli_fetch_assoc($result);
								// Verify the hashed password with the entered password
								if (password_verify($password, $row['password'])) {
									// Store the user_id in a session variable
									$_SESSION['user_id'] = $row['id'];

									// Successful login, redirect to admin dashboard or home page
									header("Location: ../admin/index.php ");
									exit;
								} else {
									$error = "Invalid username or password.";
								}
							} else {
								$error = "Invalid username or password.";
							}
						}
						?>

						<form method="post" class="signin-form">
							<div class="form-group">
								<input type="text" class="form-control" name="username" placeholder="Username" required>
							</div>
							<div class="form-group">
								<input id="password-field" type="password" class="form-control" name="password"
									placeholder="Password" required>
								<span toggle="#password-field"
									class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">Remember Me
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#" style="color: #fff">Forgot Password</a>
								</div>
							</div>
						</form>
						<?php
						// Display any error messages if there was an issue with login
						if (!empty($error)) {
							echo "<p class='text-danger'>$error</p>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>