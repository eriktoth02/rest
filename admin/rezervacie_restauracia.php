<?php
// Nahradenie starého session kódu novým bezpečnostným skriptom
require_once 'session_check.php';
if ($_SESSION['role'] !== 'admin') {
    die("Prístup zamietnutý");
}

$file = "../data/rezervacie_restauracia.json";
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    array_splice($data, $index, 1);
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: rezervacie_restauracia.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Rezervácie reštaurácia</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1>Rezervácie Reštaurácia</h1>
    <a href="index.php" class="btn btn-secondary mb-3">Späť na dashboard</a>

    <?php foreach ($data as $index => $res): ?>
    <div class="border rounded p-2 mb-3 bg-light">
        <strong>Meno:</strong> <?= htmlspecialchars($res['name'] ?? '') ?><br>
        <strong>Email:</strong> <?= htmlspecialchars($res['email'] ?? '') ?><br>
        <strong>Telefón:</strong> <?= htmlspecialchars($res['phone'] ?? '') ?><br>
        <strong>Dátum:</strong> <?= htmlspecialchars($res['date'] ?? '') ?><br>
        <strong>Čas:</strong> <?= htmlspecialchars($res['time'] ?? '') ?><br>
        <strong>Počet osôb:</strong> <?= htmlspecialchars($res['people'] ?? '') ?><br>
        <strong>Správa:</strong> <?= nl2br(htmlspecialchars($res['message'] ?? '')) ?><br>
        <a href="?delete=<?= $index ?>" onclick="return confirm('Naozaj zmazať?')" class="btn btn-sm btn-danger mt-2">Zmazať</a>
    </div>
    <?php endforeach; ?>
</body>
</html>
