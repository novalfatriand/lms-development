<?php

    include_once '../services/config.php';
    include_once 'header.php';

?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Satuan Kerja</h1>
                    <p class="mb-4">Laman pengelolaan Satuan Kerja.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="add-satker.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                Tambah Satker
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="w-10">No.</th>
                                            <th>Kode Satker</th>
                                            <th>Nama Satker</th>
                                            <th>Jenis Satker</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th class="w-52">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $data_satker = mysqli_query($conn, "SELECT * FROM sarkers");
                                        $angka = 1;
                                        while ($satker = mysqli_fetch_assoc($data_satker)) { ?>
                                            <tr>
                                                <td class="text-center"><?= $angka++ ?></td>
                                                <td><?= $satker['kode_satker'] ?></td>
                                                <td><?= $satker['nama_satker'] ?></td>
                                                <td><?= $satker['jenis_satker'] ?></td>
                                                <td><?= $satker['status'] ?></td>
                                                <td><?= $satker['created_at'] ?></td>
                                                <td>
                                                    <div class="flex flex-row gap-2">
                                                        <a href="edit-satker.php?edit=<?= $satker['satker_id'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm px-3">
                                                            <i class="fas fa-edit mr-1"></i> Edit
                                                        </a>
                                                        <button type="submit" onclick="hapusData(<?= $satker['satker_id'] ?>)" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm px-2">
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
                            window.location = 'ControllersDelete.php?delete_satker=' + id;
                        }
                    });
                }
                </script>

<?php include 'footer.php' ?>