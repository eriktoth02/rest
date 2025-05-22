<?php
$date = $_GET['date'] ?? null;
$field = $_GET['field'] ?? null;

if (!$date || !$field) {
    echo "Chýbajúci dátum alebo ihrisko.";
    exit;
}

$jsonFile = __DIR__ . '/../data/rezervacie_ihriska.json';

if (!file_exists($jsonFile)) {
    echo "Dátový súbor neexistuje.";
    exit;
}

$data = json_decode(file_get_contents($jsonFile), true);
if (!is_array($data)) {
    echo "Neplatný formát údajov.";
    exit;
}

$reservations = array_filter($data, function ($entry) use ($date, $field) {
    return $entry['date'] === $date && strtolower($entry['field']) === strtolower($field);
});

function isSlotTaken($reservations, $slotTime, $durationMinutes) {
    foreach ($reservations as $entry) {
        $start = strtotime($entry['date'] . ' ' . $entry['time']);
        $end = $start + ((int) ($entry['duration'] ?? 60)) * 60;
        $slot = strtotime($slotTime);
        if ($slot >= $start && $slot < $end) {
            return true;
        }
    }
    return false;
}

echo '<table class="table table-bordered">';
echo '<thead><tr><th>Čas</th><th>Stav</th></tr></thead><tbody>';

for ($hour = 8; $hour <= 22; $hour++) {
    foreach ([0, 30] as $min) {
        $timeStr = sprintf("%02d:%02d", $hour, $min);
        $slotTime = $date . ' ' . $timeStr;

        $taken = isSlotTaken($reservations, $slotTime, 30);

        echo '<tr>';
        echo "<td>$timeStr</td>";
        echo '<td>' . ($taken ? '<span class="text-danger">Rezervované</span>' : '<span class="text-success">Voľné</span>') . '</td>';
        echo '</tr>';
    }
}

echo '</tbody></table>';
?>