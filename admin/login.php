<?php
session_start();

$admin_username = "admin";
$admin_password = "tajneheslo123"; // nastav si vlastné bezpečné heslo

// Ak je už prihlásený, presmeruj na admin dashboard
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

// Spracovanie prihlasovacieho formulára
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error = "Nesprávne meno alebo heslo.";
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="container mt-5">
    <h1>Prihlásenie do Admin panelu</h1>

    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="username" class="form-label">Používateľské meno:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Heslo:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Prihlásiť sa</button>
    </form>
</body>
</html>
