<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'] ?? '';
    if (!empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Hash Generátor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Generátor hash hesla</h1>
    <form method="post">
        <div class="mb-3">
            <label for="password" class="form-label">Zadaj heslo</label>
            <input type="text" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Generovať hash</button>
    </form>

    <?php if (isset($hash)): ?>
        <div class="mt-4">
            <h5>Vygenerovaný hash:</h5>
            <code><?= htmlspecialchars($hash) ?></code>
        </div>
    <?php endif; ?>
</body>
</html>
