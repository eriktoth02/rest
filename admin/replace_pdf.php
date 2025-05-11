<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$directory = "../assets/";
$fileName = isset($_GET['file']) ? basename($_GET['file']) : '';

if (!$fileName || !file_exists($directory . $fileName) || pathinfo($fileName, PATHINFO_EXTENSION) !== 'pdf') {
    die("Neplatný súbor.");
}

// Ak bol formulár odoslaný
if (isset($_POST['replace'])) {
    if ($_FILES['new_pdf']['type'] === 'application/pdf') {
        $targetPath = $directory . $fileName;
        move_uploaded_file($_FILES['new_pdf']['tmp_name'], $targetPath);
        header("Location: pdf-manager.php");
        exit();
    } else {
        $error = "Iba PDF súbory sú povolené.";
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Vymeniť PDF súbor</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Vymeniť PDF: <?php echo htmlspecialchars($fileName); ?></h1>
    <a href="pdf-manager.php" class="btn btn-secondary mb-3">Späť na PDF manažér</a>

    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="new_pdf" class="form-label">Vyber nový PDF súbor</label>
            <input type="file" name="new_pdf" accept="application/pdf" required class="form-control">
        </div>
        <button type="submit" name="replace" class="btn btn-warning">Vymeniť súbor</button>
    </form>
</body>
</html>
