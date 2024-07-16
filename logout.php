<?php
session_start();
$_SESSION['logout_message'] = "Anda telah berhasil logout.";

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
session_destroy();

session_start();
$_SESSION['logout_message'] = "Anda telah berhasil logout.";

header('Location: index.php');
exit;