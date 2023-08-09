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

<!-- Carousel Start -->
<div id="header-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
        <?php foreach ($carousel_items as $key => $item): ?>
            <div class="carousel-item <?php echo $key === 0 ? 'active' : ''; ?>">
                <img class="w-100" src="<?php echo 'uploads/' . $item['image_url']; ?>" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 text-start">
                                <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">
                                    <?php echo $item['caption_title']; ?>
                                </p>
                                <h1 class="display-2 text-white mb-5 animated slideInRight">
                                    <?php echo $item['caption_subtitle']; ?>
                                </h1>
                                <!-- Update the link to navigate to the About section -->
                                <a href="#about-section" class="btn btn-primary py-3 px-5 animated slideInRight">Explore More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    

    <!-- Carousel End -->

    <!-- Carousel Control Buttons -->
    <div class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </div>
    <div class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </div>
</div>
<!-- Carousel End -->



<!-- About Start -->
<div id="about-section" class="container-xxl py-5">
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
<div class="container-fluid facts my-5 p-5">
    <div class="row g-5">
        <div class="row g-5 justify-content-center"> <!-- Menambahkan kelas justify-content-center -->
            <?php foreach ($facts_data as $fact): ?>
                <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="text-center border p-5">
                        <i class="<?php echo $fact['icon_class']; ?> fa-3x text-white mb-3"></i>
                        <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">
                            <?php echo $fact['count']; ?>
                        </h1>
                        <span class="fs-5 fw-semi-bold text-white">
                            <?php echo $fact['label']; ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>



<!-- Facts End -->


<!-- Features Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative me-lg-4">
                    <img class="img-fluid w-100" src="img/memlih.jpeg" alt="">
                    <span
                        class="position-absolute top-50 start-100 translate-middle bg-white rounded-circle d-none d-lg-block"
                        style="width: 120px; height: 120px;"></span>
                    <?php if (!empty($videos_data)): ?>
                        <?php $video_url = $videos_data[0]['youtube_url']; ?>
                        <?php $video_id = getYouTubeVideoId($video_url); ?>
                        <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/<?php echo $video_id; ?>" data-bs-target="#videoModal">
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
<div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Saguruku</h3>
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
<!-- Video Modal End -->


<!-- Service Start -->
<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Our Services</p>
            <h1 class="display-5 mb-4">We Provide The Best Workforce Services</h1>
        </div>
        <div class="row gy-5 gx-4">

            <?php
            // Fetch the services data from the database
            $sql_services = "SELECT * FROM services";
            $result_services = mysqli_query($conn, $sql_services);

            while ($service = mysqli_fetch_assoc($result_services)) {
                $service_id = $service['id'];
                $service_title = $service['title'];
                $service_image_url = 'uploads/' . $service['image_url'];
                $service_description = $service['description'];
                ?>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item">
                        <img class="img-fluid" src="<?php echo $service_image_url; ?>" alt="<?php echo $service_title; ?>">
                        <div class="service-img">
                            <img class="img-fluid" src="<?php echo $service_image_url; ?>" alt="">
                        </div>
                        <div class="service-detail">
                            <div class="service-title">
                                <hr class="w-25">
                                <h3 class="mb-0">
                                    <?php echo $service_title; ?>
                                </h3>
                                <hr class="w-25">
                            </div>
                            <div class="service-text">
                                <p class="text-white mb-0">
                                    <?php echo $service_description; ?>
                                </p>
                            </div>
                        </div>
                        <!-- Update the href attribute with the service ID -->
                        <a class="btn btn-light" href="detail-service.php?id=<?php echo $service_id; ?>">Read More</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Service End -->

<!-- Service End -->

<!-- Blog -->
<div class="container-fluid bg-dark pt-5 my-5 px-0">
    <div class="text-center mx-auto mt-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
        <p class="fw-medium text-uppercase text-primary mb-2">Our Blog</p>
        <h1 class="display-5 text-white mb-5">See What We Have Completed Recently</h1>
    </div>
    <div class="owl-carousel project-carousel wow fadeIn" data-wow-delay="0.1s">
        <?php
        // Fetch data from the blog_projects table
        $sql_blog_projects = "SELECT * FROM blog_projects";
        $result_blog_projects = mysqli_query($conn, $sql_blog_projects);

        while ($blog_project = mysqli_fetch_assoc($result_blog_projects)) {
            $title = $blog_project['title'];
            $image_url = 'uploads/' . $blog_project['image_url'];
            ?>
            <a class="project-item" href="">
                <img class="img-fluid" src="<?php echo $image_url; ?>" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0"><?php echo $title; ?></h5>
                </div>
            </a>
        <?php } ?>
    </div>
</div>
<!-- Blog -->




<!-- Testimonial Start -->

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

<!-- <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Testimonial</p>
            <h1 class="display-5 mb-5">What Our Clients Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item text-center">
                <div class="testimonial-img position-relative">
                    <img class="img-fluid rounded-circle mx-auto mb-5" src="img/testimonial-1.jpg">
                    <div class="btn-square bg-primary rounded-circle">
                        <i class="fa fa-quote-left text-white"></i>
                    </div>
                </div>
                <div class="testimonial-text text-center rounded p-4">
                    <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna
                        ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea
                        clita.</p>
                    <h5 class="mb-1">Client Name</h5>
                    <span class="fst-italic">Profession</span>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <div class="testimonial-img position-relative">
                    <img class="img-fluid rounded-circle mx-auto mb-5" src="img/testimonial-2.jpg">
                    <div class="btn-square bg-primary rounded-circle">
                        <i class="fa fa-quote-left text-white"></i>
                    </div>
                </div>
                <div class="testimonial-text text-center rounded p-4">
                    <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna
                        ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea
                        clita.</p>
                    <h5 class="mb-1">Client Name</h5>
                    <span class="fst-italic">Profession</span>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <div class="testimonial-img position-relative">
                    <img class="img-fluid rounded-circle mx-auto mb-5" src="img/testimonial-3.jpg">
                    <div class="btn-square bg-primary rounded-circle">
                        <i class="fa fa-quote-left text-white"></i>
                    </div>
                </div>
                <div class="testimonial-text text-center rounded p-4">
                    <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna
                        ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea
                        clita.</p>
                    <h5 class="mb-1">Client Name</h5>
                    <span class="fst-italic">Profession</span>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Testimonial End -->
   <!--Start of Tawk.to Script-->

   

<?php include 'include/footer.php' ?>