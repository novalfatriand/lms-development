<?php

    
    include_once '../services/config.php';

    $edit_domain_trouble = false;
    $edit_message_trouble = null;

    if (isset($_GET['edit']))
    {
        $id_edit = mysqli_real_escape_string($conn, $_GET['edit']);

        $stmt_edit = mysqli_prepare($conn, "SELECT * FROM domains WHERE domain_id = ?");
        mysqli_stmt_bind_param($stmt_edit, "i", $id_edit);
        mysqli_stmt_execute($stmt_edit);
        $data_result = mysqli_stmt_get_result($stmt_edit);
        $data_final = mysqli_fetch_assoc($data_result);
    }


    if (isset($_POST['button-update-domain'])) {
        $nama_domain = mysqli_real_escape_string($conn, $_POST['nama-domain']);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi-domain']);

        $stmt = mysqli_prepare($conn, "UPDATE domains SET nama_domain = ?, deskripsi = ? WHERE domain_id = ?");
        mysqli_stmt_bind_param($stmt, "ssi", $nama_domain, $deskripsi, $id_edit);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            header('Location: domain.php');
            exit;
        } else {
            $edit_domain_trouble = true;
            $edit_message_trouble = "Gagal mengupdate data!";
        }
    }

    include_once 'header.php';

?>


            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Edit Domain</h1>
                    <p class="mb-4">Isi data dibawah ini untuk mengedit Domain.</p>

                            <?php if ($edit_domain_trouble) { ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php echo $edit_message_trouble ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-primary font-weight-bold mt-2 uppercase">Form Edit Domain</h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="">
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Nama Domain</label>
                                        <input type="text" name="nama-domain" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" value="<?= $data_final['nama_domain'] ?>" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Deskripsi</label>
                                        <input type="text" name="deskripsi-domain" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" value="<?= $data_final['deskripsi'] ?>" required>
                                    </div>
                                    <button type="submit" name="button-update-domain" class="ml-2.5 mr-1 mt-2 btn btn-primary btn-sm shadow-sm">Update</button>
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