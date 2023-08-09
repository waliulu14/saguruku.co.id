<?php
include '../include/config.php';

// Mengambil data layanan dari tabel services
$query_services = "SELECT id, title FROM services";
$result_services = mysqli_query($conn, $query_services);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serviceId = $_POST['service_id'];
    $detailsText = $_POST['details_text'];
    $additionalInfo = $_POST['additional_info'];
    $persyaratan = $_POST['persyaratan'];
    
    // Proses unggah dokumen
    $targetDir = "../uploads/documents/";
    $documentFile = basename($_FILES["document"]["name"]);
    $targetFilePath = $targetDir . $documentFile;
    move_uploaded_file($_FILES["document"]["tmp_name"], $targetFilePath);
    
    // Simpan data ke basis data
    $sql = "INSERT INTO service_details (service_id, details_text, additional_info, persyaratan)
            VALUES ('$serviceId', '$detailsText', '$additionalInfo', '$persyaratan')";
    if (mysqli_query($conn, $sql)) {
        $serviceDetailId = mysqli_insert_id($conn); // Mendapatkan ID detail layanan yang baru saja ditambahkan
        $sql_file = "INSERT INTO service_files (service_detail_id, file_path)
                     VALUES ('$serviceDetailId', '$documentFile')";
        mysqli_query($conn, $sql_file);
        
        header("Location: service-details.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Include header
include 'include/navbar.php';
?>

<!-- Form untuk menambahkan detail layanan -->
<div class="container-fluid" id="container-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Service Details</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="service_id">Service</label>
                            <select class="form-control" name="service_id" required>
                                <option value="" disabled selected>Select a service</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($result_services)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="details_text">Details Text</label>
                            <textarea class="form-control" name="details_text" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="additional_info">Additional Info</label>
                            <textarea class="form-control" name="additional_info"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="persyaratan">Persyaratan</label>
                            <textarea class="form-control" name="persyaratan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="document">Document</label>
                            <input type="file" class="form-control-file" name="document" accept=".pdf, .doc, .docx">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Service Details</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
