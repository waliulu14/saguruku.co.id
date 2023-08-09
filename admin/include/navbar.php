<?php
// Start the PHP session at the beginning of the file
session_start();

// Include the config.php file to establish a database connection
require '../include/config.php';

// Check if the user_id is set in the session
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Prepare and execute the SQL query to fetch the username and profile image from the admins table
    $sql = "SELECT username, images FROM admins WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $user_image = $row['images']; // Store the profile image URL in $user_image
    }
} else {
    // If the user_id is not set in the session, redirect to the login page
    header("Location: ../login/index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="asset/img/saguruku.jpg" rel="icon">
    <title>Admin Saguruku</title>
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="asset/css/ruang-admin.min.css" rel="stylesheet">
    <link href="asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .notification-box {
            display: none;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="asset/img/saguruku.jpg" width="60" height="55">
                </div>
                <div class="sidebar-brand-text mx-3">Saguruku</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>DATA TABEL</span>
                </a>
                <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tabel</h6>
                        <a class="collapse-item" href="tabel-admin.php">Tabel Admin</a>
                        <a class="collapse-item" href="testimonial.php">Testimonial</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
            <!-- <li class="nav-item">
                <a class="nav-link" href="blog.php">
                    <i class="bg-white py-2 collapse-inner rounded"></i>
                    <span>Blog</span>
                </a>
            </li> -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaturan" aria-expanded="true" aria-controls="collapsePengaturan">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan Website</span>
                </a>
                <div id="collapsePengaturan" class="collapse" aria-labelledby="headingPengaturan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pengaturan Website</h6>
                        <a class="collapse-item" href="carousel.php">Carousel</a>
                        <a class="collapse-item" href="about.php">ABOUT US</a>
                        <a class="collapse-item" href="feats.php">Feats</a>
                        <a class="collapse-item" href="feature.php">Feature</a>
                        <a class="collapse-item" href="service.php">Service</a>
                        <a class="collapse-item" href="detail-service.php">Detail Service</a>
                        <a class="collapse-item" href="our-blog.php">Our Blog</a>
                        <a class="collapse-item" href="testimonial.php">TESTIMONIAL</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">

        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- Display the user's profile image -->
                                <img class="img-profile rounded-circle" src="uploads/<?php echo $user_image; ?>" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-black small">
                                    <?php echo $username; ?>
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>