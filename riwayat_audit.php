<?php
require_once 'function.php';
require_once 'check_login.php';

$title = "Riwayat Audit";
include("template/dashboard/header.php");
include("template/dashboard/navbar.php");
include("template/dashboard/sidebar.php");

$success_edit_message = isset($_SESSION['success_edit_message']) ? $_SESSION['success_edit_message'] : null;
$success_delete_message = isset($_SESSION['success_delete_message']) ? $_SESSION['success_delete_message'] : null;
$errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;

unset($_SESSION['success_edit_message']);
unset($_SESSION['success_delete_message']);
unset($_SESSION['error_message']);

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Riwayat Audit</h1>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?php if ($success_edit_message) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $success_edit_message; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if ($success_delete_message) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo $success_delete_message; ?>
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
                        <div class="card-header">
                            <h4>Audit</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Nama Kendaraan</th>
                                            <th>Auditor</th>
                                            <th>Tanggal</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT audit.id, kendaraan.nomor_plat, kendaraan.jenis_kendaraan, users.username AS auditor, audit.tanggal_audit
                                         FROM audit
                                         INNER JOIN kendaraan ON audit.id_kendaraan = kendaraan.id
                                         INNER JOIN users ON audit.id_user = users.id";
                                        $result = mysqli_query($koneksi, $query);

                                        if (mysqli_num_rows($result) > 0) {
                                            $no = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $row['nomor_plat'] ?> - <?= $row['jenis_kendaraan'] ?></td>
                                                    <td><?= $row['auditor'] ?></td>
                                                    <td><?= $row['tanggal_audit'] ?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detail<?= $row['id'] ?>">Detail</button>
                                                        <a href="editAudit.php?id=<?= $row['id'] ?>">
                                                            <button class="btn btn-warning btn-sm">
                                                                Edit
                                                            </button>
                                                        </a>

                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter<?= $row['id'] ?>">
                                                            Hapus
                                                        </button>
                                                        <button class="btn btn-success btn-sm"> <i class="fas fa-download"></i>
                                                            <a style="text-decoration: none; color:inherit" href="generate_pdf.php?id=<?= $row['id'] ?>">Download</a>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada data audit</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $loop = mysqli_query($koneksi, "SELECT audit.id, kendaraan.nomor_plat, kendaraan.nama_pemilik, kendaraan.nomor_telp_pemilik, kendaraan.kota, kendaraan.model, kendaraan.tahun_pembuatan, kendaraan.bu, kendaraan.jenis_kendaraan, users.username AS auditor, audit.tanggal_audit
                                FROM audit
                                INNER JOIN kendaraan ON audit.id_kendaraan = kendaraan.id
                                INNER JOIN users ON audit.id_user = users.id");
    $no = 1;
    while ($a = mysqli_fetch_array($loop)) { ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="detail<?= $a['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Audit Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Informasi Kendaraan</h6>
                        <ul>
                            <li>Nomor Plat: <?= $a['nomor_plat'] ?></li>
                            <li>Pemakai: <?= $a['nama_pemilik'] ?></li>
                            <li>Telpon: <?= $a['nomor_telp_pemilik'] ?></li>
                            <li>Jenis Kendaraan: <?= $a['jenis_kendaraan'] ?></li>
                            <li>Kota: <?= $a['kota'] ?></li>
                            <li>Model: <?= $a['model'] ?></li>
                            <li>Tahun: <?= $a['tahun_pembuatan'] ?></li>
                            <li>BU: <?= $a['bu'] ?></li>
                        </ul>
                        <h6>Detail Audit</h6>
                        <?php
                        // Query untuk mengambil detail audit berdasarkan id_audit
                        $query_detail = "SELECT * FROM detail_audit WHERE id_audit = " . $a['id'];
                        $result_detail = mysqli_query($koneksi, $query_detail);

                        if (mysqli_num_rows($result_detail) > 0) {
                            while ($detail = mysqli_fetch_assoc($result_detail)) {
                        ?>

                                <?php require("./components/detailAudit.php") ?>
                                <?php require("./components/detailGambar.php") ?>
                    </div>


            <?php
                            }
                        } else {
                            echo "<p>Tidak ada detail audit untuk kendaraan ini.</p>";
                        }
            ?>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
</div>
<?php $no++;
    } ?>

</div>

<!-- Modal Delete -->
<?php
$querySelectAudit = "SELECT id FROM audit";
$sqlSelectAudit = mysqli_query($koneksi, $querySelectAudit);
// $resultSelectAudit = mysqli_fetch_assoc($sqlSelectAudit);

while ($row = mysqli_fetch_assoc($sqlSelectAudit)) {
?>
    <div class="modal fade" id="exampleModalCenter<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Data Audit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this Audit?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="function.php?hapusAudit=<?= $row['id'] ?>">
                        <button type="button" class="btn btn-danger">Delete</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<?php include("template/dashboard/footer.php") ?>