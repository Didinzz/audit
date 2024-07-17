<?php
require_once 'function.php';
require_once 'check_login.php';
$idEdit = isset($_GET['id']) ? intval($_GET['id']) : 0;

$title = "Edit Audit";
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
            <h1>Edit Audit</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-lg-12">
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

                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_edit" value="<?= $idEdit ?>">
                                <input type="hidden" name="id_user" value="<?= isset($_SESSION['id']) ? $_SESSION['id'] : null ?>">
                                <div class="form-group w-100">
                                    <label>Pilih Kendaraan</label>
                                    <select class="form-control select2" name="id_kendaraan" id="selectKendaraan" required>
                                        <option selected disabled>Silahkan Pilih</option>
                                        <?php
                                        $idAudit = mysqli_real_escape_string($koneksi, $idEdit);
                                        $queryAudit = mysqli_query($koneksi, "SELECT * FROM audit WHERE id = $idAudit");
                                        $dataAudit = mysqli_fetch_assoc($queryAudit);
                                        $selectedKendaraan = $dataAudit['id_kendaraan'];
                                        $loop = mysqli_query($koneksi, "SELECT * FROM kendaraan");
                                        $no = 1;
                                        while ($a = mysqli_fetch_array($loop)) {
                                            $selected = ($a['id'] == $selectedKendaraan) ? 'selected' : ''; ?>
                                            ?>
                                            <option value="<?= $a['id'] ?>" data-plat="<?= $a['nomor_plat'] ?>" data-jenis="<?= $a['jenis_kendaraan'] ?>" data-tahun="<?= $a['tahun_pembuatan'] ?>" <?= $selected ?>>
                                                <?= $a['nomor_plat'] ?> - <?= $a['jenis_kendaraan'] ?> - <?= $a['tahun_pembuatan'] ?>
                                            </option>
                                        <?php $no++;
                                        } ?>

                                    </select>
                                </div>
                                <div>
                                    <h6>Detail Kendaraan</h6>
                                    <ul>
                                        <li>Nomor Polisi: <span id="detail_nomor_plat">-</span></li>
                                        <li>Pemakai: <span id="detail_nama_pemilik">-</span></li>
                                        <li>Telpon: <span id="detail_nomor_telfon">-</span></li>
                                        <li>Jenis Kendaraan: <span id="detail_jenis_kendaraan">-</span></li>
                                        <li>Kota: <span id="detail_kota">-</span></li>
                                        <li>Model: <span id="detail_model">-</span></li>
                                        <li>Tahun Pembuatan: <span id="detail_tahun_pembuatan">-</span></li>
                                        <li>BU: <span id="detail_bu">-</span></li>
                                    </ul>
                                </div>
                                <?php
                                $queryGetDetailAudit = mysqli_query($koneksi, "SELECT * FROM detail_audit WHERE id_audit = $idAudit");
                                $detail = mysqli_fetch_assoc($queryGetDetailAudit);

                                // select item
                                $capBan = $detail['cap_ban'];
                                $stiker = $detail['stiker'];
                                $dashcam = $detail['dashcam'];
                                $sunvisor = $detail['sunvisor'];
                                $klakson = $detail['klakson'];
                                $door_trim = $detail['door_trim'];
                                $jok = $detail['jok'];
                                $speaker = $detail['speaker'];
                                $glovebox = $detail['glovebox'];
                                $body = $detail['body'];
                                $bemper_depan = $detail['bemper_depan'];
                                $bemper_belakang = $detail['bemper_belakang'];
                                $fender_depan = $detail['fender_depan'];
                                $fender_belakang = $detail['fender_belakang'];
                                $box = $detail['box'];
                                $headlamp = $detail['headlamp'];
                                $stoplamp = $detail['stoplamp'];
                                $kaca_depan = $detail['kaca_depan'];
                                $spion = $detail['spion'];
                                $ban_depan = $detail['ban_depan'];
                                $ban_belakang = $detail['ban_belakang'];
                                $ban_serep = $detail['ban_serep'];
                                $dongkrak = $detail['dongkrak'];
                                $kunci_roda = $detail['kunci_roda'];
                                $stik_roda = $detail['stik_roda'];
                                $kotak_p3k = $detail['kotak_p3k'];
                                $warning_tirangel = $detail['warning_tirangel'];
                                $stnk = $detail['stnk'];
                                $kir = $detail['kir'];
                                $kartu_kir = $detail['kartu_kir'];
                                $sipa = $detail['sipa'];
                                $ibm = $detail['ibm'];
                                $status_temuan = $detail['status_temuan'];
                                $temuan = $detail['temuan'];
                                ?>

                                <div class="form-group w-100">
                                    <label>Cap Ban</label>
                                    <select class="form-control select2" name="cap_ban" id="cap_ban" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $capBan == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $capBan == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Cap Ban</label>
                                    <input type="file" class="form-control-file" id="gambar_cap_ban" name="gambar_cap_ban">
                                </div>

                                <div class="form-group w-100">
                                    <label>Stiker</label>
                                    <select class="form-control select2" name="stiker" id="stiker" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $stiker == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $stiker == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $stiker == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Stiker</label>
                                    <input type="file" class="form-control-file" id="gambar_stiker" name="gambar_stiker">
                                </div>

                                <div class="form-group w-100">
                                    <label>Dashcam</label>
                                    <select class="form-control select2" name="dashcam" id="dashcam" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $dashcam == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $dashcam == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $dashcam == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Dashcam </label>
                                    <input type="file" class="form-control-file" id="gambar_dashcam" name="gambar_dashcam">
                                </div>

                                <div class="form-group w-100">
                                    <label>Sunvisor</label>
                                    <select class="form-control select2" name="sunvisor" id="sunvisor" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $sunvisor == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $sunvisor == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $sunvisor == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Sunvisor </label>
                                    <input type="file" class="form-control-file" id="gambar_sunvisor" name="gambar_sunvisor">
                                </div>

                                <div class="form-group w-100">
                                    <label>Klakson</label>
                                    <select class="form-control select2" name="klakson" id="klakson" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $klakson == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $klakson == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $klakson == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Klakson</label>
                                    <input type="file" class="form-control-file" id="gambar_klakson" name="gambar_klakson">
                                </div>

                                <div class="form-group w-100">
                                    <label>Door Trim</label>
                                    <select class="form-control select2" name="door_trim" id="door_trim" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $door_trim == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $door_trim == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $door_trim == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Door Trim</label>
                                    <input type="file" class="form-control-file" id="gambar_door_trim" name="gambar_door_trim">
                                </div>

                                <div class="form-group w-100">
                                    <label>Jok</label>
                                    <select class="form-control select2" name="jok" id="jok" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Bagus" <?= $jok == "Bagus" ? "selected" : "" ?>>Bagus</option>
                                        <option value="Rusak" <?= $jok == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Jok </label>
                                    <input type="file" class="form-control-file" id="" name="gambar_jok">
                                </div>

                                <div class="form-group w-100">
                                    <label>Speaker</label>
                                    <select class="form-control select2" name="speaker" id="speaker" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Bagus" <?= $speaker == "Bagus" ? "selected" : "" ?>>Bagus</option>
                                        <option value="Rusak" <?= $speaker == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Speaker</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_speaker">
                                </div>

                                <div class="form-group w-100">
                                    <label>Glovebox</label>
                                    <select class="form-control select2" name="glovebox" id="glovebox" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $glovebox == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $glovebox == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $glovebox == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Glovebox</label>
                                    <input type="file" class="form-control-file" id="gambar_glovebox" name="gambar_glovebox">
                                </div>

                                <div class="form-group w-100">
                                    <label>Body</label>
                                    <select class="form-control select2" name="body" id="body" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Mulus" <?= $body == "Mulus" ? "selected" : "" ?>>Mulus</option>
                                        <option value="Baret" <?= $body == "Baret" ? "selected" : "" ?>>Baret</option>
                                        <option value="Penyok" <?= $body == "Penyok" ? "selected" : "" ?>>Penyok</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Body</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_body">
                                </div>

                                <div class="form-group w-100">
                                    <label>Bemper Depan</label>
                                    <select class="form-control select2" name="bemper_depan" id="bemper_depan" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Mulus" <?= $bemper_depan == "Mulus" ? "selected" : "" ?>>Mulus</option>
                                        <option value="Baret" <?= $bemper_depan == "Baret" ? "selected" : "" ?>>Baret</option>
                                        <option value="Penyok" <?= $bemper_depan == "Penyok" ? "selected" : "" ?>>Penyok</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Bamper Depan</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_bemper_depan">
                                </div>

                                <div class="form-group w-100">
                                    <label>Bemper Belakang</label>
                                    <select class="form-control select2" name="bemper_belakang" id="bemper_belakang" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Mulus" <?= $bemper_belakang == "Mulus" ? "selected" : "" ?>>Mulus</option>
                                        <option value="Baret" <?= $bemper_belakang == "Baret" ? "selected" : "" ?>>Baret</option>
                                        <option value="Penyok" <?= $bemper_belakang == "Penyok" ? "selected" : "" ?>>Penyok</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Bamper Belakang</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_bemper_belakang">
                                </div>

                                <div class="form-group w-100">
                                    <label>Fender Depan</label>
                                    <select class="form-control select2" name="fender_depan" id="fender_depan" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Mulus" <?= $fender_depan == "Mulus" ? "selected" : "" ?>>Mulus</option>
                                        <option value="Baret" <?= $fender_depan == "Baret" ? "selected" : "" ?>>Baret</option>
                                        <option value="Penyok" <?= $fender_depan == "Penyok" ? "selected" : "" ?>>Penyok</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Fender Depan</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_fender_depan">
                                </div>

                                <div class="form-group w-100">
                                    <label>Fender Belakang</label>
                                    <select class="form-control select2" name="fender_belakang" id="fender_belakang" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Mulus" <?= $fender_belakang == "Mulus" ? "selected" : "" ?>>Mulus</option>
                                        <option value="Baret" <?= $fender_belakang == "Baret" ? "selected" : "" ?>>Baret</option>
                                        <option value="Penyok" <?= $fender_belakang == "Penyok" ? "selected" : "" ?>>Penyok</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Fender Belakang</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_fender_belakang">
                                </div>

                                <div class="form-group w-100">
                                    <label>Box</label>
                                    <select class="form-control select2" name="box" id="box" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Mulus" <?= $box == "Mulus" ? "selected" : "" ?>>Mulus</option>
                                        <option value="Baret" <?= $box == "Baret" ? "selected" : "" ?>>Baret</option>
                                        <option value="Penyok" <?= $box == "Penyok" ? "selected" : "" ?>>Penyok</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Box</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_box">
                                </div>

                                <div class="form-group w-100">
                                    <label>Headlamp</label>
                                    <select class="form-control select2" name="headlamp" id="headlamp" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Mulus" <?= $headlamp == "Mulus" ? "selected" : "" ?>>Mulus</option>
                                        <option value="Baret" <?= $headlamp == "Baret" ? "selected" : "" ?>>Baret</option>
                                        <option value="Penyok" <?= $headlamp == "Penyok" ? "selected" : "" ?>>Penyok</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Headlamp</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_headlamp">
                                </div>

                                <div class="form-group w-100">
                                    <label>Stoplamp</label>
                                    <select class="form-control select2" name="stoplamp" id="stoplamp" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Mulus" <?= $stoplamp == "Mulus" ? "selected" : "" ?>>Mulus</option>
                                        <option value="Baret" <?= $stoplamp == "Baret" ? "selected" : "" ?>>Baret</option>
                                        <option value="Penyok" <?= $stoplamp == "Penyok" ? "selected" : "" ?>>Penyok</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Stoplamp</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_stoplamp">
                                </div>

                                <div class="form-group w-100">
                                    <label>Kaca Depan</label>
                                    <select class="form-control select2" name="kaca_depan" id="kaca_depan" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Bagus" <?= $kaca_depan == "Bagus" ? "selected" : "" ?>>Bagus</option>
                                        <option value="Retak" <?= $kaca_depan == "Retak" ? "selected" : "" ?>>Retak</option>
                                        <option value="Pecah" <?= $kaca_depan == "Pecah" ? "selected" : "" ?>>Pecah</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Kaca Depan</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_kaca_depan">
                                </div>

                                <div class="form-group w-100">
                                    <label>Spion</label>
                                    <select class="form-control select2" name="spion" id="spion" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Bagus" <?= $spion == "Bagus" ? "selected" : "" ?>>Bagus</option>
                                        <option value="Baret" <?= $spion == "Baret" ? "selected" : "" ?>>Baret</option>
                                        <option value="Pecah" <?= $spion == "Pecah" ? "selected" : "" ?>>Pecah</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Spion</label>
                                    <input type="file" class="form-control-file" id="" name="gambar_spion">
                                </div>

                                <div class="form-group w-100">
                                    <label>Ban Depan</label>
                                    <select class="form-control select2" name="ban_depan" id="ban_depan" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $ban_depan == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $ban_depan == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Ban Depan</label>
                                    <input type="file" class="form-control-file" id="gambar_ban_depan" name="gambar_ban_depan">
                                </div>

                                <div class="form-group w-100">
                                    <label>Ban Belakang</label>
                                    <select class="form-control select2" name="ban_belakang" id="ban_belakang" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $ban_belakang == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $ban_belakang == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar_ban_belakang">Upload Gambar Ban Belakang</label>
                                    <input type="file" class="form-control-file" id="gambar_ban_belakang" name="gambar_ban_belakang">
                                </div>

                                <div class="form-group w-100">
                                    <label>Ban Serep</label>
                                    <select class="form-control select2" name="ban_serep" id="ban_serep" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $ban_serep == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $ban_serep == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar_ban_serep">Upload Gambar Ban Serep</label>
                                    <input type="file" class="form-control-file" id="gambar_ban_serep" name="gambar_ban_serep">
                                </div>

                                <div class="form-group w-100">
                                    <label>Dongkrak</label>
                                    <select class="form-control select2" name="dongkrak" id="dongkrak" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $dongkrak == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $dongkrak == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $dongkrak == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Dongkrak</label>
                                    <input type="file" class="form-control-file" id="gambar_dongkrak" name="gambar_dongkrak">
                                </div>

                                <div class="form-group w-100">
                                    <label>Kunci Roda</label>
                                    <select class="form-control select2" name="kunci_roda" id="kunci_roda" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $kunci_roda == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $kunci_roda == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $kunci_roda == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Kunci roda</label>
                                    <input type="file" class="form-control-file" id="gambar_kunci_roda" name="gambar_kunci_roda">
                                </div>

                                <div class="form-group w-100">
                                    <label>Stik Roda</label>
                                    <select class="form-control select2" name="stik_roda" id="stik_roda" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $stik_roda == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $stik_roda == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $stik_roda == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Stik Roda</label>
                                    <input type="file" class="form-control-file" id="gambar_stik_roda" name="gambar_stik_roda">
                                </div>

                                <div class="form-group w-100">
                                    <label>Kotak P3K</label>
                                    <select class="form-control select2" name="kotak_p3k" id="kotak_p3k" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $kotak_p3k == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $kotak_p3k == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Habis" <?= $kotak_p3k == "Habis" ? "selected" : "" ?>>Habis</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Kotak P3K</label>
                                    <input type="file" class="form-control-file" id="gambar_kotak_p3k" name="gambar_kotak_p3k">
                                </div>

                                <div class="form-group w-100">
                                    <label>Warning Triangle</label>
                                    <select class="form-control select2" name="warning_tirangel" id="warning_tirangel" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $warning_tirangel == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $warning_tirangel == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                        <option value="Rusak" <?= $warning_tirangel == "Rusak" ? "selected" : "" ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Warning Triangle</label>
                                    <input type="file" class="form-control-file" id="gambar_warning_tirangel" name="gambar_warning_triangle">
                                </div>

                                <div class="form-group w-100">
                                    <label>STNK</label>
                                    <select class="form-control select2" name="stnk" id="stnk" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $stnk == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $stnk == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar STNK</label>
                                    <input type="file" class="form-control-file" id="gambar_stnk" name="gambar_stnk">
                                </div>

                                <div class="form-group w-100">
                                    <label>KIR</label>
                                    <select class="form-control select2" name="kir" id="kir" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $kir == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $kir == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar KIR</label>
                                    <input type="file" class="form-control-file" id="gambar_kir" name="gambar_kir">
                                </div>

                                <div class="form-group w-100">
                                    <label>Kartu KIR</label>
                                    <select class="form-control select2" name="kartu_kir" id="kartu_kir" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $kartu_kir == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $kartu_kir == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Kartu KIR</label>
                                    <input type="file" class="form-control-file" id="gambar_kartu_kir" name="gambar_kartu_kir">
                                </div>

                                <div class="form-group w-100">
                                    <label>SIPA</label>
                                    <select class="form-control select2" name="sipa" id="sipa" required>
                                        <option value="" disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $sipa == " Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $sipa == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar Sipa</label>
                                    <input type="file" class="form-control-file" id="gambar_sipa" name="gambar_sipa">
                                </div>

                                <div class="form-group w-100">
                                    <label>IBM</label>
                                    <select class="form-control select2" name="ibm" id="ibm" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Ada" <?= $ibm == "Ada" ? "selected" : "" ?>>Ada</option>
                                        <option value="Tidak Ada" <?= $ibm == "Tidak Ada" ? "selected" : "" ?>>Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="form-group w-100 gambarInput" style="display: block;">
                                    <label for="gambar">Upload Gambar IBM</label>
                                    <input type="file" class="form-control-file" id="gambar_ibm" name="gambar_ibm">
                                </div>
                                <div class="form-group w-100">
                                    <label>Status Temuan</label>
                                    <select class="form-control select2" name="status_temuan" id="ibm" required>
                                        <option value="" selected disabled>Silahkan Pilih</option>
                                        <option value="Open" <?= $status_temuan == "Open" ? "selected" : "" ?>>Open</option>
                                        <option value="Close" <?= $status_temuan == "Close" ? "selected" : "" ?>>Close</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Temuan</label>
                                    <textarea class="form-control" name="temuan" id="temuan" rows="4" cols="50"> <?= $temuan ?></textarea>
                                </div>
                                <button class="btn btn-primary w-100" name="editAudit" type="submit">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        $('#selectKendaraan').change(function() {
            var idKendaraan = $(this).val();

            if (idKendaraan) {
                $.ajax({
                    url: 'get_kendaraan_details.php',
                    type: 'GET',
                    data: {
                        id: idKendaraan
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#detail_nama_pemilik').text(response.nama_pemilik);
                        $('#detail_nomor_telfon').text(response.nomor_telp_pemilik);
                        $('#detail_nomor_plat').text(response.nomor_plat);
                        $('#detail_jenis_kendaraan').text(response.jenis_kendaraan);
                        $('#detail_kota').text(response.kota);
                        $('#detail_model').text(response.model);
                        $('#detail_tahun_pembuatan').text(response.tahun_pembuatan);
                        $('#detail_bu').text(response.bu);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#detail_nama_pemilik').text('-');
                $('#detail_nomor_telfon').text('-');
                $('#detail_nomor_plat').text('-');
                $('#detail_jenis_kendaraan').text('-');
                $('#detail_kota').text('-');
                $('#detail_model').text('-');
                $('#detail_tahun_pembuatan').text('-');
                $('#detail_kriteria').text('-');
            }
        });

        $('#selectKendaraan').trigger('change');
    });
</script>



<?php include("template/dashboard/footer.php") ?>