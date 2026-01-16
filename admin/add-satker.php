<?php

    include_once '../services/config.php';
    

    $add_satker_trouble = false;
    $add_message_trouble = null;

    if (isset($_POST['button-add-satker'])) {
        $kode_satker = mysqli_real_escape_string($conn, $_POST['kode-satker']);
        $nama_satker = mysqli_real_escape_string($conn, $_POST['nama-satker']);
        $jenis_satker = mysqli_real_escape_string($conn, $_POST['jenis-satker']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $stmt = mysqli_prepare($conn, "INSERT INTO sarkers (kode_satker, nama_satker, jenis_satker, status) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $kode_satker, $nama_satker, $jenis_satker, $status);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            header('Location: satker.php');
        } else {
            $add_satker_trouble = true;
            $add_message_trouble = "Gagal menambahkan data";
        }
    }

    include_once 'header.php';

?>


            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah Satuan Kerja</h1>
                    <p class="mb-4">Isi data dibawah ini untuk menambahkan Satuan Kerja.</p>

                            <?php if ($add_satker_trouble) { ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php echo $add_message_trouble ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-primary font-weight-bold mt-2 uppercase">Form Satuan Kerja</h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="">
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Kode Satker</label>
                                        <input type="text" name="kode-satker" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Nama Satker</label>
                                        <input type="text" name="nama-satker" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Jenis Satker</label>
                                        <input type="text" name="jenis-satker" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <button type="submit" name="button-add-satker" class="ml-2.5 mr-1 mt-2 btn btn-primary btn-sm shadow-sm">Submit</button>
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