<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View File</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    include 'include/config.php';

    if (isset($_GET['service_detail_id'])) {
        $service_detail_id = $_GET['service_detail_id'];

        // Fetch file_path based on service_detail_id
        $sql = "SELECT * FROM service_files WHERE service_detail_id = '$service_detail_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $file_info = mysqli_fetch_assoc($result);
            $file_path = $file_info['file_path'];
        } else {
            $file_path = null;
        }
    } else {
        // Redirect or handle the case where service_detail_id is not provided
        header('Location: error_page.php'); // Redirect to an error page
        exit();
    }
    ?>

    <!-- Display the file -->
    <div class="container py-5">
        <?php if ($file_path) : ?>
            <h2>File Path:</h2>
            <p><?php echo $file_path; ?></p>
            <embed src="<?php echo $file_path; ?>" type="application/pdf" width="100%" height="600px" />
            <br>
            <a href="<?php echo $file_path; ?>" download class="btn btn-primary">Download File</a>
        <?php else : ?>
            <p>File path not found.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
