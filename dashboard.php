<?php
require_once 'function.php';
require_once 'check_login.php';

$title = "Dashboard";
include("template/dashboard/header.php");
include("template/dashboard/navbar.php");
include("template/dashboard/sidebar.php");

$totalSudahAudit = getTotalAudit($koneksi);
$totalBelumAudit = getTotalBelumAudit($koneksi);
$totalTemuan = getTotalTemuan($koneksi);
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <?php if (checkRole('admin')) : ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <a href="data_pengguna.php">
                                    <div class="card-header">
                                        <h4>Total Auditor</h4>
                                    </div>
                                    <div class="card-body">
                                        <?= $totalAuditor ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="data_kendaraan.php">
                                <div class="card-header">
                                    <h4>Total Kendaraan</h4>
                                </div>
                                <div class="card-body">
                                    <?= $totalKendaraan ?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="riwayat_audit.php">
                                <div class="card-header">
                                    <h4>Total Audit Kendaraan</h4>
                                </div>
                                <div class="card-body">
                                    <?= $totalRiwayatAudit ?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="riwayat_audit.php">
                                <div class="card-header">
                                    <h4>Total Sudah Audit</h4>
                                </div>
                                <div class="card-body">
                                    <?= $totalSudahAudit ?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="data_kendaraan.php">
                                <div class="card-header">
                                    <h4>Total Belum Audit</h4>
                                </div>
                                <div class="card-body">
                                    <?= $totalBelumAudit ?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="riwayat_audit.php">
                                <div class="card-header">
                                    <h4>Total Temuan Audit</h4>
                                </div>
                                <div class="card-body">
                                    <?= $totalTemuan ?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
    </section>
</div>


<?php include("template/dashboard/footer.php") ?>