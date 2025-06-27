<?php
session_start();

// Vymazanie všetkých session premenných
$_SESSION = array();

// Vymazanie session cookie
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

// Zničenie session
session_destroy();

// Presmerovanie na prihlasovaciu stránku
header("Location: login.php?loggedout=1");
exit();
?>