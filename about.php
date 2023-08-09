<?php
include 'include/config.php';
include 'include/navbar.php';

// Function to extract the YouTube video ID from the URL
function getYouTubeVideoId($url)
{
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    return $query['v'];
}

$query = "SELECT * FROM carousel";
$result = mysqli_query($conn, $query);
$carousel_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch the "About Us" data from the database
$sql_about = "SELECT * FROM about_us";
$result_about = mysqli_query($conn, $sql_about);
$about_data = mysqli_fetch_assoc($result_about);

// Fetch the "Facts" data from the database
$sql_facts = "SELECT * FROM facts";
$result_facts = mysqli_query($conn, $sql_facts);
$facts_data = mysqli_fetch_all($result_facts, MYSQLI_ASSOC);

// Fetch the video URL from the "videos" table
$sql_videos = "SELECT * FROM videos";
$result_videos = mysqli_query($conn, $sql_videos);
$videos_data = mysqli_fetch_all($result_videos, MYSQLI_ASSOC);
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white animated slideInRight">About Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="row gx-3 h-100">
                    <div class="col-6 align-self-start wow fadeInUp" data-wow-delay="0.1s">
                        <img class="img-fluid" src="uploads/<?php echo $about_data['image1_url']; ?>" alt="Image 1">
                    </div>
                    <div class="col-6 align-self-end wow fadeInDown" data-wow-delay="0.1s">
                        <img class="img-fluid" src="uploads/<?php echo $about_data['image2_url']; ?>" alt="Image 2">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="fw-medium text-uppercase text-primary mb-2">About Us</p>
                <h1 class="display-5 mb-4">
                    <?php echo $about_data['heading']; ?>
                </h1>
                <p class="mb-4">
                    <?php echo $about_data['description']; ?>
                </p>
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0 bg-primary p-4">
                        <h1 class="display-2">
                            <?php echo $about_data['experience_years']; ?>
                        </h1>
                        <h5 class="text-white">Years of</h5>
                        <h5 class="text-white">Experience</h5>
                    </div>
                    <div class="ms-4">
                        <p><i class="fa fa-check text-primary me-2"></i>Pencarian dan Seleksi Tenaga Kerja Internasional
                        </p>
                        <p><i class="fa fa-check text-primary me-2"></i>Pemahaman Hukum&Regulasi Ketenagakerjaan Asing
                        </p>
                        <p><i class="fa fa-check text-primary me-2"></i>Pengurusan Administrasi Ketenagakerjaan</p>
                        <p><i class="fa fa-check text-primary me-2"></i>Konsultasi dan Dukungan</p>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-envelope-open text-white"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-2">Email us</p>
                                <h6 class="mb-0">saguruku.sap@gmail.com</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-phone-alt text-white"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-2">Call us</p>
                                <h6 class="mb-0">+6281292289232</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Facts Start -->
<div class="container-fluid facts my-5 p-3"> <!-- Reduce the padding -->
    <div class="row g-3 justify-content-center"> <!-- Adjust the gap between columns -->
        <?php foreach ($facts_data as $fact): ?>
            <div class="col-md-6 col-lg-4 col-xl-2 wow fadeIn" data-wow-delay="0.3s"> <!-- Reduce the width for smaller boxes -->
                <div class="text-center border p-3"> <!-- Reduce the padding -->
                    <i class="<?php echo $fact['icon_class']; ?> fa-2x text-white mb-3"></i> <!-- Reduce the icon size -->
                    <h1 class="display-4 text-primary mb-0" data-toggle="counter-up"> <!-- Reduce the font size -->
                        <?php echo $fact['count']; ?>
                    </h1>
                    <span class="fs-6 fw-semi-bold text-white"> <!-- Reduce the font size -->
                        <?php echo $fact['label']; ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Facts End -->





<!-- Team Start -->
<!-- <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Our Team</p>
            <h1 class="display-5 mb-5">Dedicated Team Members</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item">
                    <img class="img-fluid" src="img/team-1.jpg" alt="">
                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-square bg-primary" style="width: 90px; height: 90px;">
                            <i class="fa fa-2x fa-share text-white"></i>
                        </div>
                        <div class="position-relative overflow-hidden bg-light d-flex flex-column justify-content-center w-100 ps-4"
                            style="height: 90px;">
                            <h5>Rob Miller</h5>
                            <span class="text-primary">CEO & Founder</span>
                            <div class="team-social">
                                <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <img class="img-fluid" src="img/team-2.jpg" alt="">
                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-square bg-primary" style="width: 90px; height: 90px;">
                            <i class="fa fa-2x fa-share text-white"></i>
                        </div>
                        <div class="position-relative overflow-hidden bg-light d-flex flex-column justify-content-center w-100 ps-4"
                            style="height: 90px;">
                            <h5>Adam Crew</h5>
                            <span class="text-primary">Project Manager</span>
                            <div class="team-social">
                                <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item">
                    <img class="img-fluid" src="img/team-3.jpg" alt="">
                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-square bg-primary" style="width: 90px; height: 90px;">
                            <i class="fa fa-2x fa-share text-white"></i>
                        </div>
                        <div class="position-relative overflow-hidden bg-light d-flex flex-column justify-content-center w-100 ps-4"
                            style="height: 90px;">
                            <h5>Peter Farel</h5>
                            <span class="text-primary">Engineer</span>
                            <div class="team-social">
                                <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Team End -->


<!-- Video Modal Start -->
<div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                        allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->


<!-- Footer Start -->
<?php include 'include/footer.php' ?>