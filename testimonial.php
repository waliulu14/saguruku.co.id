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
            <h1 class="display-3 text-white animated slideInRight">Testimonial</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb animated slideInRight mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Testimonial</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Testimonial</p>
            <h1 class="display-5 mb-5">What Our Clients Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s" data-nav="true" data-dots="false">
            <?php
            // Fetch testimonials data from the database
            $sql_testimonials = "SELECT * FROM testimonials";
            $result_testimonials = mysqli_query($conn, $sql_testimonials);

            while ($testimonial = mysqli_fetch_assoc($result_testimonials)) {
                $client_name = $testimonial['client_name'];
                $profession = $testimonial['profession'];
                $testimonial_text = $testimonial['testimonial_text'];
                $image_url = 'testimonial/' . $testimonial['image_url'];
            ?>
            <div class="testimonial-item text-center">
                <div class="testimonial-img position-relative">
                    <img class="img-fluid rounded-circle mx-auto mb-5" src="<?php echo $image_url; ?>" alt="Client Image">
                    <div class="btn-square bg-primary rounded-circle">
                        <i class="fa fa-quote-left text-white"></i>
                    </div>
                </div>
                <div class="testimonial-text text-center rounded p-4">
                    <p><?php echo $testimonial_text; ?></p>
                    <h5 class="mb-1"><?php echo $client_name; ?></h5>
                    <span class="fst-italic"><?php echo $profession; ?></span>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Testimonial End -->

    <!-- Footer Start -->
    <?php include 'include/footer.php'?>
