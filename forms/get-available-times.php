<?php
header('Content-Type: application/json');

$date = $_GET['date'] ?? '';
$field = $_GET['field'] ?? '';
$duration = isset($_GET['duration']) ? (int)$_GET['duration'] : 60; // predvolene 60 min

if (empty($date) || empty($field) || $duration <= 0) {
    echo json_encode([]);
    exit();
}

$file = "../data/rezervacie_ihriska.json";
$reservations = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Vygenerujeme všetky štarty od 08:00 do 22:00 - duration
$availableTimes = [];
$start = strtotime("$date 08:00");
$end = strtotime("$date 22:00") - ($duration * 60); // posledný možný začiatok

for ($slot = $start; $slot <= $end; $slot += 15 * 60) {
    $new_start = $slot;
    $new_end = $new_start + ($duration * 60);

    $conflict = false;
    foreach ($reservations as $res) {
        if (($res['date'] ?? '') === $date && ($res['field'] ?? '') === $field) {
            $existing_start = strtotime($res['date'] . ' ' . $res['time']);
            $existing_duration = (int)($res['duration'] ?? 60);
            $existing_end = $existing_start + $existing_duration * 60;

            // Kontrola prekrývania
            if ($new_start < $existing_end && $existing_start < $new_end) {
                $conflict = true;
                break;
            }
        }
    }

    if (!$conflict) {
        $availableTimes[] = date('H:i', $new_start);
    }
}

echo json_encode($availableTimes);
?>
