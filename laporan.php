<?php
require_once 'function.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css" /> -->
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -ms-overflow-style: scrollbar;
            -webkit-tap-highlight-color: transparent;
        }

        @-ms-viewport {
            width: device-width;
        }

        article,
        aside,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section {
            display: block;
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
                "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }


        .modal-title {
            margin-bottom: 0;
            line-height: 1.5;
        }

        .modal-body {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1rem;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }

        .card-title {
            margin-bottom: 0.75rem;
        }

        .d-flex {
            display: -ms-flexbox !important;
            display: flex !important;
        }

        .mb-1,
        .my-1 {
            margin-bottom: 0.25rem !important;
        }

        .justify-content-between {
            -ms-flex-pack: justify !important;
            justify-content: space-between !important;
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: right;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge-success[href]:focus,
        .badge-success[href]:hover {
            color: #fff;
            text-decoration: none;
            background-color: #1e7e34;
        }

        .badge-warning {
            color: #212529;
            background-color: #ffc107;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .card-subtitle {
            margin-top: -0.375rem;
            margin-bottom: 0;
        }

        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }

        td {
            width: 100%;
        }

        td>span {
            text-align: right;
        }
    </style>

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="main-content">
                <?php
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $loop = mysqli_query($koneksi, "SELECT audit.id, kendaraan.nomor_plat, kendaraan.nama_pemilik, kendaraan.nomor_telp_pemilik, kendaraan.kota, kendaraan.model, kendaraan.tahun_pembuatan, kendaraan.bu, kendaraan.jenis_kendaraan, users.username AS auditor, audit.tanggal_audit
                                FROM audit
                                INNER JOIN kendaraan ON audit.id_kendaraan = kendaraan.id
                                INNER JOIN users ON audit.id_user = users.id
                                 WHERE audit.id = $id");
                $no = 1;
                while ($a = mysqli_fetch_array($loop)) { ?>
                    <div id="detail<?= $a['id'] ?>">
                        <div>
                            <div>
                                <div>
                                    <h2 class="modal-title">Detail Audit Kendaraan</h5>
                                </div>
                                <div class="modal-body">
                                    <p style="font-size: large;">Informasi Kendaraan</p>
                                    <ul>
                                        <li>Nomor Plat: <?= $a['nomor_plat'] ?></li>
                                        <li>Pemilik: <?= $a['nama_pemilik'] ?></li>
                                        <li>Telpon: <?= $a['nomor_telp_pemilik'] ?></li>
                                        <li>Jenis Kendaraan: <?= $a['jenis_kendaraan'] ?></li>
                                        <li>Kota: <?= $a['kota'] ?></li>
                                        <li>Model: <?= $a['model'] ?></li>
                                        <li>Tahun: <?= $a['tahun_pembuatan'] ?></li>
                                        <li>BU: <?= $a['bu'] ?></li>
                                    </ul>
                                    <p style="font-size: large;"><strong>Detail Audit</strong></p>
                                    <?php
                                    // Query untuk mengambil detail audit berdasarkan id_audit
                                    $query_detail = "SELECT * FROM detail_audit WHERE id_audit = " . $a['id'];
                                    $result_detail = mysqli_query($koneksi, $query_detail);

                                    if (mysqli_num_rows($result_detail) > 0) {
                                        while ($detail = mysqli_fetch_assoc($result_detail)) {
                                    ?>

                                            <table style="width: 100%;">
                                                <th style="width: 50%; ">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <h5 class="card-title" style="font-size:19px; ">Bagian Dalam Kendaraan</h5>
                                                            <div class="mb-3">
                                                                <table style="width: 100%; " border="0">
                                                                    <tr>
                                                                        <th style="text-align: left">Item</th>
                                                                        <th style="text-align: right">Status</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Stiker</td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['stiker'] == 'Ada') ? 'success' : (($detail['stiker'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['stiker']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Dashcam</td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['dashcam'] == 'Ada') ? 'success' : (($detail['dashcam'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['dashcam']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sunvisor</td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['sunvisor'] == 'Ada') ? 'success' : (($detail['sunvisor'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['sunvisor']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Klakson</td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['klakson'] == 'Ada') ? 'success' : (($detail['klakson'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['klakson']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Door Trim</td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['door_trim'] == 'Ada') ? 'success' : (($detail['door_trim'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['door_trim']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Jok</td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['jok'] == 'Bagus') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['jok']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Speaker</td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['speaker'] == 'Bagus') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['speaker']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Glovebox</td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['glovebox'] == 'Ada') ? 'success' : (($detail['glovebox'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['glovebox']); ?></span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </th>
                                                <th style="width: 50%;">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <h5 class="card-title" style="font-size:19px;">Bagian Luar Kendaraan</h5>
                                                            <div class="mb-3">
                                                                <table style="width: 100%;" border="0">

                                                                    <tr>
                                                                        <th style="text-align: left">Item</th>
                                                                        <th style="text-align: right">Status</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Cap Ban:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['cap_ban'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['cap_ban']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Body:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['body'] == 'Mulus') ? 'success' : (($detail['body'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['body']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Bemper Depan:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['bemper_depan'] == 'Mulus') ? 'success' : (($detail['bemper_depan'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['bemper_depan']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Bemper Belakang:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['bemper_belakang'] == 'Mulus') ? 'success' : (($detail['bemper_belakang'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['bemper_belakang']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Fender Depan:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['fender_depan'] == 'Mulus') ? 'success' : (($detail['fender_depan'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['fender_depan']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Fender Belakang:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['fender_belakang'] == 'Mulus') ? 'success' : (($detail['fender_belakang'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['fender_belakang']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Box:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['box'] == 'Mulus') ? 'success' : (($detail['box'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['box']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Headlamp:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['headlamp'] == 'Mulus') ? 'success' : (($detail['headlamp'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['headlamp']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Stoplamp:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['stoplamp'] == 'Mulus') ? 'success' : (($detail['stoplamp'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['stoplamp']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Kaca Depan:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['kaca_depan'] == 'Bagus') ? 'success' : (($detail['kaca_depan'] == 'Retak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['kaca_depan']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Spion:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['spion'] == 'Bagus') ? 'success' : (($detail['spion'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['spion']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Ban Depan:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['ban_depan'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ban_depan']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Ban Belakang:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['ban_belakang'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ban_belakang']); ?></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Ban Serep:</strong></td>
                                                                        <td style="text-align: right;"><span class="badge badge-<?php echo ($detail['ban_serep'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ban_serep']); ?></span></td>
                                                                    </tr>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>
                                            </table>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="width: 50%; vertical-align: top;">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Toolkit</h5>
                                                                <div class="mb-3">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td><strong>Dongkrak:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['dongkrak'] == 'Ada') ? 'success' : (($detail['dongkrak'] == 'Rusak') ? 'warning' : 'danger'); ?>">
                                                                                    <?php echo ucfirst($detail['dongkrak']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Kunci Roda:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['kunci_roda'] == 'Ada') ? 'success' : (($detail['kunci_roda'] == 'Rusak') ? 'warning' : 'danger'); ?>">
                                                                                    <?php echo ucfirst($detail['kunci_roda']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Stik Roda:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['stik_roda'] == 'Ada') ? 'success' : (($detail['stik_roda'] == 'Rusak') ? 'warning' : 'danger'); ?>">
                                                                                    <?php echo ucfirst($detail['stik_roda']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Kotak P3K:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['kotak_p3k'] == 'Ada') ? 'success' : 'danger'; ?>">
                                                                                    <?php echo ucfirst($detail['kotak_p3k']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Warning Tirangel:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['warning_tirangel'] == 'Ada') ? 'success' : 'danger'; ?>">
                                                                                    <?php echo ucfirst($detail['warning_tirangel']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 50%; vertical-align: top;">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Dokumen</h5>
                                                                <div class="mb-3">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td><strong>STNK:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['stnk'] == 'Ada') ? 'success' : 'danger'; ?>">
                                                                                    <?php echo ucfirst($detail['stnk']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>KIR:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['kir'] == 'Ada') ? 'success' : 'danger'; ?>">
                                                                                    <?php echo ucfirst($detail['kir']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Kartu KIR:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['kartu_kir'] == 'Ada') ? 'success' : 'danger'; ?>">
                                                                                    <?php echo ucfirst($detail['kartu_kir']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>SIPA:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['sipa'] == 'Ada') ? 'success' : 'danger'; ?>">
                                                                                    <?php echo ucfirst($detail['sipa']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>IBM:</strong></td>
                                                                            <td style="text-align: right;">
                                                                                <span class="badge badge-<?php echo ($detail['ibm'] == 'Ada') ? 'success' : 'danger'; ?>">
                                                                                    <?php echo ucfirst($detail['ibm']); ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>

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
                                                            <h4 class="card-subtitle mb-3 mt-3" style="color:black; font-size:17px">Bagian Dalam Kendaraan</h4>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color: black;"> Gambar Stiker:</strong>
                                                                                <img src="<?= $getImage($g['gambar_stiker']) ?>" width="100%" alt="<?= $g['gambar_stiker'] ?>" style="border: 1px solid black; margin-right: 20px;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color: black;"> Gambar Sunvisor:</strong>
                                                                                <img src="<?= $getImage($g['gambar_sunvisor']) ?>" width="100%" alt="<?= $g['gambar_sunvisor'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">

                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color: black;"> Gambar Dashcam:</strong>
                                                                                <img src="<?= $getImage($g['gambar_dashcam']) ?>" width="100%" alt="<?= $g['gambar_dashcam'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color: black;"> Gambar Klakson:</strong>
                                                                                <img src="<?= $getImage($g['gambar_klakson']) ?>" width="100%" alt="<?= $g['gambar_klakson'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Cap Ban:</strong>
                                                                                <img src="<?= $getImage($g['gambar_cap_ban']) ?>" width="100%" alt="<?= $g['gambar_cap_ban'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Jok:</strong>
                                                                                <img src="<?= $getImage($g['gambar_jok']) ?>" width="100%" alt="<?= $g['gambar_jok'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Speaker:</strong>
                                                                                <img src="<?= $getImage($g['gambar_speaker']) ?>" width="100%" alt="<?= $g['gambar_speaker'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Glovebox:</strong>
                                                                                <img src="<?= $getImage($g['gambar_glovebox']) ?>" width="100%" alt="<?= $g['gambar_glovebox'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>

                                                            <!-- Bagian Dalam Kendaraan End -->
                                                            <!-- Bagain Luar Kendaraan Start -->
                                                            <h4 class="card-subtitle mb-3 mt-3" style="color: black; font-size:17px">Bagian Luar Kendaraan</h4>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Cap Ban:</strong>
                                                                                <img src="<?= $getImage($g['gambar_cap_ban']) ?>" width="100%" alt="<?= $g['gambar_cap_ban'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Body:</strong>
                                                                                <img src="<?= $getImage($g['gambar_body']) ?>" width="100%" alt="<?= $g['gambar_body'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Bemper Depan:</strong>
                                                                                <img src="<?= $getImage($g['gambar_bemper_depan']) ?>" width="100%" alt="<?= $g['gambar_bemper_depan'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Bemper Belakang:</strong>
                                                                                <img src="<?= $getImage($g['gambar_bemper_belakang']) ?>" width="100%" alt="<?= $g['gambar_bemper_belakang'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Fender Depan:</strong>
                                                                                <img src="<?= $getImage($g['gambar_fender_depan']) ?>" width="100%" alt="<?= $g['gambar_fender_depan'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Fender Belakang:</strong>
                                                                                <img src="<?= $getImage($g['gambar_fender_belakang']) ?>" width="100%" alt="<?= $g['gambar_fender_belakang'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Box:</strong>
                                                                                <img src="<?= $getImage($g['gambar_box']) ?>" width="100%" alt="<?= $g['gambar_box'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Headlamp:</strong>
                                                                                <img src="<?= $getImage($g['gambar_headlamp']) ?>" width="100%" alt="<?= $g['gambar_headlamp'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Stoplamp:</strong>
                                                                                <img src="<?= $getImage($g['gambar_stoplamp']) ?>" width="100%" alt="<?= $g['gambar_stoplamp'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar kaca Depan:</strong>
                                                                                <img src="<?= $getImage($g['gambar_kaca_depan']) ?>" width="100%" alt="<?= $g['gambar_kaca_depan'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Spion:</strong>
                                                                                <img src="<?= $getImage($g['gambar_spion']) ?>" width="100%" alt="<?= $g['gambar_spion'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Ban Depan:</strong>
                                                                                <img src="<?= $getImage($g['gambar_ban_depan']) ?>" width="100%" alt="<?= $g['gambar_ban_depan'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Ban Belakang:</strong>
                                                                                <img src="<?= $getImage($g['gambar_ban_belakang']) ?>" width="100%" alt="<?= $g['gambar_ban_belakang'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Ban Serep:</strong>
                                                                                <img src="<?= $getImage($g['gambar_ban_serep']) ?>" width="100%" alt="<?= $g['gambar_ban_serep'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <!-- Bagian Luar Kendaraan End -->
                                                            <!-- Toolkit Start -->
                                                            <h4 class="card-subtitle mb-3" style="color:black; padding-top: 9%; font-size: 20px;">Toolkit</h4>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Dongkrak:</strong>
                                                                                <img src="<?= $getImage($g['gambar_dongkrak']) ?>" width="100%" alt="<?= $g['gambar_dongkrak'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Kunci Roda:</strong>
                                                                                <img src="<?= $getImage($g['gambar_kunci_roda']) ?>" width="100%" alt="<?= $g['gambar_kunci_roda'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Stik Roda:</strong>
                                                                                <img src="<?= $getImage($g['gambar_stik_roda']) ?>" width="100%" alt="<?= $g['gambar_stik_roda'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">

                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Kotak P3K:</strong>
                                                                                <img src="<?= $getImage($g['gambar_kotak_p3k']) ?>" width="100%" alt="<?= $g['gambar_kotak_p3k'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Warning Tirangel:</strong>
                                                                                <img src="<?= $getImage($g['gambar_warning_triangle']) ?>" width="100%" alt="<?= $g['gambar_warning_triangle'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> </strong>
                                                                                <img src="" width="100%" alt="" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <!-- Toolkit end -->
                                                            <!-- Dokumen Start -->
                                                            <h4 class="card-subtitle mb-3 mt-3" style="color:black; font-size: 20px;">Dokumen</h4>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar STNK:</strong>
                                                                                <img src="<?= $getImage($g['gambar_stnk']) ?>" width="100%" alt="<?= $g['gambar_stnk'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar KIR:</strong>
                                                                                <img src="<?= $getImage($g['gambar_kir']) ?>" width="100%" alt="<?= $g['gambar_kir'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar Kartu Kir:</strong>
                                                                                <img src="<?= $getImage($g['gambar_kartu_kir']) ?>" width="100%" alt="<?= $g['gambar_kartu_kir'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar SIPA:</strong>
                                                                                <img src="<?= $getImage($g['gambar_sipa']) ?>" width="100%" alt="<?= $g['gambar_sipa'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="row">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> Gambar IBM:</strong>
                                                                                <img src="<?= $getImage($g['gambar_ibm']) ?>" width="100%" alt="<?= $g['gambar_ibm'] ?>" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                        <td style="text-align: left;">
                                                                            <div class="image-title-container">
                                                                                <strong style="color:black;"> </strong>
                                                                                <img src="" width="100%" alt="Tidak_ada" style="border: 1px solid black;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                </div>
                                                <!-- Dokumen End -->
                                        <?php
                                                        }
                                                    }
                                        ?>

                                            </div>
                                </div>



                        <?php
                                        }
                                    } else {
                                        echo "<p>Tidak ada detail audit untuk kendaraan ini.</p>";
                                    }
                        ?>
                            </div>

                        </div>
                    </div>
            </div>
        <?php $no++;
                } ?>
        </div>
    </div>
    </div>


</body>

</html>