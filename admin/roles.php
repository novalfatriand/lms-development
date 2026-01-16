<?php

    include_once '../services/config.php';
    include_once 'header.php';

?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Roles</h1>
                    <p class="mb-4">Laman pengelolaan Role.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="add-role.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                Tambah Role
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="w-10">No.</th>
                                            <th>Nama Role</th>
                                            <th class="w-52">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $data_roles = mysqli_query($conn, "SELECT * FROM roles");
                                        $angka = 1;
                                        while ($role = mysqli_fetch_assoc($data_roles)) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $angka++ ?></td>
                                                <td><?php echo $role['nama_role'] ?></td>
                                                <td>
                                                    <div class="flex flex-row gap-2">
                                                        <a href="edit-role.php?edit=<?= $role['role_id'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm px-3">
                                                            <i class="fas fa-edit mr-1"></i>Edit
                                                        </a>
                                                        <button type="submit" onclick="hapusData(<?= $role['role_id'] ?>)" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm px-2">
                                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
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
                            window.location = 'ControllersDelete.php?delete_role=' + id;
                        }
                    });
                }
                </script>

<?php include 'footer.php' ?>