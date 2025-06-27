<?php
require_once 'session_check.php';
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .admin-panel {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="admin-panel">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Administrácia</h1>
            <a href="logout.php" class="btn btn-danger">Odhlásiť sa</a>
        </div>
        
        <div class="row">
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <!-- Pre admina zobraz všetko -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Správa PDF súborov</h5>
                            <p class="card-text">Nahratie a správa dokumentov PDF</p>
                            <a href="pdf-manager.php" class="btn btn-primary">Prejsť</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rezervácie Reštaurácia</h5>
                            <p class="card-text">Zobrazenie a správa rezervácií</p>
                            <a href="rezervacie_restauracia.php" class="btn btn-primary">Prejsť</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rezervácie Ubytovanie</h5>
                            <p class="card-text">Správa rezervácií ubytovania</p>
                            <a href="rezervacie_ubytovanie.php" class="btn btn-primary">Prejsť</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rezervácie Svadby</h5>
                            <p class="card-text">Správa rezervácií svadieb</p>
                            <a href="rezervacie_svadby.php" class="btn btn-primary">Prejsť</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Aktuality</h5>
                            <p class="card-text">Správa noviniek a aktualít</p>
                            <a href="aktuality.php" class="btn btn-primary">Prejsť</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Viditeľné pre VŠETKÝCH (admin aj recepčný) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rezervácie Ihriská</h5>
                        <p class="card-text">Správa rezervácií detských ihrísk</p>
                        <a href="rezervacie_ihriska.php" class="btn btn-primary">Prejsť</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>