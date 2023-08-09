<!-- Include the config.php file to establish a database connection -->
<?php include '../include/config.php'; ?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Our Blog</h1>
    </div>

    <!-- Row for Blog Projects -->
    <div class="row">
        <!-- Datatables for Blog Projects -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Projects</h6>
                    <!-- Add button to add new blog projects -->
                    <a href="tambah-blog-project.php" class="btn btn-primary">Tambah Blog Project</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTableProjects">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Prepare and execute the SQL query to fetch the data from the blog_projects table
                            $sqlProjects = "SELECT * FROM blog_projects";
                            $resultProjects = mysqli_query($conn, $sqlProjects);

                            if (mysqli_num_rows($resultProjects) > 0) {
                                $countProjects = 1;
                                while ($rowProjects = mysqli_fetch_assoc($resultProjects)) {
                                    echo "<tr>";
                                    echo "<td>" . $countProjects . "</td>";
                                    echo "<td>" . $rowProjects['id'] . "</td>";
                                    echo "<td>" . $rowProjects['title'] . "</td>";
                                    echo "<td><img src='../uploads/" . $rowProjects['image_url'] . "' alt='Blog Project Image' style='width: 100px; height: 100px;'></td>";
                                    echo "<td>
                                        <a href='edit-blog-project.php?id=" . $rowProjects['id'] . "' class='btn btn-success btn-sm'>Edit</a>
                                        <a href='process-delete-blog-project.php?id=" . $rowProjects['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>";
                                    echo "</tr>";
                                    $countProjects++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Row for Blog Details -->
    <div class="row">
        <!-- Datatables for Blog Details -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Details</h6>
                    <!-- Add button to add new blog details -->
                    <a href="tambah-blog-detail.php" class="btn btn-primary">Tambah Blog Detail</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTableDetails">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Content</th>
                                <th>Blog Link</th>
                                <th>Project Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Prepare and execute the SQL query to fetch data from both tables using JOIN
                            $sqlDetails = "SELECT d.id, d.title, d.image_url, d.content, d.blog_link, p.title as project_title FROM blog_details d INNER JOIN blog_projects p ON d.project_id = p.id";
                            $resultDetails = mysqli_query($conn, $sqlDetails);

                            if (mysqli_num_rows($resultDetails) > 0) {
                                $countDetails = 1;
                                while ($rowDetails = mysqli_fetch_assoc($resultDetails)) {
                                    echo "<tr>";
                                    echo "<td>" . $countDetails . "</td>";
                                    echo "<td>" . $rowDetails['id'] . "</td>";
                                    echo "<td>" . $rowDetails['title'] . "</td>";
                                    echo "<td><img src='../blog/" . $rowDetails['image_url'] . "' alt='Blog Detail Image' style='width: 100px; height: 100px;'></td>";
                                    echo "<td>" . $rowDetails['content'] . "</td>";
                                    echo "<td>" . $rowDetails['blog_link'] . "</td>";
                                    echo "<td>" . $rowDetails['project_title'] . "</td>";
                                    echo "<td>
                                        <a href='edit-blog-detail.php?id=" . $rowDetails['id'] . "' class='btn btn-success btn-sm'>Edit</a>
                                        <a href='process-delete-blog-detail.php?id=" . $rowDetails['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>";
                                    echo "</tr>";
                                    $countDetails++;
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
