<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$file = "../data/aktuality.json";

// Načítanie aktualít
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Pridanie aktuality
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new = [
        "title" => $_POST['title'] ?? '',
        "text" => $_POST['text'] ?? '',
        "date" => $_POST['date'] ?? date("d. m. Y")
    ];
    $data[] = $new;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: aktuality.php");
    exit();
}

// Vymazanie aktuality
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    array_splice($data, $index, 1);
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: aktuality.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Správa aktualít</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1>Správa Aktualít</h1>
    <a href="index.php" class="btn btn-secondary mb-3">Späť na dashboard</a>

    <h3>Pridať novú aktualitu</h3>
    <form action="" method="post" class="mb-4">
        <div class="mb-2">
            <input type="text" name="title" class="form-control" placeholder="Nadpis" required>
        </div>
        <div class="mb-2">
            <textarea name="text" class="form-control" rows="3" placeholder="Text aktuality" required></textarea>
        </div>
        <div class="mb-2">
            <input type="text" name="date" class="form-control" placeholder="Dátum (napr. 11. mája 2025)" value="<?= date("d. m. Y") ?>">
        </div>
        <button type="submit" class="btn btn-success">Pridať aktualitu</button>
    </form>

    <h3>Existujúce aktuality</h3>
    <?php foreach ($data as $index => $aktualita): ?>
    <div class="border rounded p-2 mb-3 bg-light">
        <h5><?= htmlspecialchars($aktualita['title'] ?? '') ?></h5>
        <p><?= nl2br(htmlspecialchars($aktualita['text'] ?? '')) ?></p>
        <small><strong>Dátum:</strong> <?= htmlspecialchars($aktualita['date'] ?? '') ?></small><br>
        <a href="?delete=<?= $index ?>" onclick="return confirm('Naozaj zmazať túto aktualitu?')" class="btn btn-sm btn-danger mt-2">Zmazať</a>
    </div>
    <?php endforeach; ?>
</body>
</html>
