<?php
// Nahradenie starého session kódu novým bezpečnostným skriptom
require_once 'session_check.php';
if ($_SESSION['role'] !== 'admin') {
    die("Prístup zamietnutý");
}

$directory = "../assets/";

// Vymazanie PDF súboru
if (isset($_GET['delete'])) {
    $file = basename($_GET['delete']);
    $filePath = $directory . $file;
    if (file_exists($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'pdf') {
        unlink($filePath);
        header("Location: pdf-manager.php");
        exit();
    }
}

// Nahratie nového PDF súboru
if (isset($_POST['upload'])) {
    if ($_FILES['pdf_file']['type'] === 'application/pdf') {
        $uploadPath = $directory . basename($_FILES['pdf_file']['name']);
        move_uploaded_file($_FILES['pdf_file']['tmp_name'], $uploadPath);
        header("Location: pdf-manager.php");
        exit();
    } else {
        echo "<p style='color:red;'>Iba PDF súbory sú povolené.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Správa PDF súborov</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Správa PDF súborov</h1>
    <a href="index.php" class="btn btn-secondary mb-3">Späť na dashboard</a>

    <h3>Existujúce PDF súbory:</h3>
    <ul class="list-group mb-4">
        <?php
        $files = glob($directory . "*.pdf");
        if ($files) {
            foreach ($files as $file) {
                $fileName = basename($file);
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                        $fileName
                        <span>
                            <a href='$directory$fileName' target='_blank' class='btn btn-sm btn-primary'>Zobraziť</a>
                            <a href='replace_pdf.php?file=$fileName' class='btn btn-sm btn-warning'>Vymeniť</a>
                            <a href='pdf-manager.php?delete=$fileName' class='btn btn-sm btn-danger' onclick='return confirm(\"Naozaj zmazať?\")'>Zmazať</a>
                        </span>
                      </li>";
            }
        } else {
            echo "<li class='list-group-item'>Žiadne PDF súbory</li>";
        }
        ?>
    </ul>

    <h3>Nahrať nový PDF súbor:</h3>
    <form action="pdf-manager.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" name="pdf_file" accept="application/pdf" required class="form-control">
        </div>
        <button type="submit" name="upload" class="btn btn-success">Nahrať</button>
    </form>
</body>
</html>
