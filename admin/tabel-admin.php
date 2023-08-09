<?php
include 'include/navbar.php';
include '../include/config.php';
?>

<!-- Topbar -->
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Admin</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
                    <button class="btn btn-primary" id="btnTambahAdmin">Tambah Admin</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>No Telpon</th>
                                <th>Foto</th>
                                <th>Aksi</th> <!-- Kolom untuk tombol aksi -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Include the config.php file to establish a database connection
                            require '../include/config.php';

                            // Prepare and execute the SQL query to fetch the data from the admins table
                            $sql = "SELECT * FROM admins";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $count . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td> *************</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['no_telp'] . "</td>";
                                    echo "<td><img src='uploads/" . $row['images'] . "' alt='Foto Admin' style='width: 100px; height: 100px;'></td>";
                                    echo "<td>
                                        <a href='edit-admin.php?id=" . $row['id'] . "' class='btn btn-success btn-sm'>Edit</a>
                                        <a href='process-delete-admin.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
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

    <!-- Form tambah admin -->
    <div class="col-lg-6 form-tambah-admin" style="display: none;">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Admin</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="include/process-add-admin.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="new_username">Username</label>
                        <input type="text" class="form-control" id="new_username" name="new_username" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_email">Email</label>
                        <input type="email" class="form-control" id="new_email" name="new_email" required>
                    </div>
                    <div class="form-group">
                        <label for="new_no_telp">No. Telpon</label>
                        <input type="text" class="form-control" id="new_no_telp" name="new_no_telp" required>
                    </div>
                    <div class="form-group">
                        <label for="admin_photo">Foto Admin</label>
                        <input type="file" class="form-control-file" id="admin_photo" name="admin_photo">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Your existing JavaScript code -->
<script>
    document.getElementById('btnTambahAdmin').addEventListener('click', toggleFormTambahAdmin);

    function toggleFormTambahAdmin() {
        var formTambahAdmin = document.querySelector('.form-tambah-admin');
        if (formTambahAdmin.style.display === 'none') {
            formTambahAdmin.style.display = 'block';
        } else {
            formTambahAdmin.style.display = 'none';
        }
    }
</script>

<!-- Footer -->
<?php include 'include/footer.php'; ?>