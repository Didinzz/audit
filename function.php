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
            $status_temuan = validate_input($_POST['status_temuan']);
            $temuan = validate_input($_POST['temuan']);

            $query_detail = "INSERT INTO detail_audit (
                id_audit, cap_ban, stiker, dashcam, sunvisor, klakson, door_trim, jok, speaker, glovebox, body, bemper_depan, bemper_belakang,
                fender_depan, fender_belakang, box, headlamp, stoplamp, kaca_depan, spion, ban_depan, ban_belakang, ban_serep, dongkrak,
                kunci_roda, stik_roda, kotak_p3k, warning_tirangel, stnk, kir, kartu_kir, sipa, ibm, status_temuan, temuan
            ) VALUES (
                '$id_audit', '$cap_ban', '$stiker', '$dashcam', '$sunvisor', '$klakson', '$door_trim', '$jok', '$speaker', '$glovebox', '$body', '$bemper_depan', '$bemper_belakang',
                '$fender_depan', '$fender_belakang', '$box', '$headlamp', '$stoplamp', '$kaca_depan', '$spion', '$ban_depan', '$ban_belakang', '$ban_serep', '$dongkrak',
                '$kunci_roda', '$stik_roda', '$kotak_p3k', '$warning_tirangel', '$stnk', '$kir', '$kartu_kir', '$sipa', '$ibm', '$status_temuan', '$temuan'
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

                        $namaGambar = uniqid() . '_' . $name;
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
                $bemper_depan = uploadImage('gambar_bemper_depan');
                $bemper_belakang = uploadImage('gambar_bemper_belakang');
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
                    $_SESSION['success_message'] = "Berhasil Kirim Formulir!";
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





// Handler Edit Audit
if (isset($_POST['editAudit'])) {
    $idEdit = validate_input($_POST['id_edit']);
    $id_user  = validate_input($_POST['id_user']);
    if ($id_user != null || $id_user != "") {
        $id_kendaraan = validate_input($_POST['id_kendaraan']);
        $tanggal_audit = date('Y-m-d');

        // $query = "INSERT INTO audit (id_kendaraan, id_user, tanggal_audit) VALUES ('$id_kendaraan','$id_user','$tanggal_audit')";
        $queryEditAudit = "UPDATE audit SET id_kendaraan = '$id_kendaraan', id_user = '$id_user', tanggal_audit = '$tanggal_audit' WHERE id = '$idEdit'";
        $result_audit = mysqli_query($koneksi, $queryEditAudit);

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
            $status_temuan = validate_input($_POST['status_temuan']);
            $temuan = validate_input($_POST['temuan']);

            $queryEditDetail = "UPDATE detail_audit SET cap_ban='$cap_ban', stiker='$stiker', dashcam='$dashcam', sunvisor='$sunvisor', klakson='$klakson', door_trim='$door_trim', jok='$jok', speaker='$speaker', glovebox='$glovebox', body='$body', bemper_depan='$bemper_depan', bemper_belakang='$bemper_belakang', fender_depan='$fender_depan', fender_belakang='$fender_belakang',  box='$box', headlamp='$headlamp', stoplamp='$stoplamp', kaca_depan='$kaca_depan', spion='$spion', ban_depan='$ban_depan', ban_belakang='$ban_belakang', ban_serep='$ban_serep', dongkrak='$dongkrak', kunci_roda='$kunci_roda', stik_roda='$stik_roda', kotak_p3k='$kotak_p3k', warning_tirangel='$warning_tirangel', stnk='$stnk', kir='$kir', kartu_kir='$kartu_kir', sipa='$sipa', ibm='$ibm',status_temuan= '$status_temuan', temuan='$temuan' WHERE  id_audit = '$idEdit'";

            $result_detail = mysqli_query($koneksi, $queryEditDetail);

            if ($result_detail) {
                $id_detail_audit = mysqli_insert_id($koneksi);

                $queryDetailId = "SELECT * FROM detail_audit WHERE id_audit = '$idEdit'";
                $sqlDetailId = mysqli_query($koneksi, $queryDetailId);
                $resultDetailId = mysqli_fetch_assoc($sqlDetailId);
                $idAudit = intval($resultDetailId['id']);


                $queryShowImage = "SELECT * FROM detail_gambar WHERE id_audit_detail = '$resultDetailId[id]'";

                $sqlShowImage = mysqli_query($koneksi, $queryShowImage);
                $resultImage = mysqli_fetch_assoc($sqlShowImage);

                function uploadImage($nameInput, $resultImage)
                {

                    if (isset($_FILES[$nameInput]) && $_FILES[$nameInput]['name'] != "") {
                        $name = $_FILES[$nameInput]['name'];
                        $tmp_name = $_FILES[$nameInput]['tmp_name'];
                        $timestamp = time();

                        $namaGambar = $timestamp . '_' . $name;
                        $dir = './assets/gambar';
                        if (!is_dir($dir)) {
                            mkdir($dir, 0777, true);
                        }
                        // Hapus gambar lama jika ada
                        if (!empty($resultImage[$nameInput]) && file_exists($dir . '/' . $resultImage[$nameInput])) {
                            unlink($dir . '/' . $resultImage[$nameInput]);
                        }
                        // Unggah gambar baru
                        if (move_uploaded_file($tmp_name, $dir . '/' . $namaGambar)) {
                            return $namaGambar;
                        } else {
                            echo "Gagal mengunggah file " . $namaGambar . "<br>";
                            return null;
                        }
                    } else {
                        return $resultImage[$nameInput];
                    }
                }

                $cap_ban = uploadImage('gambar_cap_ban', $resultImage);
                $stiker = uploadImage('gambar_stiker', $resultImage);
                $dashcam = uploadImage('gambar_dashcam', $resultImage);
                $sunvisor = uploadImage('gambar_sunvisor', $resultImage);
                $klakson = uploadImage('gambar_klakson', $resultImage);
                $door_trim = uploadImage('gambar_door_trim', $resultImage);
                $jok = uploadImage('gambar_jok', $resultImage);
                $speaker = uploadImage('gambar_speaker', $resultImage);
                $glovebox = uploadImage('gambar_glovebox', $resultImage);
                $body = uploadImage('gambar_body', $resultImage);
                $bemper_depan = uploadImage('gambar_bemper_depan', $resultImage);
                $bemper_belakang = uploadImage('gambar_bemper_belakang', $resultImage);
                $fender_depan = uploadImage('gambar_fender_depan', $resultImage);
                $fender_belakang = uploadImage('gambar_fender_belakang', $resultImage);
                $box = uploadImage('gambar_box', $resultImage);
                $headlamp = uploadImage('gambar_headlamp', $resultImage);
                $stoplamp = uploadImage('gambar_stoplamp', $resultImage);
                $kaca_depan = uploadImage('gambar_kaca_depan', $resultImage);
                $spion = uploadImage('gambar_spion', $resultImage);
                $ban_depan = uploadImage('gambar_ban_depan', $resultImage);
                $ban_belakang = uploadImage('gambar_ban_belakang', $resultImage);
                $ban_serep = uploadImage('gambar_ban_serep', $resultImage);
                $dongkrak = uploadImage('gambar_dongkrak', $resultImage);
                $kunci_roda = uploadImage('gambar_kunci_roda', $resultImage);
                $stik_roda = uploadImage('gambar_stik_roda', $resultImage);
                $kotak_p3k = uploadImage('gambar_kotak_p3k', $resultImage);
                $warning_tirangel = uploadImage('gambar_warning_triangle', $resultImage);
                $stnk = uploadImage('gambar_stnk', $resultImage);
                $kir = uploadImage('gambar_kir', $resultImage);
                $kartu_kir = uploadImage('gambar_kartu_kir', $resultImage);
                $sipa = uploadImage('gambar_sipa', $resultImage);
                $ibm = uploadImage('gambar_ibm', $resultImage);

                // var_dump($idAudit, $cap_ban, $stiker, $dashcam, $sunvisor, $klakson, $door_trim, $jok, $speaker, $glovebox, $body, $bemper_depan, $bemper_belakang, $fender_depan, $fender_belakang, $box, $headlamp, $stoplamp, $kaca_depan, $spion, $ban_depan, $ban_belakang, $ban_serep, $dongkrak, $kunci_roda, $stik_roda, $kotak_p3k, $warning_tirangel, $stnk, $kir, $kartu_kir, $sipa, $ibm);

                $quertEditImage = "UPDATE detail_gambar SET gambar_cap_ban = '$cap_ban', gambar_stiker = '$stiker', gambar_dashcam = '$dashcam', gambar_sunvisor = '$sunvisor', gambar_klakson = '$klakson', gambar_door_trim = '$door_trim', gambar_jok = '$jok', gambar_speaker = '$speaker', gambar_glovebox = '$glovebox', gambar_body = '$body', gambar_bemper_depan = '$bemper_depan', gambar_bemper_belakang = '$bemper_belakang', gambar_fender_depan = '$fender_depan', gambar_fender_belakang = '$fender_belakang', gambar_box = '$box', gambar_headlamp = '$headlamp', gambar_stoplamp = '$stoplamp', gambar_kaca_depan = '$kaca_depan', gambar_spion = '$spion', gambar_ban_depan = '$ban_depan', gambar_ban_belakang = '$ban_belakang', gambar_ban_serep = '$ban_serep', gambar_dongkrak = '$dongkrak', gambar_kunci_roda = '$kunci_roda', gambar_stik_roda = '$stik_roda', gambar_kotak_p3k = '$kotak_p3k', gambar_warning_triangle = '$warning_tirangel', gambar_stnk = '$stnk', gambar_kir = '$kir', gambar_kartu_kir = '$kartu_kir', gambar_sipa = '$sipa', gambar_ibm = '$ibm' WHERE id_audit_detail = '$idAudit' ";


                $result_gambar = mysqli_query($koneksi, $quertEditImage);

                if ($result_gambar) {
                    $_SESSION['success_edit_message'] = "Berhasil Update Data Audit!!";
                    header("Location: riwayat_audit.php");
                    exit;
                } else {
                    echo "Gagal mengubah gambar: " . mysqli_error($koneksi);
                }

                $_SESSION['success_edit_message'] = "Berhasil Update Data Audit!";
                header("Location: riwayat_audit.php");
                exit;
            } else {
                $_SESSION['error_message'] = "Gagal mengubah detail audit!";
                header("Location: riwayat_audit.php");
                exit;
            }
        } else {
            $_SESSION['error_message'] = "Gagal Mengupdate Data Audit!";
            header("Location: riwayat_audit.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Permintaan tidak valid!";
        header("Location: riwayat_audit.php");
        exit;
    }
}

if (isset($_GET['hapusAudit'])) {
    // get id audit
    $id = $_GET['hapusAudit'];
    $queryGetDetailAudit = "SELECT * FROM audit WHERE id = '$id'";
    $resultGetDetailAudit = mysqli_query($koneksi, $queryGetDetailAudit);
    $dataGetDetailAudit = mysqli_fetch_assoc($resultGetDetailAudit);
    $idAudit = $dataGetDetailAudit['id'];

    // get id detail audit
    $queryGetDetail = "SELECT * FROM detail_audit WHERE id_audit = '$idAudit'";
    $resultGetDetail = mysqli_query($koneksi, $queryGetDetail);
    $dataGetDetail = mysqli_fetch_assoc($resultGetDetail);
    $idDetail = $dataGetDetail['id'];

    // get id detail gambar
    $queryGetDetailGambar = "SELECT * FROM detail_gambar WHERE id_audit_detail = '$idDetail'";
    $resultGetDetailGambar = mysqli_query($koneksi, $queryGetDetailGambar);
    $dataGetDetailGambar = mysqli_fetch_assoc($resultGetDetailGambar);
    $idDetailGambar = $dataGetDetailGambar['id'];
    // var_dump($idDetail);

    $dir = 'assets/gambar/';

    if ($dataGetDetailGambar) {
        $cap_ban = $dataGetDetailGambar['gambar_cap_ban'];
        $stiker = $dataGetDetailGambar['gambar_stiker'];
        $dashcam = $dataGetDetailGambar['gambar_dashcam'];
        $sunvisor = $dataGetDetailGambar['gambar_sunvisor'];
        $klakson = $dataGetDetailGambar['gambar_klakson'];
        $door_trim = $dataGetDetailGambar['gambar_door_trim'];
        $jok = $dataGetDetailGambar['gambar_jok'];
        $speaker = $dataGetDetailGambar['gambar_speaker'];
        $glovebox = $dataGetDetailGambar['gambar_glovebox'];
        $body = $dataGetDetailGambar['gambar_body'];
        $bemper_depan = $dataGetDetailGambar['gambar_bemper_depan'];
        $bemper_belakang = $dataGetDetailGambar['gambar_bemper_belakang'];
        $fender_depan = $dataGetDetailGambar['gambar_fender_depan'];
        $fender_belakang = $dataGetDetailGambar['gambar_fender_belakang'];
        $box = $dataGetDetailGambar['gambar_box'];
        $headlamp = $dataGetDetailGambar['gambar_headlamp'];
        $stoplamp = $dataGetDetailGambar['gambar_stoplamp'];
        $kaca_depan = $dataGetDetailGambar['gambar_kaca_depan'];
        $spion = $dataGetDetailGambar['gambar_spion'];
        $ban_depan = $dataGetDetailGambar['gambar_ban_depan'];
        $ban_belakang = $dataGetDetailGambar['gambar_ban_belakang'];
        $ban_serep = $dataGetDetailGambar['gambar_ban_serep'];
        $dongkrak = $dataGetDetailGambar['gambar_dongkrak'];
        $kunci_roda = $dataGetDetailGambar['gambar_kunci_roda'];
        $stik_roda = $dataGetDetailGambar['gambar_stik_roda'];
        $kotak_p3k = $dataGetDetailGambar['gambar_kotak_p3k'];
        $warning_tirangel = $dataGetDetailGambar['gambar_warning_triangle'];
        $stnk = $dataGetDetailGambar['gambar_stnk'];
        $kir = $dataGetDetailGambar['gambar_kir'];
        $kartu_kir = $dataGetDetailGambar['gambar_kartu_kir'];
        $sipa = $dataGetDetailGambar['gambar_sipa'];
        $ibm = $dataGetDetailGambar['gambar_ibm'];
        // Menghapus file gambar dari direktori jika ada
        if (!empty($cap_ban)) {
            $filePathCapBan = $dir . $cap_ban;
            if (file_exists($filePathCapBan)) {
                unlink($filePathCapBan);
            }
        }

        if (!empty($stiker)) {
            $filePathStiker = $dir . $stiker;
            if (file_exists($filePathStiker)) {
                unlink($filePathStiker);
            }
        }

        if (!empty($dashcam)) {
            $filePathDashcam = $dir . $dashcam;
            if (file_exists($filePathDashcam)) {
                unlink($filePathDashcam);
            }
        }

        if (!empty($sunvisor)) {
            $filePathSunvisor = $dir . $sunvisor;
            if (file_exists($filePathSunvisor)) {
                unlink($filePathSunvisor);
            }
        }

        if (!empty($klakson)) {
            $filePathKlakson = $dir . $klakson;
            if (file_exists($filePathKlakson)) {
                unlink($filePathKlakson);
            }
        }

        if (!empty($door_trim)) {
            $filePathDoorTrim = $dir . $door_trim;
            if (file_exists($filePathDoorTrim)) {
                unlink($filePathDoorTrim);
            }
        }

        if (!empty($jok)) {
            $filePathJok = $dir . $jok;
            if (file_exists($filePathJok)) {
                unlink($filePathJok);
            }
        }

        if (!empty($speaker)) {
            $filePathSpeaker = $dir . $speaker;
            if (file_exists($filePathSpeaker)) {
                unlink($filePathSpeaker);
            }
        }

        if (!empty($glovebox)) {
            $filePathGlovebox = $dir . $glovebox;
            if (file_exists($filePathGlovebox)) {
                unlink($filePathGlovebox);
            }
        }

        if (!empty($body)) {
            $filePathBody = $dir . $body;
            if (file_exists($filePathBody)) {
                unlink($filePathBody);
            }
        }

        if (!empty($bemper_depan)) {
            $filePathBemperDepan = $dir . $bemper_depan;
            if (file_exists($filePathBemperDepan)) {
                unlink($filePathBemperDepan);
            }
        }

        if (!empty($bemper_belakang)) {
            $filePathBemperBelakang = $dir . $bemper_belakang;
            if (file_exists($filePathBemperBelakang)) {
                unlink($filePathBemperBelakang);
            }
        }
        if (!empty($fender_depan)) {
            $filePathFenderDepan = $dir . $fender_depan;
            if (file_exists($filePathFenderDepan)) {
                unlink($filePathFenderDepan);
            }
        }

        if (!empty($fender_belakang)) {
            $filePathFenderBelakang = $dir . $fender_belakang;
            if (file_exists($filePathFenderBelakang)) {
                unlink($filePathFenderBelakang);
            }
        }

        if (!empty($box)) {
            $filePathBox = $dir . $box;
            if (file_exists($filePathBox)) {
                unlink($filePathBox);
            }
        }

        if (!empty($headlamp)) {
            $filePathHeadlamp = $dir . $headlamp;
            if (file_exists($filePathHeadlamp)) {
                unlink($filePathHeadlamp);
            }
        }

        if (!empty($stoplamp)) {
            $filePathStoplamp = $dir . $stoplamp;
            if (file_exists($filePathStoplamp)) {
                unlink($filePathStoplamp);
            }
        }

        if (!empty($kaca_depan)) {
            $filePathKacaDepan = $dir . $kaca_depan;
            if (file_exists($filePathKacaDepan)) {
                unlink($filePathKacaDepan);
            }
        }

        if (!empty($spion)) {
            $filePathSpion = $dir . $spion;
            if (file_exists($filePathSpion)) {
                unlink($filePathSpion);
            }
        }

        if (!empty($ban_depan)) {
            $filePathBanDepan = $dir . $ban_depan;
            if (file_exists($filePathBanDepan)) {
                unlink($filePathBanDepan);
            }
        }

        if (!empty($ban_belakang)) {
            $filePathBanBelakang = $dir . $ban_belakang;
            if (file_exists($filePathBanBelakang)) {
                unlink($filePathBanBelakang);
            }
        }

        if (!empty($ban_serep)) {
            $filePathBanSerep = $dir . $ban_serep;
            if (file_exists($filePathBanSerep)) {
                unlink($filePathBanSerep);
            }
        }

        if (!empty($dongkrak)) {
            $filePathDongkrak = $dir . $dongkrak;
            if (file_exists($filePathDongkrak)) {
                unlink($filePathDongkrak);
            }
        }
        if (!empty($kunci_roda)) {
            $filePathKunciRoda = $dir . $kunci_roda;
            if (file_exists($filePathKunciRoda)) {
                unlink($filePathKunciRoda);
            }
        }
        if (!empty($stik_roda)) {
            $filePathStikRoda = $dir . $stik_roda;
            if (file_exists($filePathStikRoda)) {
                unlink($filePathStikRoda);
            }
        }

        if (!empty($kotak_p3k)) {
            $filePathKotakP3k = $dir . $kotak_p3k;
            if (file_exists($filePathKotakP3k)) {
                unlink($filePathKotakP3k);
            }
        }

        if (!empty($warning_tirangel)) {
            $filePathWarningTirangel = $dir . $warning_tirangel;
            if (file_exists($filePathWarningTirangel)) {
                unlink($filePathWarningTirangel);
            }
        }

        if (!empty($stnk)) {
            $filePathStnk = $dir . $stnk;
            if (file_exists($filePathStnk)) {
                unlink($filePathStnk);
            }
        }
        if (!empty($kir)) {
            $filePathKir = $dir . $kir;
            if (file_exists($filePathKir)) {
                unlink($filePathKir);
            }
        }
        if (!empty($kartu_kir)) {
            $filePathKartuKir = $dir . $kartu_kir;
            if (file_exists($filePathKartuKir)) {
                unlink($filePathKartuKir);
            }
        }
        if (!empty($sipa)) {
            $filePathSipa = $dir . $sipa;
            if (file_exists($filePathSipa)) {
                unlink($filePathSipa);
            }
        }
        if (!empty($ibm)) {
            $filePathIbm = $dir . $ibm;
            if (file_exists($filePathIbm)) {
                unlink($filePathIbm);
            }
        }

        $queryDeleteGambar = "DELETE FROM detail_gambar WHERE id_audit_detail = '$idDetail'";
        $sqlDeletedGambar = mysqli_query($koneksi, $queryDeleteGambar);
        if ($sqlDeletedGambar) {
            $queryDeleteDetail = "DELETE FROM detail_audit WHERE id_audit = '$idAudit'";
            $sqlDeleteDetail = mysqli_query($koneksi, $queryDeleteDetail);
        };
        if ($sqlDeleteDetail) {
            $queryDeleteAudit = "DELETE FROM audit WHERE id = '$id'";
            $sqlDeleteAudit = mysqli_query($koneksi, $queryDeleteAudit);
            if ($sqlDeleteAudit) {
                $_SESSION['success_delete_message'] = "Berhasil menghapus audit!";
                header("Location: riwayat_audit.php");
                exit;
            }
        } else {
            echo "Gagal menghapus audit: " . mysqli_error($koneksi);
        };
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
    $queryTotalTemuan = "SELECT COUNT(*) AS total_temuan FROM detail_audit WHERE temuan IS NOT NULL AND temuan != '';";
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

function getTotalBelumTerselesaikan($koneksi)
{
    $queryTotalBelumTerselesaikan = "SELECT COUNT(*) AS total_belum_selesaikan FROM detail_audit WHERE status_temuan = 'Open';";
    $resultTotalBelumTerselesaikan = mysqli_query($koneksi, $queryTotalBelumTerselesaikan);

    if ($resultTotalBelumTerselesaikan === false) {
        echo "Error in query: " . mysqli_error($koneksi);
        return 0;
    }

    $dataTotalBelumTerselesaikan = mysqli_fetch_assoc($resultTotalBelumTerselesaikan);

    if ($dataTotalBelumTerselesaikan) {
        return $dataTotalBelumTerselesaikan['total_belum_selesaikan'];
    } else {
        return 0;
    }
}
function getTotalSudahTerselesaikan($koneksi)
{
    $queryTotalSudahTerselesiakan = "SELECT COUNT(*) AS total_belum_selesaikan FROM detail_audit WHERE status_temuan = 'Close';";
    $resultTotalSudahTerselesaikan = mysqli_query($koneksi, $queryTotalSudahTerselesiakan);

    if ($resultTotalSudahTerselesaikan === false) {
        echo "Error in query: " . mysqli_error($koneksi);
        return 0;
    }

    $dataTotalSudahTerselesaikan = mysqli_fetch_assoc($resultTotalSudahTerselesaikan);

    if ($dataTotalSudahTerselesaikan) {
        return $dataTotalSudahTerselesaikan['total_belum_selesaikan'];
    } else {
        return 0;
    }
}
// End Dashboard
