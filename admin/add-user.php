<?php

    include_once '../services/config.php';
    

    $add_user_trouble = false;
    $add_message_trouble = null;

    if (isset($_POST['button-add-user'])) {
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn, "INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $pass_hash);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            $findNewUser = mysqli_query($conn, "SELECT user_id FROM users WHERE email = '$email'");
            $dataNewUser = mysqli_fetch_assoc($findNewUser);
            $idNewUser = $dataNewUser['user_id'];

            $q = mysqli_query($conn,
                    "SELECT domain_id FROM domains WHERE is_default = 1"
            );
            $row = mysqli_fetch_assoc($q);
            $default_domain = $row['domain_id'];

            // Setup Role Default (Learner)
            $stmt = mysqli_prepare($conn, "INSERT INTO user_roles (user_id, role_id) VALUES (?, 6)");
            mysqli_stmt_bind_param($stmt, "i", $idNewUser);
            $stmt->execute();

            $stmt_satker = mysqli_prepare($conn, "INSERT INTO user_profiles (user_id, satker_id, jenis_pegawai, keterangan) VALUES (?, 3, 'ASN_KEMLU', 'Spouse')");
            mysqli_stmt_bind_param($stmt_satker, "i", $idNewUser);
            $stmt_satker->execute();

            $stmt_domain = mysqli_prepare($conn, "INSERT INTO user_domains (user_id, domain_id) VALUES (?, $default_domain)");
            mysqli_stmt_bind_param($stmt_domain, "i", $idNewUser);
            $stmt_domain->execute();

            header('Location: users.php');
            exit;
        } else {
            $add_user_trouble = true;
            $add_message_trouble = "Gagal menambahkan data";
        }
    }

    include_once 'header.php';

?>


            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>
                    <p class="mb-4">Isi data dibawah ini untuk menambahkan User.</p>

                            <?php if ($add_user_trouble) { ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php echo $add_message_trouble ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-primary font-weight-bold mt-2 uppercase">Form User</h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="">
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputNama1" class="form-label">Password</label>
                                        <input type="text" name="password" class="form-control" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                    </div>
                                    <button type="submit" name="button-add-user" class="ml-2.5 mr-1 mt-2 btn btn-primary btn-sm shadow-sm">Submit</button>
                                    <a href="users.php" class="mt-2 d-none d-sm-inline-block btn btn-sm btn-outline-secondary shadow-sm">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

    <?php include 'footer.php' ?>