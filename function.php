<?php

$koneksi = mysqli_connect("localhost", "root", "", "audit_kendaraan");

session_start();

function validate_input($input)
{
    global $koneksi;
    $input = mysqli_real_escape_string($koneksi, $input);
    $input = htmlspecialchars($input);
    return $input;
}

//Auth
if (isset($_POST['login'])) {

    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);

    $cekuser = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    $hitung = mysqli_num_rows($cekuser);

    if ($hitung > 0) {
        $ambilData = mysqli_fetch_array($cekuser);
        $hashed_password = $ambilData['password'];

        if (password_verify($password, $hashed_password)) {
            // $name = $ambilData['name'];
            $id = $ambilData['id'];
            $username = $ambilData['username'];
            $role = $ambilData['role'];

            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header('location: dashboard.php');
            exit;
        } else {
            $_SESSION['error_message'] = "Password salah.";
            header('location: index.php');
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Username tidak ditemukan.";
        header('location: index.php');
        exit;
    }
}

if (isset($_POST['register'])) {
    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0) {
        $_SESSION['error_message'] = "Username sudah digunakan. Silakan pilih username lain.";
    } else {
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'admin')";
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['success_message'] = "Registrasi berhasil. Silakan login dengan username dan password Anda.";
            header('location: index.php');
            exit;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
            header('location: register.php');
            exit;
        }
    }
}
//End Auth

//Data Kedaraan
if (isset($_POST['tambahKendaraan'])) {
    $nama_pemilik = validate_input($_POST['namaPemilik']);
    $nomor_telp = validate_input($_POST['nomorPemilik']);
    $no_plat = validate_input($_POST['no_plat']);
    $jenis_kendaraan = validate_input($_POST['jenis_kendaraan']);
    $kota = validate_input($_POST['kota']);
    $model = validate_input($_POST['model']);
    $tahun = validate_input($_POST['tahun']);
    $bu = validate_input($_POST['bu']);

    $result = mysqli_query($koneksi, "INSERT INTO kendaraan (nama_pemilik, nomor_telp_pemilik,nomor_plat, jenis_kendaraan, kota, model, tahun_pembuatan, bu) VALUES ('$nama_pemilik','$nomor_telp','$no_plat','$jenis_kendaraan','$kota','$model','$tahun', '$bu')");

    if ($result) {
        $_SESSION['success_message'] = "Berhasil Menambahkan Data Kendaraan!";
        header("Location: data_kendaraan.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Gagal Menambahkan Data Kendaraan!";
        header("Location: data_kendaraan.php");
        exit;
    }
}

if (isset($_POST['editKendaraan'])) {
    $id = validate_input($_POST['id']);
    $nama_pemilik = validate_input($_POST['namaPemilik']);
    $nomor_telp = validate_input($_POST['nomorPemilik']);
    $no_plat = validate_input($_POST['no_plat']);
    $jenis_kendaraan = validate_input($_POST['jenis_kendaraan']);
    $kota = validate_input($_POST['kota']);
    $model = validate_input($_POST['model']);
    $tahun = validate_input($_POST['tahun']);
    $bu = validate_input($_POST['bu']);

    $result = "UPDATE kendaraan SET nama_pemilik='$nama_pemilik', nomor_telp_pemilik='$nomor_telp', nomor_plat='$no_plat', jenis_kendaraan='$jenis_kendaraan', kota= '$kota', model= '$model', tahun_pembuatan= '$tahun',  bu= '$bu' WHERE id = '$id'";
    $sql = mysqli_query($koneksi, $result);

    if ($sql) {
        $_SESSION['success_message'] = "Berhasil Mengubah Data Kendaraan!";
        header("Location: data_kendaraan.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Gagal Mengubah Data Kendaraan!";
        header("Location: data_kendaraan.php");
        exit;
    }
}

if (isset($_GET['hapusKendaraan'])) {
    $id = $_GET['hapusKendaraan'];
    $query = "DELETE FROM kendaraan WHERE id = '$id'";
    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        $_SESSION['success_message'] = "Berhasil Menghapus Data Kendaraan!";
        header("Location: data_kendaraan.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Gagal Menghapus Data Kendaraan!";
        header("Location: data_kendaraan.php");
        exit;
    }
}
//End Data Kedaraan

// Data Pengguna
if (isset($_POST['tambahPengguna'])) {
    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);
    $role = validate_input($_POST['role']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0) {
        $_SESSION['error_message'] = "Username sudah digunakan. Silakan pilih username lain.";
    } else {
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['success_message'] = "Berhasil Tambah Pengguna!";
            header('location: data_pengguna.php');
            exit;
        } else {
            $_SESSION['error_message'] = "Gagal Tambah Pengguna!";
            header('location: data_pengguna.php');
            exit;
        }
    }
}

if (isset($_POST['editPengguna'])) {
    $id = validate_input($_POST['id']);
    $username = validate_input($_POST['username']);
    $role = validate_input($_POST['role']);
    $password = validate_input($_POST['password']);

    if (empty($password)) {
        $query = "SELECT password FROM users WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $password = $row['password'];
        } else {
            $_SESSION['error_message'] = "Pengguna tidak ditemukan!";
            header("Location: data_pengguna.php");
            exit;
        }
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    $result = "UPDATE users SET username='$username', password='$password', role= '$role' WHERE id = '$id'";
    $sql = mysqli_query($koneksi, $result);

    if ($sql) {
        $_SESSION['success_message'] = "Berhasil Mengubah Data Pengguna!";
        header("Location: data_pengguna.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Gagal Mengubah Data Pengguna!";
        header("Location: data_pengguna.php");
        exit;
    }
}

if (isset($_GET['hapusPengguna'])) {
    $id = $_GET['hapusPengguna'];
    $query = "DELETE FROM users WHERE id = '$id'";
    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        $_SESSION['success_message'] = "Berhasil Menghapus Data Pengguna!";
        header("Location: data_pengguna.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Gagal Menghapus Data Pengguna!";
        header("Location: data_pengguna.php");
        exit;
    }
}
// End Data Pengguna

// Formulir
if (isset($_POST['kirimFormulir'])) {
    $id_user  = validate_input($_POST['id_user']);
    if ($id_user != null || $id_user != "") {
        $id_kendaraan = validate_input($_POST['id_kendaraan']);
        $tanggal_audit = date('Y-m-d');

        $query = "INSERT INTO audit (id_kendaraan, id_user, tanggal_audit) VALUES ('$id_kendaraan','$id_user','$tanggal_audit')";
        $result_audit = mysqli_query($koneksi, $query);

        if ($result_audit) {
            $id_audit = mysqli_insert_id($koneksi);

            $cap_ban = validate_input($_POST['cap_ban']);
            $stiker = validate_input($_POST['stiker']);
            $dashcam = validate_input($_POST['dashcam']);
            $sunvisor = validate_input($_POST['sunvisor']);
            $klakson = validate_input($_POST['klakson']);
            $door_trim = validate_input($_POST['door_trim']);
            $jok = validate_input($_POST['jok']);
            $speaker = validate_input($_POST['speaker']);
            $glovebox = validate_input($_POST['glovebox']);
            $body = validate_input($_POST['body']);
            $bemper_depan = validate_input($_POST['bemper_depan']);
            $bemper_belakang = validate_input($_POST['bemper_belakang']);
            $fender_depan = validate_input($_POST['fender_depan']);
            $fender_belakang = validate_input($_POST['fender_belakang']);
            $box = validate_input($_POST['box']);
            $headlamp = validate_input($_POST['headlamp']);
            $stoplamp = validate_input($_POST['stoplamp']);
            $kaca_depan = validate_input($_POST['kaca_depan']);
            $spion = validate_input($_POST['spion']);
            $ban_depan = validate_input($_POST['ban_depan']);
            $ban_belakang = validate_input($_POST['ban_belakang']);
            $ban_serep = validate_input($_POST['ban_serep']);
            $dongkrak = validate_input($_POST['dongkrak']);
            $kunci_roda = validate_input($_POST['kunci_roda']);
            $stik_roda = validate_input($_POST['stik_roda']);
            $kotak_p3k = validate_input($_POST['kotak_p3k']);
            $warning_tirangel = validate_input($_POST['warning_tirangel']);
            $stnk = validate_input($_POST['stnk']);
            $kir = validate_input($_POST['kir']);
            $kartu_kir = validate_input($_POST['kartu_kir']);
            $sipa = validate_input($_POST['sipa']);
            $ibm = validate_input($_POST['ibm']);
            $temuan = validate_input($_POST['temuan']);

            $query_detail = "INSERT INTO detail_audit (
                id_audit, cap_ban, stiker, dashcam, sunvisor, klakson, door_trim, jok, speaker, glovebox, body, bemper_depan, bemper_belakang,
                fender_depan, fender_belakang, box, headlamp, stoplamp, kaca_depan, spion, ban_depan, ban_belakang, ban_serep, dongkrak,
                kunci_roda, stik_roda, kotak_p3k, warning_tirangel, stnk, kir, kartu_kir, sipa, ibm, temuan
            ) VALUES (
                '$id_audit', '$cap_ban', '$stiker', '$dashcam', '$sunvisor', '$klakson', '$door_trim', '$jok', '$speaker', '$glovebox', '$body', '$bemper_depan', '$bemper_belakang',
                '$fender_depan', '$fender_belakang', '$box', '$headlamp', '$stoplamp', '$kaca_depan', '$spion', '$ban_depan', '$ban_belakang', '$ban_serep', '$dongkrak',
                '$kunci_roda', '$stik_roda', '$kotak_p3k', '$warning_tirangel', '$stnk', '$kir', '$kartu_kir', '$sipa', '$ibm', '$temuan'
            )";

            $result_detail = mysqli_query($koneksi, $query_detail);

            if ($result_detail) {
                $id_detail_audit = mysqli_insert_id($koneksi);

                function uploadImage($nameInput)
                {
                    $namaGambar = '';

                    if (isset($_FILES[$nameInput]) && $_FILES[$nameInput]['name'] != "") {
                        $name = $_FILES[$nameInput]['name'];
                        $tmp_name = $_FILES[$nameInput]['tmp_name'];
                        $timestamp = time();

                        $namaGambar = $timestamp . '_' . $name;
                        $dir = './assets/gambar';

                        if (!is_dir($dir)) {
                            mkdir($dir, 0777, true);
                        }

                        if (move_uploaded_file($tmp_name, $dir . '/' . $namaGambar)) {
                            echo "File berhasil diunggah: " . $namaGambar . "<br>";
                        } else {
                            echo "Gagal mengunggah file " . $namaGambar . "<br>";
                        }
                    } else {
                        echo "File tidak ditemukan atau tidak diunggah untuk input: " . $nameInput . "<br>";
                        $namaGambar = 'kosong';
                        return $namaGambar;
                    }

                    return $namaGambar;
                }

                $cap_ban = uploadImage('gambar_cap_ban');
                $stiker = uploadImage('gambar_stiker');
                $dashcam = uploadImage('gambar_dashcam');
                $sunvisor = uploadImage('gambar_sunvisor');
                $klakson = uploadImage('gambar_klakson');
                $door_trim = uploadImage('gambar_door_trim');
                $jok = uploadImage('gambar_jok');
                $speaker = uploadImage('gambar_speaker');
                $glovebox = uploadImage('gambar_glovebox');
                $body = uploadImage('gambar_body');
                $bemper_depan = uploadImage('gambar_bamper_depan');
                $bemper_belakang = uploadImage('gambar_bamper_belakang');
                $fender_depan = uploadImage('gambar_fender_depan');
                $fender_belakang = uploadImage('gambar_fender_belakang');
                $box = uploadImage('gambar_box');
                $headlamp = uploadImage('gambar_headlamp');
                $stoplamp = uploadImage('gambar_stoplamp');
                $kaca_depan = uploadImage('gambar_kaca_depan');
                $spion = uploadImage('gambar_spion');
                $ban_depan = uploadImage('gambar_ban_depan');
                $ban_belakang = uploadImage('gambar_ban_belakang');
                $ban_serep = uploadImage('gambar_ban_serep');
                $dongkrak = uploadImage('gambar_dongkrak');
                $kunci_roda = uploadImage('gambar_kunci_roda');
                $stik_roda = uploadImage('gambar_stik_roda');
                $kotak_p3k = uploadImage('gambar_kotak_p3k');
                $warning_tirangel = uploadImage('gambar_warning_tirangel');
                $stnk = uploadImage('gambar_stnk');
                $kir = uploadImage('gambar_kir');
                $kartu_kir = uploadImage('gambar_kartu_kir');
                $sipa = uploadImage('gambar_sipa');
                $ibm = uploadImage('gambar_ibm');


                $detail_gambar = "INSERT INTO detail_gambar (id_audit_detail , gambar_cap_ban, gambar_stiker, gambar_dashcam, gambar_sunvisor, gambar_klakson, gambar_door_trim, gambar_jok, gambar_speaker, gambar_glovebox, gambar_body, gambar_bemper_depan, gambar_bemper_belakang, gambar_fender_depan, gambar_fender_belakang, gambar_box, gambar_headlamp, gambar_stoplamp, gambar_kaca_depan, gambar_spion, gambar_ban_depan, gambar_ban_belakang, gambar_ban_serep, gambar_dongkrak, gambar_kunci_roda, gambar_stik_roda, gambar_kotak_p3k, gambar_warning_triangle, gambar_stnk, gambar_kir, gambar_kartu_kir, gambar_sipa, gambar_ibm) VALUES ($id_detail_audit, '$cap_ban', '$stiker', '$dashcam', '$sunvisor', '$klakson', '$door_trim', '$jok', '$speaker', '$glovebox', '$body', '$bemper_depan', '$bemper_belakang', '$fender_depan', '$fender_belakang', '$box', '$headlamp', '$stoplamp', '$kaca_depan', '$spion', '$ban_depan', '$ban_belakang', '$ban_serep', '$dongkrak', '$kunci_roda', '$stik_roda', '$kotak_p3k', '$warning_tirangel', '$stnk', '$kir', '$kartu_kir', '$sipa', '$ibm')";


                $result_gambar = mysqli_query($koneksi, $detail_gambar);

                if ($result_gambar) {
                    $_SESSION['success_message'] = "Berhasil Menyimpan Gambar!";
                    header("Location: formulir_audit.php");
                    exit;
                }

                $_SESSION['success_message'] = "Berhasil Kirim Formulir!";
                header("Location: formulir_audit.php");
                exit;
            } else {
                $_SESSION['error_message'] = "Gagal menyimpan detail audit!";
                header("Location: formulir_audit.php");
                exit;
            }
        } else {
            $_SESSION['error_message'] = "Gagal Memasukkan Data Audit!";
            header("Location: formulir_audit.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Permintaan tidak valid!";
        header("Location: formulir_audit.php");
        exit;
    }
}

$getImage = function (string $url) {
    try {
        $path = './assets/gambar/' . $url;

        if (!file_exists($path)) {
            throw new Exception('File gambar tidak ditemukan.');
        }
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        if ($data === false) {
            throw new Exception('Gagal membaca file gambar.');
        }
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    } catch (Exception $e) {
        error_log('Error getImage: ' . $e->getMessage());
        return '';
    }
};




// End Formulir


// Dashboard
// $queryAdmin = "SELECT COUNT(*) AS total_admin FROM users WHERE role = 'admin'";
// $resultAdmin = mysqli_query($koneksi, $queryAdmin);
// $dataAdmin = mysqli_fetch_assoc($resultAdmin);
// $totalAdmin = $dataAdmin['total_admin'];

// Query untuk menghitung total auditor
$queryAuditor = "SELECT COUNT(*) AS total_auditor FROM users WHERE role = 'auditor'";
$resultAuditor = mysqli_query($koneksi, $queryAuditor);
$dataAuditor = mysqli_fetch_assoc($resultAuditor);
$totalAuditor = $dataAuditor['total_auditor'];

// Query untuk menghitung total kendaraan
$queryKendaraan = "SELECT COUNT(*) AS total_kendaraan FROM kendaraan";
$resultKendaraan = mysqli_query($koneksi, $queryKendaraan);
$dataKendaraan = mysqli_fetch_assoc($resultKendaraan);
$totalKendaraan = $dataKendaraan['total_kendaraan'];

// Query untuk menghitung total riwayat audit
$queryRiwayatAudit = "SELECT COUNT(*) AS total_audit FROM audit";
$resultRiwayatAudit = mysqli_query($koneksi, $queryRiwayatAudit);
$dataRiwayatAudit = mysqli_fetch_assoc($resultRiwayatAudit);
$totalRiwayatAudit = $dataRiwayatAudit['total_audit'];



function getTotalAudit($koneksi)
{
    $queryTotalSudahAudit = "SELECT id_kendaraan, COUNT(*) AS total_audit FROM audit GROUP BY id_kendaraan;";
    $resultTotalSudahAudit = mysqli_query($koneksi, $queryTotalSudahAudit);

    if ($resultTotalSudahAudit === false) {
        echo "Error in query: " . mysqli_error($koneksi);
        return 0;
    }

    $dataTotalSudahAudit = mysqli_fetch_assoc($resultTotalSudahAudit);

    if ($dataTotalSudahAudit) {
        return $dataTotalSudahAudit['total_audit'];
    } else {
        return 0;
    }
}

function getTotalBelumAudit($koneksi)
{
    $queryTotalBelumAudit = "SELECT COUNT(k.id) AS total_belum_audit FROM kendaraan k LEFT JOIN audit a ON k.id = a.id_kendaraan WHERE a.id_kendaraan IS NULL;";
    $resultTotalBelumAudit = mysqli_query($koneksi, $queryTotalBelumAudit);

    if ($resultTotalBelumAudit === false) {
        echo "Error in query: " . mysqli_error($koneksi);
        return 0;
    }

    $dataTotalBelumAudit = mysqli_fetch_assoc($resultTotalBelumAudit);

    if ($dataTotalBelumAudit) {
        return $dataTotalBelumAudit['total_belum_audit'];
    } else {
        return 0;
    }
}

function getTotalTemuan($koneksi)
{
    $queryTotalTemuan = "SELECT COUNT(*) AS total_temuan FROM detail_audit WHERE temuan IS NOT NULL;";
    $resultTotalTemuan = mysqli_query($koneksi, $queryTotalTemuan);

    if ($resultTotalTemuan === false) {
        echo "Error in query: " . mysqli_error($koneksi);
        return 0;
    }

    $dataTotalTemuan = mysqli_fetch_assoc($resultTotalTemuan);

    if ($dataTotalTemuan) {
        return $dataTotalTemuan['total_temuan'];
    } else {
        return 0;
    }
}
// End Dashboard
