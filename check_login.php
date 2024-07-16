<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['middleware'] = "Anda Tidak Memiliki Akses!.";
    header('Location: index.php');
    exit();
}
