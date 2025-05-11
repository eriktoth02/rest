<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$file = "../data/rezervacie_svadby.json";
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    array_splice($data, $index, 1);
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: rezervacie_svadby.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Rezervácie svadby</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1>Rezervácie Svadby</h1>
    <a href="index.php" class="btn btn-secondary mb-3">Späť na dashboard</a>

    <?php foreach ($data as $index => $res): ?>
    <div class="border rounded p-2 mb-3 bg-light">
        <strong>Meno:</strong> <?= htmlspecialchars($res['name'] ?? '') ?><br>
        <strong>Email:</strong> <?= htmlspecialchars($res['email'] ?? '') ?><br>
        <strong>Predmet:</strong> <?= htmlspecialchars($res['subject'] ?? '') ?><br>
        <strong>Správa:</strong> <?= nl2br(htmlspecialchars($res['message'] ?? '')) ?><br>
        <a href="?delete=<?= $index ?>" onclick="return confirm('Naozaj zmazať?')" class="btn btn-sm btn-danger mt-2">Zmazať</a>
    </div>
    <?php endforeach; ?>
</body>
</html>
