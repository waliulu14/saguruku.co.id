<?php
include '../include/config.php';
include 'include/navbar.php';

$sql = "SELECT service_details.*, services.title AS service_name, service_files.file_path FROM service_details
        LEFT JOIN services ON service_details.service_id = services.id
        LEFT JOIN service_files ON service_details.id = service_files.service_detail_id";
$result = mysqli_query($conn, $sql);

$sql_images = "SELECT si.*, s.title AS service_name FROM service_images si
               INNER JOIN services s ON si.service_id = s.id";
$result_images = mysqli_query($conn, $sql_images);
?>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Service Details</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Service Details</h6>
                    <a href="add-service-details.php" class="btn btn-primary">Add Service Details</a>
                </div>

                
                            <div class="row">
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush" id="dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Service Name</th>
                                                <th>Details Text</th>
                                                <th>Additional Info</th>
                                                <th>Persyaratan</th>
                                                <th>Detail Document</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                $count = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>{$count}</td>";
                                                    echo "<td>{$row['service_name']}</td>";
                                                    echo "<td>{$row['details_text']}</td>";

                                                    // Display only a portion of the Additional Info
                                                    echo "<td>" . substr($row['additional_info'], 0, 100) . "...</td>";

                                                    // Display only a portion of the Persyaratan
                                                    echo "<td>" . substr($row['persyaratan'], 0, 100) . "...</td>";

                                                    // Replace "docume" with the actual path to your detail-document.php file
                                                    echo "<td><a href='detail-document.php?id={$row['id']}' target='_blank'>View Document</a></td>";

                                                    echo "<td>
                            <a href='edit-service-details.php?id={$row['id']}' class='btn btn-success btn-sm'>Edit</a>
                            <a href='process-delete-service-details.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                          </td>";
                                                    echo "</tr>";
                                                    $count++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>No records found</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Service Images</h6>
                            <a href="add-service-images.php" class="btn btn-primary">Add Service Images</a>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Service ID</th>
                                        <th>Image 1</th>
                                        <th>Image 2</th>
                                        <th>Image 3</th>
                                        <th>Image 4</th>
                                        <th>Image 5</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result_images) > 0) {
                                        $count = 1;
                                        while ($row_images = mysqli_fetch_assoc($result_images)) {
                                            // Display rows for service images
                                            echo "<tr>";
                                            echo "<td>{$count}</td>";
                                            echo "<td>{$row_images['id']}</td>";
                                            echo "<td>{$row_images['service_name']}</td>";
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo "<td><img src='../uploads/{$row_images['image_url' .$i]}' alt='Image {$i}' style='width: 100px; height: 100px;'></td>";
                                            }
                                            echo "<td>
                                            <a href='edit-service-images.php?id={$row_images['id']}' class='btn btn-success btn-sm'>Edit</a>
                                            <a href='process-delete-service-images.php?id={$row_images['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                          </td>";
                                            echo "</tr>";
                                            $count++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No records found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'include/footer.php'; ?>