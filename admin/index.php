<?php
// Melanjutkan menampilkan konten terproteksi
include 'include/navbar.php';
include '../include/config.php';

// Function to fetch the number of items in each table
function getTableCount($table)
{
    global $conn;
    $query = "SELECT COUNT(*) AS count FROM $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

?>

<body>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <!-- Your dashboard content goes here -->

        <div class="row mb-3">
            <!-- Carousel Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Carousel</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo getTableCount('carousel'); ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-image fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Service</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo getTableCount('services'); ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tools fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Blog</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php echo getTableCount('blog_details'); ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-blog fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Testimonial</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php echo getTableCount('testimonials'); ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  
        </div>
    </div>

    <!-- Your dashboard content goes here -->

    <script src="asset/script.js"></script>
    <?php include 'include/footer.php'; ?>

    <style>
    /* Add your custom styles here */

    /* Zoom effect on hover */
    .table tbody tr:hover {
        transform: scale(1.1);
        transition: transform 0.3s;
    }
</style>