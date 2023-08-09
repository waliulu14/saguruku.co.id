<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the video ID is provided in the URL
if (isset($_GET['id'])) {
    // Get the video ID from the URL
    $video_id = $_GET['id'];

    // Fetch video data from the database using the provided video ID
    $sql = "SELECT * FROM videos WHERE id = $video_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Store the existing YouTube URL in a variable
        $existing_youtube_url = $row['youtube_url'];

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the new YouTube URL from the form
            $new_youtube_url = $_POST['youtube_url'];

            // Update the video URL in the database
            $sql_update = "UPDATE videos SET youtube_url = '$new_youtube_url' WHERE id = $video_id";
            $result_update = mysqli_query($conn, $sql_update);

            // Check if the update is successful
            if ($result_update) {
                // Redirect to the main features page after successful update
                header("Location: feature.php");
                exit;
            } else {
                // Handle the error if the update fails
                echo "Error updating video link: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Video not found.";
        exit;
    }
} else {
    echo "Video ID not provided.";
    exit;
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Video</h1>
    </div>

    <!-- Edit Video Form -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="youtube_url" class="form-label">YouTube Video URL</label>
                            <input type="text" class="form-control" id="youtube_url" name="youtube_url" value="<?php echo $existing_youtube_url; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
