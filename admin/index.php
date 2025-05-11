<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Administračný Panel</h1>

    <a href="logout.php" class="btn btn-danger mb-4">Odhlásiť sa</a>

    <div class="list-group">       
        <a href="pdf-manager.php" class="list-group-item list-group-item-action">Správa PDF súborov</a>
        <a href="rezervacie_restauracia.php" class="list-group-item list-group-item-action">Rezervácie Reštaurácia</a>
<a href="rezervacie_ubytovanie.php" class="list-group-item list-group-item-action">Rezervácie Ubytovanie</a>
<a href="rezervacie_svadby.php" class="list-group-item list-group-item-action">Rezervácie Svadby</a>
<a href="rezervacie_ihriska.php" class="list-group-item list-group-item-action">Rezervácie Ihriská</a>
<a href="aktuality.php" class="list-group-item list-group-item-action">Aktuality</a>
    </div>
</body>
</html>
