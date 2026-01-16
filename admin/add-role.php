<?php

    include_once '../services/config.php';
    

    $add_role_trouble = false;
    $add_message_trouble = null;

    if (isset($_POST['button-add-role'])) {
        $nama_role = mysqli_real_escape_string($conn, $_POST['nama-role']);

        $stmt = mysqli_prepare($conn, "INSERT INTO roles (nama_role) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $nama_role);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            header('Location: roles.php');
        } else {
            $add_role_trouble = true;
            $add_message_trouble = "Gagal menambahkan data";
        }
    }

    include_once 'header.php';

?>


            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah Role</h1>
                    <p class="mb-4">Isi data dibawah ini untuk menambahkan Role.</p>

                            <?php if ($add_role_trouble) { ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php echo $add_message_trouble ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-primary font-weight-bold mt-2 uppercase">Form Role</h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="">
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Nama Role</label>
                                        <input type="text" name="nama-role" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <button type="submit" name="button-add-role" class="ml-2.5 mr-1 mt-2 btn btn-primary btn-sm shadow-sm">Submit</button>
                                    <a href="roles.php" class="mt-2 d-none d-sm-inline-block btn btn-sm btn-outline-secondary shadow-sm">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

    <?php include 'footer.php' ?>