<?php
include 'include/config.php';
include 'include/navbar.php';

$query = "SELECT * FROM carousel";
$result = mysqli_query($conn, $query);
$carousel_items = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Fetch the "About Us" data from the database
$sql = "SELECT * FROM about_us";
$result = mysqli_query($conn, $sql);
$about_data = mysqli_fetch_assoc($result);
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
                                <h1 class="display-1 text-white mb-5 animated slideInRight">
                                    <?php echo $item['caption_subtitle']; ?>
                                </h1>
                                <!-- Add a link if needed -->
                                <a href="<?php // echo $item['link']; ?>" class="btn btn-primary py-3 px-5 animated slideInRight">Explore More</a>
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
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="row gx-3 h-100">
                    <div class="col-6 align-self-start wow fadeInUp" data-wow-delay="0.1s">
                        <img class="img-fluid" src="img/about1.jpeg">
                    </div>
                    <div class="col-6 align-self-end wow fadeInDown" data-wow-delay="0.1s">
                        <img class="img-fluid" src="img/about2.jpeg">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="fw-medium text-uppercase text-primary mb-2">About Us</p>
                <h1 class="display-5 mb-4">Leading the Way in Foreign Workforce Solutions</h1>
                <p class="mb-4">Kami adalah perusahaan yang berfokus pada solusi ketenagakerjaan asing. Di SAGURUKU,
                    kami memahami betapa pentingnya mendapatkan talenta internasional yang berkualitas untuk
                    mengembangkan bisnis Anda. Dengan pengalaman bertahun-tahun dalam mengurus proses ketenagakerjaan
                    asing, kami bangga menjadi pemimpin dalam industri ini.
                </p>
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0 bg-primary p-4">
                        <h1 class="display-2">25</h1>
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
                                <h5 class="mb-0">info@example.com</h5>
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
                                <h5 class="mb-0">+012 345 6789</h5>
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
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.3s">
                <div class="text-center border p-5">
                    <i class="fa fa-check-double fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">135</h1>
                    <span class="fs-5 fw-semi-bold text-white">Projects Done</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.5s">
                <div class="text-center border p-5">
                    <i class="fa fa-users fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">957</h1>
                    <span class="fs-5 fw-semi-bold text-white">Happy Clients</span>
                </div>
            </div>
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
                    <button type="button" class="btn-play" data-bs-toggle="modal"
                        data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <p class="fw-medium text-uppercase text-primary mb-2">Why Choosing Us!</p>
                <h1 class="display-5 mb-4">Few Reasons Why People Choosing Us!</h1>
                <p class="mb-4">Kami adalah mitra yang berpengalaman dalam menyediakan solusi ketenagakerjaan asing.
                    Dengan pengetahuan mendalam tentang hukum dan regulasi internasional, kami menghadirkan layanan yang
                    terpercaya untuk memenuhi kebutuhan ketenagakerjaan perusahaan Anda.
                </p>
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-check text-white"></i>
                            </div>
                            <div class="ms-4">
                                <h4>Proses Cepat dan Efisien</h4>
                                <span>Kami menyediakan paket New ITA dengan proses cepat dan efisien untuk mendukung
                                    kebutuhan perusahaan Anda dalam merekrut karyawan internasional.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-check text-white"></i>
                            </div>
                            <div class="ms-4">
                                <h4>Solusi Terpadu</h4>
                                <span>Paket Rekawak ITAS kami mencakup berbagai layanan yang terintegrasi, termasuk
                                    perpanjangan izin tinggal dan administrasi yang diperlukan.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-check text-white"></i>
                            </div>
                            <div class="ms-4">
                                <h4>Kemudahan Pengajuan</h4>
                                <span>Layanan VKUBP kami memudahkan pengajuan visa kunjungan ulang untuk keperluan
                                    bisnis pendek</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Our Services</p>
            <h1 class="display-5 mb-4">We Provide The Best Workforce Services</h1>
        </div>
        <div class="row gy-5 gx-4">
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item">
                    <img class="img-fluid" src="img/itas2.jpeg" alt="">
                    <div class="service-img">
                        <img class="img-fluid" src="img/itas3.jpeg" alt="">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Paket New Itas</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Kami menyediakan paket New ITA dengan proses cepat dan efisien
                                untuk mendukung kebutuhan perusahaan Anda dalam merekrut karyawan internasional.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="detail-service.php">Read More</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item">
                    <img class="img-fluid" src="img/itas2.jpeg" alt="">
                    <div class="service-img">
                        <img class="img-fluid" src="img/itas3.jpeg" alt="">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Paket Renewal Itas</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos
                                lorem sed diam stet diam sed stet.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="detail-service.php">Read More</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item">
                    <img class="img-fluid" src="img/itas2.jpeg" alt="">
                    <div class="service-img">
                        <img class="img-fluid" src="img/itas3.jpeg" alt="">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Epo</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos
                                lorem sed diam stet diam sed stet.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="detail-service.php">Read More</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item">
                    <img class="img-fluid" src="img/itas2.jpeg" alt="">
                    <div class="service-img">
                        <img class="img-fluid" src="img/itas3.jpeg" alt="">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Mutasi Pasport</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos
                                lorem sed diam stet diam sed stet.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="detail-service.php">Read More</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item">
                    <img class="img-fluid" src="img/itas2.jpeg" alt="">
                    <div class="service-img">
                        <img class="img-fluid" src="img/itas3.jpeg" alt="">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Ali Status</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos
                                lorem sed diam stet diam sed stet.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="detail-service.php">Read More</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item">
                    <img class="img-fluid" src="img/itas2.jpeg" alt="">
                    <div class="service-img">
                        <img class="img-fluid" src="img/itas3.jpeg" alt="">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Visit Visa, Renawal, VKUBP</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos
                                lorem sed diam stet diam sed stet.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="detail-service.php">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- Project Start -->
<div class="container-fluid bg-dark pt-5 my-5 px-0">
    <div class="text-center mx-auto mt-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
        <p class="fw-medium text-uppercase text-primary mb-2">Our Blog</p>
        <h1 class="display-5 text-white mb-5">See What We Have Completed Recently</h1>
    </div>
    <div class="owl-carousel project-carousel wow fadeIn" data-wow-delay="0.1s">
        <a class="project-item" href="">
            <img class="img-fluid" src="img/project-1.jpg" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Auto Engineering</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="img/project-2.jpg" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Civil Engineering</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="img/project-3.jpg" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Gas Engineering</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="img/project-4.jpg" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Power Engineering</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="img/project-5.jpg" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Energy Engineering</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="img/project-6.jpg" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Water Engineering</h5>
            </div>
        </a>
    </div>
</div>
<!-- Project End -->



<!-- Testimonial Start -->
<div class="container-xxl py-5">
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
</div>
<!-- Testimonial End -->

<?php include 'include/footer.php' ?>