<?php

    include_once '../services/config.php';
    

    $add_domain_trouble = false;
    $add_message_trouble = null;

    if (isset($_POST['button-add-domain'])) {
        $nama_domain = mysqli_real_escape_string($conn, $_POST['nama-domain']);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi-domain']);

        $stmt = mysqli_prepare($conn, "INSERT INTO domains (nama_domain, deskripsi) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $nama_domain, $deskripsi);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            header('Location: domain.php');
        } else {
            $add_domain_trouble = true;
            $add_message_trouble = "Gagal menambahkan data";
        }
    }

    include_once 'header.php';

?>


            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah Domain</h1>
                    <p class="mb-4">Isi data dibawah ini untuk menambahkan Domain.</p>

                            <?php if ($add_domain_trouble) { ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php echo $add_message_trouble ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-primary font-weight-bold mt-2 uppercase">Form Domain</h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="">
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Nama Domain</label>
                                        <input type="text" name="nama-domain" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Deskripsi</label>
                                        <input type="text" name="deskripsi-domain" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <button type="submit" name="button-add-domain" class="ml-2.5 mr-1 mt-2 btn btn-primary btn-sm shadow-sm">Submit</button>
                                    <a href="domain.php" class="mt-2 d-none d-sm-inline-block btn btn-sm btn-outline-secondary shadow-sm">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

    <?php include 'footer.php' ?>