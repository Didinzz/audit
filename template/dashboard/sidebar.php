<?php
function isActive($page)
{
    return basename($_SERVER['PHP_SELF']) == $page ? 'active' : '';
}

function checkRole($role)
{
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

?>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard.php">Audit Kendaraan</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard.php">AD</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?php echo isActive('dashboard.php'); ?>">
                <a class="nav-link" href="dashboard.php"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>

            <?php if (checkRole('admin')) : ?>
                <li class="menu-header">Manajemen Data Kendaraan</li>
                <li class="dropdown <?php echo isActive('data_kendaraan.php') . ' ' . isActive('passenger.php') . ' ' . isActive('niaga.php') . ' ' . isActive('motor.php'); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Data Kendaraan</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo isActive('data_kendaraan.php'); ?>">
                            <a class="nav-link" href="data_kendaraan.php">Tambah Data Kendaraan</a>
                        </li>
                        <li class="<?php echo isActive('passenger.php'); ?>">
                            <a class="nav-link" href="passenger.php">Passenger</a>
                        </li>
                        <li class="<?php echo isActive('niaga.php'); ?>">
                            <a class="nav-link" href="niaga.php">Niaga</a>
                        </li>
                        <li class="<?php echo isActive('motor.php'); ?>">
                            <a class="nav-link" href="motor.php">Motor</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <li class="menu-header">Audit</li>
            <li class="<?php echo isActive('formulir_audit.php'); ?>">
                <a class="nav-link" href="formulir_audit.php"><i class="far fa-file-alt"></i> <span>Formulir Audit</span></a>
            </li>
            <li class="<?php echo isActive('riwayat_audit.php'); ?>">
                <a class="nav-link" href="riwayat_audit.php"><i class="far fa-file-alt"></i> <span>Riwayat Audit</span></a>
            </li>


            <?php if (checkRole('admin')) : ?>
                <li class="menu-header">Hak Akses</li>
                <li class="<?php echo isActive('data_pengguna.php'); ?>">
                    <a class="nav-link" href="data_pengguna.php"><i class="far fa-user"></i> <span>Data Pengguna</span></a>
                </li>
            <?php endif; ?>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="logout.php" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Logout
            </a>
        </div>
    </aside>
</div>