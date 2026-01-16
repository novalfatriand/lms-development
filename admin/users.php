<?php

    include_once '../services/config.php';
    include_once 'header.php';
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>
                    <p class="mb-4">Laman pengelolaan User.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="add-user.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                Tambah User
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="w-10">No.</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Satker</th>
                                            <th>Domain</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $data_users = mysqli_query($conn, "
                                            SELECT 
                                                users.user_id,
                                                users.nama,
                                                users.email,
                                                users.status,
                                                users.updated_at,

                                                GROUP_CONCAT(DISTINCT roles.nama_role SEPARATOR ', ') AS roles,
                                                GROUP_CONCAT(DISTINCT domains.nama_domain SEPARATOR ', ') AS domains,

                                                sarkers.nama_satker

                                            FROM users

                                            LEFT JOIN user_roles 
                                                ON users.user_id = user_roles.user_id
                                            LEFT JOIN roles 
                                                ON user_roles.role_id = roles.role_id

                                            LEFT JOIN user_profiles 
                                                ON users.user_id = user_profiles.user_id
                                            LEFT JOIN sarkers
                                                ON user_profiles.satker_id = sarkers.satker_id

                                            LEFT JOIN user_domains 
                                                ON users.user_id = user_domains.user_id
                                            LEFT JOIN domains 
                                                ON user_domains.domain_id = domains.domain_id

                                            GROUP BY users.user_id
                                        ");

                                        $angka = 1;
                                        while ($user = mysqli_fetch_assoc($data_users)) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $angka++ ?></td>
                                                <td><?php echo $user['nama'] ?></td>
                                                <td><?php echo $user['email'] ?></td>
                                                <td><?php echo $user['status'] ?></td>
                                                <td><?php echo $user['roles'] ?></td>
                                                <td><?php echo $user['nama_satker'] ?></td>
                                                <td><?php echo $user['domains'] ?></td>
                                                <td><?php echo $user['updated_at'] ?></td>
                                                <td>
                                                    <div class="flex flex-row gap-1">
                                                        <a href="user-details.php?id=<?= $user['user_id'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                            Access
                                                        </a>
                                                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="submit" onclick="hapusData(<?= $user['user_id'] ?>)" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

                <script>
                function hapusData(id) {
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: 'Data tidak dapat dikembalikan',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = 'ControllersDelete.php?delete_user=' + id;
                        }
                    });
                }
                </script>

<?php include 'footer.php' ?>