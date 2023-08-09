<?php
// Include the config.php file to establish a database connection
include '../include/config.php';
?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Service Data</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Service Data</h6>
                    <!-- Add button to add new service items -->
                    <a href="add-service.php" class="btn btn-primary">Add New Service</a>
                </div>
                   
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Prepare and execute the SQL query to fetch the data from the services table
                            $sql = "SELECT * FROM services";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $count . "</td>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td><img src='../uploads/" . $row['image_url'] . "' alt='Service Image' style='width: 100px; height: 100px;'></td>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['description'] . "</td>";
                                    echo "<td>
                                        <a href='edit-service.php?id=" . $row['id'] . "' class='btn btn-success btn-sm'>Edit</a>
                                        <a href='delete-service.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this service?\")'>Delete</a>
                                    </td>";
                                    echo "</tr>";
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
