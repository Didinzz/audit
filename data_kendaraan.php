<?php
require_once 'function.php';
require_once 'check_login.php';

$title = "Data Kendaraan";
include("template/dashboard/header.php");
include("template/dashboard/navbar.php");
include("template/dashboard/sidebar.php");

$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
$errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;

unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Kendaraan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?php if ($successMessage) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $successMessage; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if ($errorMessage) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $errorMessage; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <div class="card-header justify-content-">
                            <h4>Table</h4>
                            <div class="card-header-action">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah</button>
                                <a href="laporan_excel.php">
                                    <button class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Nomor Polisi</th>
                                            <th>Pemakai</th>
                                            <th>Telpon</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Kota</th>
                                            <th>Model</th>
                                            <th>Tahun Pembuatan</th>
                                            <th>BU</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $loop = mysqli_query($koneksi, "select * from kendaraan");
                                        $no = 1;
                                        while ($a = mysqli_fetch_array($loop)) { ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $a['nomor_plat'] ?></td>
                                                <td><?= $a['nama_pemilik'] ?></td>
                                                <td><?= $a['nomor_telp_pemilik'] ?></td>
                                                <td><?= $a['jenis_kendaraan'] ?></td>
                                                <td><?= $a['kota'] ?></td>
                                                <td><?= $a['model'] ?></td>
                                                <td><?= $a['tahun_pembuatan'] ?></td>
                                                <td><?= $a['bu'] ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $a['id'] ?>">Edit</button>
                                                    <a href="function.php?hapusKendaraan=<?= $a['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="tambahModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kendaraan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nomor Polisi</label>
                            <input type="text" class="form-control" name="no_plat" id="no_plat" placeholder="B 1234 XYZ" required>
                        </div>
                        <div class="form-group">
                            <label>Pemakai</label>
                            <input type="text" class="form-control" name="namaPemilik" id="namaPemilik" placeholder="Nama Pemakai" required>
                        </div>
                        <div class="form-group">
                            <label>Telpon</label>
                            <input type="text" class="form-control" name="nomorPemilik" id="nomorPemilik" placeholder="08*******" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kendaraan</label>
                            <input type="text" class="form-control" name="jenis_kendaraan" id="jenis_kendaraan" placeholder="Toyota Avansa" required>
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" class="form-control" name="kota" id="kota" required>
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" class="form-control" name="model" id="model" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun Pembuatan</label>
                            <input type="number" class="form-control" name="tahun" id="tahun" placeholder="2022" required>
                        </div>

                        <div class="form-group">
                            <label>BU</label>
                            <textarea class="form-control" name="bu" id="bu" rows="4" cols="50"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" name="tambahKendaraan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    $loop = mysqli_query($koneksi, "select * from kendaraan");
    $no = 1;
    while ($a = mysqli_fetch_array($loop)) { ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="editModal<?= $a['id'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $a['id'] ?>">
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <input type="text" class="form-control" name="no_plat" id="no_plat" value="<?= $a['nomor_plat'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Pemakai</label>
                                <input type="text" class="form-control" name="namaPemilik" id="namaPemilik" value="<?= $a['nama_pemilik'] ?>" placeholder="Nama Pemilik" required>
                            </div>
                            <div class="form-group">
                                <label>Telpon</label>
                                <input type="text" class="form-control" value="<?= $a['nomor_telp_pemilik'] ?>" name="nomorPemilik" id="nomorPemilik" placeholder="08*******" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kendaraan</label>
                                <input type="text" class="form-control" name="jenis_kendaraan" id="jenis_kendaraan" value="<?= $a['jenis_kendaraan'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Kota</label>
                                <input type="text" class="form-control" name="kota" id="kota" value="<?= $a['kota'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" class="form-control" name="model" id="model" value="<?= $a['model'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Tahun Pembuatan</label>
                                <input type="number" class="form-control" name="tahun" id="tahun" value="<?= $a['tahun_pembuatan'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>BU</label>
                                <textarea class="form-control" name="bu" id="bu" rows="4" cols="50"><?= $a['bu'] ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                            <button type="submit" name="editKendaraan" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php $no++;
    } ?>
</div>


<?php include("template/dashboard/footer.php") ?>