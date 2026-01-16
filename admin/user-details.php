<?php

    include_once '../services/config.php';
    

    $add_user_trouble = false;
    $add_message_trouble = null;

    $data_role = mysqli_query($conn, "SELECT role_id, nama_role FROM roles");
    $data_satker = mysqli_query($conn, "SELECT satker_id, nama_satker FROM sarkers");
    $data_domain = mysqli_query($conn, "SELECT domain_id, nama_domain FROM domains");

    if (isset($_GET['id']))
    {
        $id_set = mysqli_real_escape_string($conn, $_GET['id']);
        $data_user = mysqli_query($conn, "SELECT nama FROM users WHERE user_id = $id_set");
        $user_result = mysqli_fetch_assoc($data_user);
    }

    // ambil role user saat ini
    $existingRoles = [];
    $q = mysqli_query($conn, "SELECT role_id FROM user_roles WHERE user_id = $id_set");

    while($r = mysqli_fetch_assoc($q)){
        $existingRoles[] = $r['role_id'];
    }

    // ambil domain user saat ini
    $existingDomains = [];
    $q = mysqli_query($conn, "SELECT domain_id FROM user_domains WHERE user_id = $id_set");

    while($r = mysqli_fetch_assoc($q)){
        $existingDomains[] = $r['domain_id'];
    }


    if (isset($_POST['button-add-access'])) {

        $roles   = $_POST['roles'];      // array
        $domains = $_POST['domains'];    // array
        $satker  = mysqli_real_escape_string($conn, $_POST['satker']);

        // ===================== ROLE PROCESS =====================

        if(!in_array(6, $roles)){
            $roles[] = 6;
        }

        mysqli_query($conn, "
            DELETE FROM user_roles 
            WHERE user_id = $id_set 
            AND role_id != 6
        ");

        foreach($roles as $role){
            $role = mysqli_real_escape_string($conn, $role);

            if($role == 6) continue;

            mysqli_query($conn, "
                INSERT INTO user_roles (user_id, role_id) 
                VALUES ($id_set, $role)
            ");
        }

        // ===================== DOMAIN PROCESS =====================

        mysqli_query($conn, "
            DELETE FROM user_domains 
            WHERE user_id = $id_set
        ");

        foreach($domains as $dom){
            $dom = mysqli_real_escape_string($conn, $dom);

            mysqli_query($conn, "
                INSERT INTO user_domains (user_id, domain_id)
                VALUES ($id_set, $dom)
            ");
        }

        // ===================== SATKER PROCESS =====================

        mysqli_query($conn, "
            UPDATE user_profiles 
            SET satker_id = $satker
            WHERE user_id = $id_set
        ");

        // ===================== DONE =====================

        echo "<script>
            alert('Access user berhasil diperbarui');
            window.location='users.php';
        </script>";
        exit;
    }

    include_once 'header.php';

?>


            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Set Access User</h1>
                    <p class="mb-4">Setup User Authority dibawah ini.</p>

                            <?php if ($add_user_trouble) { ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php echo $add_message_trouble ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-primary text-sm font-bold mt-2 uppercase">Form Access for <span class="ml-1 text-xl font-bold"><?= $user_result['nama'] ?></span></h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="">
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label">Role</label>
                                        <select class="form-control" name="roles[]" multiple required>

                                            <?php while($r = mysqli_fetch_assoc($data_role)) { ?>
                                                <option value="<?= $r['role_id'] ?>"
                                                    <?= in_array($r['role_id'], $existingRoles) ? 'selected' : '' ?>>
                                                    <?= $r['nama_role'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label">Satuan Kerja</label>
                                        <select class="form-control" name="satker" required>

                                            <?php while($s = mysqli_fetch_assoc($data_satker)) { ?>
                                                <option value="<?= $s['satker_id'] ?>">
                                                    <?= $s['nama_satker'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

<div class="mb-3 col-sm-6">
    <label class="form-label">Domain</label>

    <div class="border p-2 rounded">
        <?php while($d = mysqli_fetch_assoc($data_domain)) { ?>
            <div class="form-check">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    name="domains[]" 
                    value="<?= $d['domain_id'] ?>"
                    id="domain<?= $d['domain_id'] ?>"
                    <?= in_array($d['domain_id'], $existingDomains) ? 'checked' : '' ?>
                >

                <label class="form-check-label" for="domain<?= $d['domain_id'] ?>">
                    <?= $d['nama_domain'] ?>
                </label>
            </div>
        <?php } ?>
    </div>

</div>

                                    

                                    <button type="submit" name="button-add-access" class="ml-2.5 mr-1 mt-2 btn btn-primary btn-sm shadow-sm">Submit</button>
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