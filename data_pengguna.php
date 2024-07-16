<?php
require_once 'function.php';
require_once 'check_login.php';

$title = "Data Pengguna";
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
            <h1>Data Pengguna</h1>
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

                        <div class="card-header justify-content-between">
                            <h4>Table</h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $loop = mysqli_query($koneksi, "select * from users");
                                        $no = 1;
                                        while ($a = mysqli_fetch_array($loop)) { ?>
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td><?= $a['username'] ?></td>
                                                <td><?= $a['role'] ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $a['id'] ?>">Edit</button>
                                                    <a href="function.php?hapusPengguna=<?= $a['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
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
                    <h5 class="modal-title">Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group w-100">
                            <label>Role</label>
                            <select style="width: 100%;" class="form-control select2" name="role" id="role" required>
                                <option value="admin">Admin</option>
                                <option value="auditor">Auditor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" name="tambahPengguna" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    $loop = mysqli_query($koneksi, "select * from users");
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
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="<?= $a['username'] ?>" id="username" required>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select style="width: 100%;" class="form-control select2" name="role" id="role" required>
                                    <option value="admin" <?php if ($a['role'] == 'admin') echo 'selected'  ?>>Admin</option>
                                    <option value="auditor" <?php if ($a['role'] == 'auditor') echo 'selected'  ?>>Auditor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                            <button type="submit" name="editPengguna" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php $no++;
    } ?>
</div>


<?php include("template/dashboard/footer.php") ?>