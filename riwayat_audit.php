<?php
require_once 'function.php';
require_once 'check_login.php';

$title = "Riwayat Audit";
include("template/dashboard/header.php");
include("template/dashboard/navbar.php");
include("template/dashboard/sidebar.php");

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
                                            <th>Action</th>
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
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detail<?= $row['id'] ?>">Detail</button>
                                                        <button class="btn btn-warning btn-sm"> <i class="fas fa-download"></i>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Bagian Dalam Kendaraan</h5>
                                                <div class="mb-3">

                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Stiker:</strong>
                                                        <span class="badge badge-<?php echo ($detail['stiker'] == 'Ada') ? 'success' : (($detail['stiker'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['stiker']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Dashcam:</strong>
                                                        <span class="badge badge-<?php echo ($detail['dashcam'] == 'Ada') ? 'success' : (($detail['dashcam'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['dashcam']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Sunvisor:</strong>
                                                        <span class="badge badge-<?php echo ($detail['sunvisor'] == 'Ada') ? 'success' : (($detail['sunvisor'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['sunvisor']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Klakson:</strong>
                                                        <span class="badge badge-<?php echo ($detail['klakson'] == 'Ada') ? 'success' : (($detail['klakson'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['klakson']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Door Trim:</strong>
                                                        <span class="badge badge-<?php echo ($detail['door_trim'] == 'Ada') ? 'success' : (($detail['door_trim'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['door_trim']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Jok:</strong>
                                                        <span class="badge badge-<?php echo ($detail['jok'] == 'Bagus') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['jok']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Speaker:</strong>
                                                        <span class="badge badge-<?php echo ($detail['speaker'] == 'Bagus') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['speaker']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Glovebox:</strong>
                                                        <span class="badge badge-<?php echo ($detail['glovebox'] == 'Ada') ? 'success' : (($detail['glovebox'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['glovebox']); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Bagian Luar Kendaraan</h5>
                                                <div class="mb-3">
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Cap Ban:</strong>
                                                        <span class="badge badge-<?php echo ($detail['cap_ban'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['cap_ban']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Body:</strong>
                                                        <span class="badge badge-<?php echo ($detail['body'] == 'Mulus') ? 'success' : (($detail['body'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['body']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Bemper Depan:</strong>
                                                        <span class="badge badge-<?php echo ($detail['bemper_depan'] == 'Mulus') ? 'success' : (($detail['bemper_depan'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['bemper_depan']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Bemper Belakang:</strong>
                                                        <span class="badge badge-<?php echo ($detail['bemper_belakang'] == 'Mulus') ? 'success' : (($detail['bemper_belakang'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['bemper_belakang']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Fender Depan:</strong>
                                                        <span class="badge badge-<?php echo ($detail['fender_depan'] == 'Mulus') ? 'success' : (($detail['fender_depan'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['fender_depan']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Fender Belakang:</strong>
                                                        <span class="badge badge-<?php echo ($detail['fender_belakang'] == 'Mulus') ? 'success' : (($detail['fender_belakang'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['fender_belakang']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Box:</strong>
                                                        <span class="badge badge-<?php echo ($detail['box'] == 'Mulus') ? 'success' : (($detail['box'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['box']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Headlamp:</strong>
                                                        <span class="badge badge-<?php echo ($detail['headlamp'] == 'Mulus') ? 'success' : (($detail['headlamp'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['headlamp']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Stoplamp:</strong>
                                                        <span class="badge badge-<?php echo ($detail['stoplamp'] == 'Mulus') ? 'success' : (($detail['stoplamp'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['stoplamp']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Kaca Depan:</strong>
                                                        <span class="badge badge-<?php echo ($detail['kaca_depan'] == 'Bagus') ? 'success' : (($detail['kaca_depan'] == 'Retak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['kaca_depan']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Spion:</strong>
                                                        <span class="badge badge-<?php echo ($detail['spion'] == 'Bagus') ? 'success' : (($detail['spion'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['spion']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Ban Depan:</strong>
                                                        <span class="badge badge-<?php echo ($detail['ban_depan'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ban_depan']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Ban Belakang:</strong>
                                                        <span class="badge badge-<?php echo ($detail['ban_belakang'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ban_belakang']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Ban Serep:</strong>
                                                        <span class="badge badge-<?php echo ($detail['ban_serep'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ban_serep']); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Toolkit</h5>
                                                <div class="mb-3">
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Dongkrak:</strong>
                                                        <span class="badge badge-<?php echo ($detail['dongkrak'] == 'Ada') ? 'success' : (($detail['dongkrak'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['dongkrak']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Kunci Roda:</strong>
                                                        <span class="badge badge-<?php echo ($detail['kunci_roda'] == 'Ada') ? 'success' : (($detail['kunci_roda'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['kunci_roda']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Stik Roda:</strong>
                                                        <span class="badge badge-<?php echo ($detail['stik_roda'] == 'Ada') ? 'success' : (($detail['stik_roda'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['stik_roda']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Kotak P3K:</strong>
                                                        <span class="badge badge-<?php echo ($detail['kotak_p3k'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['kotak_p3k']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Warning Tirangel:</strong>
                                                        <span class="badge badge-<?php echo ($detail['warning_tirangel'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['warning_tirangel']); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Dokumen</h5>
                                                <div class="mb-3">
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>STNK:</strong>
                                                        <span class="badge badge-<?php echo ($detail['stnk'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['stnk']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>KIR:</strong>
                                                        <span class="badge badge-<?php echo ($detail['kir'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['kir']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>Kartu KIR:</strong>
                                                        <span class="badge badge-<?php echo ($detail['kartu_kir'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['kartu_kir']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>SIPA:</strong>
                                                        <span class="badge badge-<?php echo ($detail['sipa'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['sipa']); ?></span>
                                                    </div>
                                                    <div class="d-flex mb-1 justify-content-between align-items-center">
                                                        <strong>IBM:</strong>
                                                        <span class="badge badge-<?php echo ($detail['ibm'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ibm']); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Temuan</h5>
                                        <div class="mb-3">
                                            <p><?php echo $detail['temuan'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h3 class="card-title">Dokumentasi</h3>
                                        <?php
                                        $gambar_query = "SELECT * FROM detail_gambar WHERE id_audit_detail = " . $detail['id'];
                                        $result_detail_gambar = mysqli_query($koneksi, $gambar_query);
                                        if (mysqli_num_rows($result_detail_gambar) > 0) {
                                            while ($g = mysqli_fetch_assoc($result_detail_gambar)) {
                                        ?>
                                                <!-- Bagian Dalam Kendaraan Start -->
                                                <h4 class="card-subtitle mb-3 mt-3" style="color:black;">Bagian Dalam Kendaraan</h4>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Stiker:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_stiker'] ?>" width="100%" alt="<?= $g['gambar_stiker'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Dashcam:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_dashcam'] ?>" width="100%" alt="<?= $g['gambar_dashcam'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Sunvisor:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_sunvisor'] ?>" width="100%" alt="<?= $g['gambar_sunvisor'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Klakson:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_klakson'] ?>" width="100%" alt="<?= $g['gambar_klakson'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Door Trim:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_door_trim'] ?>" width="100%" alt="<?= $g['gambar_door_trim'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Jok:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_jok'] ?>" width="100%" alt="<?= $g['gambar_jok'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Speaker:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_speaker'] ?>" width="100%" alt="<?= $g['gambar_speaker'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Glovebox:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_glovebox'] ?>" width="100%" alt="<?= $g['gambar_glovebox'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Bagian Dalam Kendaraan End -->
                                                <!-- Bagain Luar Kendaraan Start -->
                                                <h4 class="card-subtitle mb-3 mt-3" style="color: black;">Bagian Luar Kendaraan</h4>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Cap Ban:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_cap_ban'] ?>" width="100%" alt="<?= $g['gambar_cap_ban'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Body:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_body'] ?>" width="100%" alt="<?= $g['gambar_body'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Bemper Depan:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_bemper_depan'] ?>" width="100%" alt="<?= $g['gambar_bemper_depan'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Bemper Belakang:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_bemper_belakang'] ?>" width="100%" alt="<?= $g['gambar_bemper_belakang'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Fender Depan:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_fender_depan'] ?>" width="100%" alt="<?= $g['gambar_fender_depan'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Fender Belakang:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_fender_belakang'] ?>" width="100%" alt="<?= $g['gambar_fender_belakang'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Box:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_box'] ?>" width="100%" alt="<?= $g['gambar_box'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Headlamp:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_headlamp'] ?>" width="100%" alt="<?= $g['gambar_headlamp'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Stoplamp:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_stoplamp'] ?>" width="100%" alt="<?= $g['gambar_stoplamp'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar kaca Depan:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_kaca_depan'] ?>" width="100%" alt="<?= $g['gambar_kaca_depan'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Spion:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_spion'] ?>" width="100%" alt="<?= $g['gambar_spion'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Ban Depan:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_ban_depan'] ?>" width="100%" alt="<?= $g['gambar_ban_depan'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Ban Belakang:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_ban_belakang'] ?>" width="100%" alt="<?= $g['gambar_ban_belakang'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Ban Serep:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_ban_serep'] ?>" width="100%" alt="<?= $g['gambar_ban_serep'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Bagain Luar Kendaraan End -->
                                                <!-- Toolkit Start -->
                                                <h4 class="card-subtitle mb-3 mt-3" style="color:black;">Toolkit</h4>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Dongkrak:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_dongkrak'] ?>" width="100%" alt="<?= $g['gambar_dongkrak'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Kunci Roda:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_kunci_roda'] ?>" width="100%" alt="<?= $g['gambar_kunci_roda'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Stik Roda:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_stik_roda'] ?>" width="100%" alt="<?= $g['gambar_stik_roda'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Kotak P3K:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_kotak_p3k'] ?>" width="100%" alt="<?= $g['gambar_kotak_p3k'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Warning Tirangel:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_warning_triangle'] ?>" width="100%" alt="<?= $g['gambar_warning_triangle'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Toolkit end -->
                                                <!-- Dokumen Start -->
                                                <h4 class="card-subtitle mb-3 mt-3" style="color:black;">Dokumen</h4>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar STNK:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_stnk'] ?>" width="100%" alt="<?= $g['gambar_stnk'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar KIR:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_kir'] ?>" width="100%" alt="<?= $g['gambar_kir'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Kartu Kir:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_kartu_kir'] ?>" width="100%" alt="<?= $g['gambar_kartu_kir'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar SIPA:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_sipa'] ?>" width="100%" alt="<?= $g['gambar_sipa'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="image-title-container">
                                                            <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar IBM:</strong>
                                                            <img src="./assets/gambar/<?= $g['gambar_ibm'] ?>" width="100%" alt="<?= $g['gambar_ibm'] ?>" style="border: 1px solid black;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Dokumen End -->
                                        <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
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


<?php include("template/dashboard/footer.php") ?>