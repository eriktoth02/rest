<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$file = "../data/rezervacie_ihriska.json";

function load_data($file) {
    return file_exists($file) ? json_decode(file_get_contents($file), true) : [];
}
function save_data($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    $data = load_data($file);
    array_splice($data, $index, 1);
    save_data($file, $data);
    header("Location: rezervacie_ihriska.php?week=" . $_GET['week']);
    exit();
}

function getMonday($date) {
    $ts = strtotime($date);
    $dow = date('w', $ts);
    $offset = $dow == 0 ? -6 : 1 - $dow;
    return date('Y-m-d', strtotime("$offset day", $ts));
}

$monday = isset($_GET['week']) ? $_GET['week'] : getMonday(date('Y-m-d'));
$weekStart = $monday;
$weekEnd = date('Y-m-d', strtotime("$weekStart +6 days"));
$data = load_data($file);
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Harmonogram ihrísk</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table { font-size: 0.8rem; }
        td { min-width: 110px; text-align: center; vertical-align: middle; }
    </style>
</head>
<body class="container mt-4">
    <h1>Harmonogram Ihriská</h1>
    <a href="index.php" class="btn btn-secondary mb-3">Späť na dashboard</a>

    <?php
    $prevWeek = date('Y-m-d', strtotime("$monday -7 days"));
    $nextWeek = date('Y-m-d', strtotime("$monday +7 days"));
    ?>
    <a href="?week=<?php echo $prevWeek; ?>" class="btn btn-primary">Predchádzajúci týždeň</a>
    <a href="?week=<?php echo $nextWeek; ?>" class="btn btn-primary">Nasledujúci týždeň</a>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Čas</th>
                <?php for ($i = 0; $i < 7; $i++): ?>
                    <th><?php echo date('D d.m.', strtotime("$monday +$i days")); ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($hour = 8; $hour <= 22; $hour++) {
                echo "<tr>";
                echo "<td>{$hour}:00</td>";
                for ($day = 0; $day < 7; $day++) {
                    $currentDate = date('Y-m-d', strtotime("$monday +$day days"));
                    echo "<td>";
                    foreach ($data as $index => $res) {
                        $resHour = intval(substr($res['time'] ?? '00:00', 0, 2));
                        if (($res['date'] ?? '') == $currentDate && $resHour == $hour) {
                            echo "<div class='border rounded p-2 mb-1 bg-light'>";
                            echo "<strong>" . htmlspecialchars($res['field'] ?? '') . "</strong><br>";
                            echo "Meno: " . htmlspecialchars($res['name'] ?? '') . "<br>";
                            echo "Tel: " . htmlspecialchars($res['phone'] ?? '') . "<br>";
                            echo "Email: " . htmlspecialchars($res['email'] ?? '') . "<br>";
                            echo "Čas: " . htmlspecialchars($res['time'] ?? '') . " (" . htmlspecialchars($res['duration'] ?? '60') . " min)<br>";
                            if (!empty($res['note'])) {
                                echo "Poznámka: " . htmlspecialchars($res['note']) . "<br>";
                            }
                            echo "<a href='?delete=$index&week=$monday' class='btn btn-sm btn-danger mt-2'>Zmazať</a>";
                            echo "</div>";
                        }
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h3>Pridať novú rezerváciu</h3>
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col">
                <input type="time" name="time" class="form-control" required>
            </div>
            <div class="col">
                <input type="text" name="field" class="form-control" placeholder="Ihrisko" required>
            </div>
            <div class="col">
                <input type="text" name="note" class="form-control" placeholder="Poznámka">
            </div>
            <div class="col">
                <button type="submit" name="add" class="btn btn-success">Pridať</button>
            </div>
        </div>
    </form>
</body>
</html>
