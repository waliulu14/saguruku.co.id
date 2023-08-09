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
        <h1 class="display-3 text-white animated slideInRight">Features</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Features</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Features Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative me-lg-4">
                    <img class="img-fluid w-100" src="img/memlih.jpeg" alt="">
                    <span class="position-absolute top-50 start-100 translate-middle bg-white rounded-circle d-none d-lg-block" style="width: 120px; height: 120px;"></span>
                    <?php if (!empty($videos_data)) : ?>
                        <?php $video_url = $videos_data[0]['youtube_url']; ?>
                        <?php $video_id = getYouTubeVideoId($video_url); ?>
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $video_id; ?>" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            // Fetch the main features data from the database
            $sql_main_features = "SELECT * FROM main_features";
            $result_main_features = mysqli_query($conn, $sql_main_features);

            while ($main_feature = mysqli_fetch_assoc($result_main_features)) {
                $main_feature_id = $main_feature['id'];

                $main_feature_title = $main_feature['title'];
                $main_feature_description = $main_feature['description'];

                // Fetch the individual features data for the current main feature
                $sql_individual_features = "SELECT * FROM individual_features WHERE main_feature_id = $main_feature_id";
                $result_individual_features = mysqli_query($conn, $sql_individual_features);

            ?>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fw-medium text-uppercase text-primary mb-2">Why Choosing Us!</p>


                    <h1 class="display-5 mb-4">
                        <?php echo $main_feature_title; ?>
                    </h1>
                    <p class="mb-4 ">
                        <?php echo $main_feature_description; ?>
                    </p>
                    <div class="row gy-4">
                        <?php
                        while ($individual_feature = mysqli_fetch_assoc($result_individual_features)) {
                            $icon_class = $individual_feature['icon'];
                            $individual_feature_title = $individual_feature['title'];
                            $individual_feature_description = $individual_feature['description'];
                        ?>
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                        <i class="<?php echo $icon_class; ?> text-white"></i>
                                    </div>
                                    <div class="ms-4">
                                        <h4>
                                            <?php echo $individual_feature_title; ?>
                                        </h4>
                                        <span>
                                            <?php echo $individual_feature_description; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Features End -->



<!-- Video Modal Start -->
<div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Video Saguruku</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->

<!-- Footer Start -->
<?php include 'include/footer.php' ?>