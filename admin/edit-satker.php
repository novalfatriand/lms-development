<?php

    
    include_once '../services/config.php';

    $edit_satker_trouble = false;
    $edit_message_trouble = null;

    if (isset($_GET['edit']))
    {
        $id_edit = mysqli_real_escape_string($conn, $_GET['edit']);

        $stmt_edit = mysqli_prepare($conn, "SELECT * FROM sarkers WHERE satker_id = ?");
        mysqli_stmt_bind_param($stmt_edit, "i", $id_edit);
        mysqli_stmt_execute($stmt_edit);
        $data_result = mysqli_stmt_get_result($stmt_edit);
        $data_final = mysqli_fetch_assoc($data_result);
    }


    if (isset($_POST['button-update-satker'])) {
        $kode_satker = mysqli_real_escape_string($conn, $_POST['kode-satker']);
        $nama_satker = mysqli_real_escape_string($conn, $_POST['nama-satker']);
        $jenis_satker = mysqli_real_escape_string($conn, $_POST['jenis-satker']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $stmt = mysqli_prepare($conn, "UPDATE sarkers SET kode_satker = ?, nama_satker = ?, jenis_satker = ?, status = ? WHERE satker_id = ?");
        mysqli_stmt_bind_param($stmt, "ssssi", $kode_satker, $nama_satker, $jenis_satker, $status, $id_edit);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            header('Location: satker.php');
            exit;
        } else {
            $edit_satker_trouble = true;
            $edit_message_trouble = "Gagal mengupdate data!";
        }
    }

    include_once 'header.php';

?>


            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Edit Satuan Kerja</h1>
                    <p class="mb-4">Isi data dibawah ini untuk mengedit Satuan Kerja.</p>

                            <?php if ($edit_satker_trouble) { ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php echo $edit_message_trouble ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-primary font-weight-bold mt-2 uppercase">Form Edit Satuan Kerja</h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="">
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Kode Satker</label>
                                        <input type="text" name="kode-satker" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" value="<?= $data_final['kode_satker'] ?>" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Nama Satker</label>
                                        <input type="text" name="nama-satker" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" value="<?= $data_final['nama_satker'] ?>" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Jenis Satker</label>
                                        <input type="text" name="jenis-satker" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" value="<?= $data_final['jenis_satker'] ?>" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" value="<?= $data_final['status'] ?>" required>
                                    </div>
                                    <button type="submit" name="button-update-satker" class="ml-2.5 mr-1 mt-2 btn btn-primary btn-sm shadow-sm">Update</button>
                                    <a href="satker.php" class="mt-2 d-none d-sm-inline-block btn btn-sm btn-outline-secondary shadow-sm">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

    <?php include 'footer.php' ?>