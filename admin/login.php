<?php
session_start();

// Zoznam používateľov (môžeš neskôr presunúť do JSON)
$users = [
    'admin' => [
        'password' => '$2y$12$CE8d.UukmcxfzRZDQ34fceJBM9Uu7Cqupjy3x8c7fysrLnYofw1JO', // admin heslo
        'role' => 'admin'
    ],
    'brigadnik' => [
  'password' => '$2y$12$o6qBLKwJO1pmR3VRSPx/nuSg8rZHFEuYomUOmtve8xgy235r2gba2', // heslo: podkova2
  'role' => 'brigadnik'
]
];

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username]) && password_verify($password, $users[$username]['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['role'] = $users[$username]['role'];
        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['last_activity'] = time();

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="text-center mb-4">Admin Panel</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Používateľské meno</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Heslo</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Prihlásiť sa</button>
        </form>
    </div>
</body>
</html>