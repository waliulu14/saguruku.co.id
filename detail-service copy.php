<?php
include 'include/navbar.php';
include 'include/config.php';

function getServiceDetails($conn, $service_id)
{
    $service_id = mysqli_real_escape_string($conn, $service_id);
    $sql = "SELECT * FROM service_details WHERE service_id='$service_id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function getServiceImages($conn, $service_id)
{
    $service_id = mysqli_real_escape_string($conn, $service_id);
    $sql = "SELECT * FROM service_images WHERE service_id='$service_id'";
    $result = mysqli_query($conn, $sql);
    $image_urls = array();

    if (mysqli_num_rows($result) > 0) {
        $service_images = mysqli_fetch_assoc($result);
        $image_urls = array(
            $service_images['image_url1'],
            $service_images['image_url2'],
            $service_images['image_url3'],
            $service_images['image_url4'],
            $service_images['image_url5']
        );
    }

    return $image_urls;
}

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Fetch service details and images
    $service_details = getServiceDetails($conn, $service_id);
    $image_urls = getServiceImages($conn, $service_id);
} else {
    // 'id' parameter not provided or invalid
    $service_details = false;
    $image_urls = array();
}
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white animated slideInRight">Services</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Services</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Detail Service Start -->
<div class="container py-5">
    <?php if ($service_details) : ?>
        <!-- Display service details and carousel -->
        <div class="row">
            <div class="col-lg-6">
                <div id="serviceCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php for ($i = 0; $i < count($image_urls); $i++) : ?>
                            <li data-target="#serviceCarousel" data-slide-to="<?php echo $i; ?>" <?php echo ($i === 0) ? 'class="active"' : ''; ?>></li>
                        <?php endfor; ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php for ($i = 0; $i < count($image_urls); $i++) : ?>
                            <div class="carousel-item <?php echo ($i === 0) ? 'active' : ''; ?>">
                                <img class="img-fluid" src="uploads/<?php echo $image_urls[$i]; ?>" alt="Image <?php echo ($i + 1); ?>">
                            </div>
                        <?php endfor; ?>
                    </div>
                    <a class="carousel-control-prev" href="#serviceCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#serviceCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="service-detail">
                    <div class="service-title text-center mb-4">
                        <hr class="w-25">
                        <h2 class="mb-0"><?php echo $service_details['details_text']; ?></h2>
                        <hr class="w-25">
                    </div>
                    <div class="service-text">
                        <?php
                        // Function to format paragraphs
                        function formatParagraph($text)
                        {
                            // Remove <br> tags
                            $text = str_replace("<br>", "", $text);

                            // Check if there are any numbers (e.g., "1. ", "2. ") in the text
                            if (preg_match('/\d+\./', $text)) {
                                // If there are numbers, assume it's a list and wrap in <ul> and <li> tags
                                $text = preg_replace('/\d+\.\s+/', '<li>', $text);
                                $text = "<ul><li>" . $text . "</li></ul>";
                            } else {
                                // If there are no numbers, assume it's a paragraph and wrap in <p> tags
                                $text = "<p>" . nl2br($text) . "</p>"; // Use nl2br() to convert newline (\n) to <br>
                            }

                            return $text;
                        }

                        // Format the additional_info and persyaratan
                        // Format the additional_info and persyaratan
                        $formatted_additional_info = formatParagraph($service_details['additional_info']);
                        $formatted_persyaratan = formatParagraph($service_details['persyaratan']);

                        echo $formatted_additional_info;
                        ?>

                        <button class="btn btn-link" id="showPersyaratan">+ Persyaratan</button>
                        <div id="persyaratan" style="display: none;">
                            <?php echo $formatted_persyaratan; ?>
                        </div>

                        <div class="service-documents">
                            <h3 class="mb-3">Dokumen Terkait</h3>
                            <div class="service-text">
                                <button class="btn btn-link" id="showDokumen">+ Tampilkan Dokumen</button>
                                <div id="dokumen" style="display: none;">
                                    <ul>
                                        <?php
                                        if (!empty($service_files)) {
                                            foreach ($service_files as $file) {
                                                $file_path = 'uploads/documents/' . $file['file_path']; // Assuming the file paths are correct
                                                echo '<li><a href="' . $file_path . '" target="_blank">Detail Document</a></li>';
                                            }
                                        } else {
                                            echo '<li>No documents available.</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="contact.php" class="btn btn-primary py-3 px-5 animated slideInRight">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <p class="text-center">Service details not found.</p>
        <?php endif; ?>
        </div>

        <style>
            /* File: style.css */

            /* Ukuran gambar carousel */
            .carousel-item img {
                width: 100%;
                /* Lebar gambar menjadi 100% dari container */
                height: 600px;
                /* Tinggi gambar tetap 600px, sesuaikan sesuai kebutuhan */
                object-fit: cover;
                /* Agar gambar selalu terisi tanpa distorsi */
                border-radius: 80px 0 80px 0;
            }
        </style>

        <?php include 'include/footer.php'; ?>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('#showPersyaratan').click(function() {
                $('#persyaratan').toggle();
            });

            $('#showDokumen').click(function() {
                $('#dokumen').toggle();
            });
        </script>