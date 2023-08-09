<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Define variables to hold form input values
$title = $content = $blog_link = '';
$error_message = '';

// Function to sanitize and validate form inputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize form inputs
    $title = test_input($_POST['title']);
    $content = test_input($_POST['content']);
    $blog_link = test_input($_POST['blog_link']);

    // Check if all required fields are filled
    if (empty($title) || empty($content) || empty($blog_link)) {
        $error_message = 'All fields are required.';
    } else {
        // Prepare and execute the SQL query to insert data into the blog_details table
        $sql = "INSERT INTO blog_details (title, image_url, content, blog_link) VALUES ('$title', '$image_url', '$content', '$blog_link')";
        if (mysqli_query($conn, $sql)) {
            // Data inserted successfully, redirect to the blog details page
            header('Location: blog-details.php');
            exit();
        } else {
            $error_message = 'Error inserting data into the database.';
        }
    }
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Blog Detail</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <?php if (!empty($image_url)) : ?>
                        <p>Image uploaded successfully!</p>
                        <!-- Display the uploaded image -->
                        <img src="../uploads/<?php echo $image_url; ?>" alt="Uploaded Image" style="width: 100px; height: 100px;">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <!-- Hidden input to pass the uploaded image URL to the next form submission -->
                            <input type="hidden" name="image_url" value="<?php echo $image_url; ?>">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <?php
                                // Prepare and execute the SQL query to fetch the data from the blog_projects table
                                $sql = "SELECT id, title FROM blog_projects";
                                $result = mysqli_query($conn, $sql);
                                ?>
                                <select class="form-control" id="title" name="title" required>
                                    <option value="">Select Title</option>
                                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <option value="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="blog_link">Blog Link</label>
                                <input type="text" class="form-control" id="blog_link" name="blog_link" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Add Blog Detail</button>
                            </div>
                            <?php if (!empty($error_message)) : ?>
                                <div class="text-center mt-3">
                                    <p class="text-danger"><?php echo $error_message; ?></p>
                                </div>
                            <?php endif; ?>
                        </form>
                    <?php else : ?>
                        <!-- Image upload form -->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Upload Image</button>
                            </div>
                            <?php if (!empty($error_message)) : ?>
                                <div class="text-center mt-3">
                                    <p class="text-danger"><?php echo $error_message; ?></p>
                                </div>
                            <?php endif; ?>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
