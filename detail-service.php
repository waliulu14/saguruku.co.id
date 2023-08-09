<?php
include 'include/config.php';
include 'include/navbar.php';

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Retrieve service details from the 'services' table
    $sql_service_detail = "SELECT * FROM services WHERE id = $service_id";
    $result_service_detail = mysqli_query($conn, $sql_service_detail);
    $service_detail = mysqli_fetch_assoc($result_service_detail);

    // Retrieve service details from the 'service_details' table
    $sql_details = "SELECT * FROM service_details WHERE service_id = $service_id";
    $result_details = mysqli_query($conn, $sql_details);
    $service_details = mysqli_fetch_assoc($result_details);
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
    // Check if the service details were successfully retrieved
    if ($service_detail && $service_details) {
        $service_title = $service_detail['title'];
        $service_image_url = 'uploads/' . $service_detail['image_url'];
        $service_description = $service_detail['description'];

        $details_text = $service_details['details_text'];
        $additional_info = $service_details['additional_info'];
        $persyaratan = $service_details['persyaratan'];

        $document_path = $service_details['document_path'];
    } else {
        // Redirect to index.php if service details are not found
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect to index.php if 'id' is not set
    header("Location: index.php");
    exit();
}
?>

<!-- Detail Service Page Content -->
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            
        <?php
    $image_urls = getServiceImages($conn, $service_id);
    if (!empty($image_urls)) {
        echo '<div id="serviceImageCarousel" class="carousel slide" data-ride="carousel">';
        echo '<ol class="carousel-indicators">';
        for ($i = 0; $i < count($image_urls); $i++) {
            echo '<li data-target="#serviceImageCarousel" data-slide-to="' . $i . '" ' . ($i === 0 ? 'class="active"' : '') . '></li>';
        }
        echo '</ol>';
        echo '<div class="carousel-inner">';
        for ($i = 0; $i < count($image_urls); $i++) {
            echo '<div class="carousel-item ' . ($i === 0 ? 'active' : '') . '">';
            echo '<img class="img-fluid" src="uploads/' . $image_urls[$i] . '" alt="Image ' . ($i + 1) . '">';
            echo '</div>';
        }
        echo '</div>';
      
       
      
        echo '</a>';
        echo '</div>';
    } else {
        echo '<img class="img-fluid" src="' . $service_image_url . '" alt="' . $service_title . '">';
    }
    ?>
   <script src="path_to_bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
      const carousel = document.getElementById('serviceImageCarousel');
    const carouselInterval = 3000; // 3 seconds

    if (carousel) {
        const carouselInstance = new bootstrap.Carousel(carousel, {
            interval: carouselInterval
        });
    }
</script>
        </div>
        <div class="col-md-6">
            <h2><?php echo $service_title; ?></h2>
            <p><?php echo $service_description; ?></p>

            <div class="clickable-section">
                <h5 class="clickable-heading"><strong>+ Persyaratan</strong></h5>
                <div class="collapsible-content">
                    <p><?php echo nl2br($persyaratan); ?></p>
                </div>
            </div>

            <!-- Clickable "Documents" section -->
            <div class="clickable-section">
                <h5 class="clickable-heading"><strong>+ Documents</strong></h5>
                <div class="collapsible-content">
                    <?php if (!empty($document_path)) { ?>
                        <iframe src="uploads/documents/<?php echo $document_path; ?>" width="100%" height="600"></iframe>
                    <?php } else {
                        echo 'No document available for this service.';
                    } ?>
                </div>
            </div>
            <p><strong>Additional Info:</strong></p>
            <p><?php echo nl2br($additional_info); ?></p>

            <div class="text-center mt-4">
                <a href="contact.php" class="btn btn-primary py-3 px-5 animated slideInRight">Hubungi Kami untuk Memesan Paket Ini</a>
            </div>

        </div>
    </div>
</div>

<style>
    /* Your existing styles */

    /* Additional styles for the hover effect */
    .clickable-heading-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .clickable-heading {
        margin: 0;
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .clickable-heading:hover {
        background-color: #004AAD;
        /* Add your desired hover background color */
    }
</style>
<!-- Your existing content here -->


<!-- JavaScript to toggle collapsible content -->
<script>
    const clickableSections = document.querySelectorAll('.clickable-section');

    clickableSections.forEach(section => {
        const heading = section.querySelector('.clickable-heading');
        const content = section.querySelector('.collapsible-content');

        content.style.display = 'none'; // Hide content by default

        heading.addEventListener('click', () => {
            if (content.style.display === 'none') {
                content.style.display = 'block';
            } else {
                content.style.display = 'none';
            }
        });
    });
   
</script>
<!-- ... (rest of the code) ... -->


<?php include 'include/footer.php' ?>