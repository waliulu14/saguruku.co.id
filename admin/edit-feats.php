<?php
// Include the config.php file to establish a database connection
include '../include/config.php';

// Check if the ID parameter is present in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: feats.php"); // Redirect back to feats.php if ID is not provided
    exit();
}

// Get the ID from the URL
$feat_id = $_GET['id'];

// Initialize variables to hold form data and error messages
$icon_class = $count = $label = "";
$icon_class_err = $count_err = $label_err = "";

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the icon class field
    if (empty(trim($_POST["icon_class"]))) {
        $icon_class_err = "Please enter the icon class.";
    } else {
        $icon_class = trim($_POST["icon_class"]);
    }

    // Validate the count field
    if (empty(trim($_POST["count"]))) {
        $count_err = "Please enter the count.";
    } elseif (!is_numeric($_POST["count"])) {
        $count_err = "Count must be a number.";
    } else {
        $count = trim($_POST["count"]);
    }

    // Validate the label field
    if (empty(trim($_POST["label"]))) {
        $label_err = "Please enter the label.";
    } else {
        $label = trim($_POST["label"]);
    }

    // Check for input errors before updating the database
    if (empty($icon_class_err) && empty($count_err) && empty($label_err)) {
        // Prepare and execute the SQL query to update the facts data in the database
        $sql = "UPDATE facts SET icon_class=?, count=?, label=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $param_icon_class, $param_count, $param_label, $param_id);
            $param_icon_class = $icon_class;
            $param_count = $count;
            $param_label = $label;
            $param_id = $feat_id;

            if (mysqli_stmt_execute($stmt)) {
                header("Location: feats.php"); // Redirect back to feats.php after successful update
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Fetch existing data from the database using the ID
    $sql = "SELECT * FROM facts WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $feat_id;

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $icon_class = $row['icon_class'];
                $count = $row['count'];
                $label = $row['label'];
            } else {
                header("Location: feats.php"); // Redirect back to feats.php if ID is not found in the database
                exit();
            }
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Facts Data</h1>
    </div>

    <!-- Row -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $feat_id; ?>" method="POST">
                        <div class="mb-3">
                            <label for="icon_class" class="form-label">Icon Class</label>
                            <input type="text" class="form-control <?php echo (!empty($icon_class_err)) ? 'is-invalid' : ''; ?>" name="icon_class" id="icon_class" value="<?php echo $icon_class; ?>" required>
                            <div class="invalid-feedback"><?php echo $icon_class_err; ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="count" class="form-label">Count</label>
                            <input type="number" class="form-control <?php echo (!empty($count_err)) ? 'is-invalid' : ''; ?>" name="count" id="count" value="<?php echo $count; ?>" required>
                            <div class="invalid-feedback"><?php echo $count_err; ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="label" class="form-label">Label</label>
                            <input type="text" class="form-control <?php echo (!empty($label_err)) ? 'is-invalid' : ''; ?>" name="label" id="label" value="<?php echo $label; ?>" required>
                            <div class="invalid-feedback"><?php echo $label_err; ?></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="feats.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
