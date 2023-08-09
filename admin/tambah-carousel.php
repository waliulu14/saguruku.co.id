<?php include '../include/config.php'; ?>

<!-- Include header -->
<?php include 'include/navbar.php'; ?>

<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Carousel</h1>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Carousel</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="proses-tambah-carousel.php" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="image_url">Image File</label>
                            <input type="file" class="form-control-file" id="image_file" name="image_file" required>
                        </div>
                        <div class="form-group">
                            <label for="caption_title">Caption Title</label>
                            <input type="text" class="form-control" id="caption_title" name="caption_title" required>
                        </div>
                        <div class="form-group">
                            <label for="caption_subtitle">Caption Subtitle</label>
                            <input type="text" class="form-control" id="caption_subtitle" name="caption_subtitle" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Carousel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include 'include/footer.php'; ?>
