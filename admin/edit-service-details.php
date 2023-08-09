<?php
include '../include/config.php';
include 'include/navbar.php';

if (isset($_GET['id'])) {
    $serviceDetailId = $_GET['id'];

    $sql = "SELECT * FROM service_details WHERE id = $serviceDetailId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
?>

        <div class="container-fluid" id="container-wrapper">
            <!-- ... Other code ... -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Service Details</h6>
                        </div>

                        <div class="card-body">
                            <form action="process-edit-service-details.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                <div class="form-group">
                                    <label for="details_text">Details Text</label>
                                    <textarea class="form-control" name="details_text" rows="4"><?php echo $row['details_text']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="additional_info">Additional Info</label>
                                    <textarea class="form-control" name="additional_info" rows="4"><?php echo $row['additional_info']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="persyaratan">Persyaratan</label>
                                    <textarea class="form-control" name="persyaratan" rows="4"><?php echo $row['persyaratan']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="document">Document</label>
                                    <input type="file" class="form-control-file" name="document">
                                    <small class="form-text text-muted">Leave this empty if you don't want to change the document.</small>
                                    <?php
                                    if (!empty($row['document_path'])) {
                                        echo "<p>Current Document: <a href='../uploads/documents/{$row['document_path']}' target='_blank'>{$row['document_path']}</a></p>";
                                    } else {
                                        echo "<p>No document uploaded.</p>";
                                    }
                                    ?>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    } else {
        echo "Service details not found.";
    }
} else {
    echo "Invalid request.";
}

include 'include/footer.php';
?>