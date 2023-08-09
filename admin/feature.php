<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Main Features</h1>
    </div>

    <!-- Row -->
    <!-- Row -->
    <div class="row justify-content-center">
        <a href="add-individual-feature.php" class="btn btn-success">Add New Individual Feature</a>
    </div>

    <!-- Main Features -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <br>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Prepare and execute the SQL query to fetch data from the main_features table
                    $sql = "SELECT * FROM main_features";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['title']; ?>
                                </td>
                                <td>
                                    <?php echo $row['description']; ?>
                                </td>
                                <td>
                                    <a href="edit-feature.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit
                                        Main Feature</a>
                                   
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3">No data available.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Row for Add New Individual Feature Button -->


    <h1 class="h3 mb-0 text-center text-gray-800">Features</h1>



    <!-- Row for Individual Features -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Prepare and execute the SQL query to fetch data from the individual_features table
                    $sql_individual = "SELECT * FROM individual_features";
                    $result_individual = mysqli_query($conn, $sql_individual);

                    if (mysqli_num_rows($result_individual) > 0) {
                        while ($row_individual = mysqli_fetch_assoc($result_individual)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row_individual['title']; ?>
                                </td>
                                <td>
                                    <?php echo $row_individual['description']; ?>
                                </td>
                                <td>
                                    <a href="edit-individual-feature.php?id=<?php echo $row_individual['id']; ?>"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="delete-individual-feature.php?id=<?php echo $row_individual['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this individual feature?')">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3">No individual features available.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Row for Videos -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12">
            <h1 class="h3 mb-0 text-gray-800">Videos</h1>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <?php
                // Prepare and execute the SQL query to fetch video data from the videos table
                $sql_videos = "SELECT * FROM videos";
                $result_videos = mysqli_query($conn, $sql_videos);

                if (mysqli_num_rows($result_videos) > 0) {
                    while ($row_video = mysqli_fetch_assoc($result_videos)) {
                        // Get the YouTube video URL from the database
                        $youtube_url = $row_video['youtube_url'];

                        // Extract the YouTube video ID from the URL
                        $video_id = getYouTubeVideoId($youtube_url);
                        ?>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="custom-embed-responsive">
                                    <iframe class="embed-responsive-item"
                                        src="https://www.youtube.com/embed/<?php echo $video_id; ?>" allowfullscreen></iframe>
                                </div>
                                <div class="card-body">
                                    <a href="edit-video.php?id=<?php echo $row_video['id']; ?>"
                                        class="btn btn-primary btn-sm">Edit Video</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-lg-12"><p>No videos available.</p></div>';
                }
                ?>

                <?php
                // Function to extract the YouTube video ID from the URL
                function getYouTubeVideoId($url)
                {
                    $parts = parse_url($url);
                    parse_str($parts['query'], $query);
                    return $query['v'];
                }
                ?>
            </div>
        </div>
    </div>

</div>
</div>


<!-- Include footer -->
<?php include 'include/footer.php'; ?>

<!-- Add your scripts and other body elements here -->
</body>