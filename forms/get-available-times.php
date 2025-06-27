<?php
header('Content-Type: application/json');

$startDate = $_GET['date'] ?? '';
$field = $_GET['field'] ?? '';

if (empty($startDate) || empty($field)) {
    echo json_encode([]);
    exit();
}

$file = "../data/rezervacie_ihriska.json";
$reservations = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$output = [];

$startTimestamp = strtotime($startDate);
for ($dayOffset = 0; $dayOffset < 7; $dayOffset++) {
    $date = date('Y-m-d', strtotime("+$dayOffset day", $startTimestamp));

    for ($hour = 8; $hour <= 22; $hour++) {
        $slotTime = sprintf('%s %02d:00', $date, $hour);
        $slotTaken = false;

        foreach ($reservations as $res) {
            if (($res['date'] ?? '') === $date && ($res['field'] ?? '') === $field) {
                $resStart = strtotime($res['date'] . ' ' . $res['time']);
                $resDuration = (int)($res['duration'] ?? 60);
                $resEnd = $resStart + $resDuration * 60;

                $checkTime = strtotime($slotTime);
                if ($checkTime >= $resStart && $checkTime < $resEnd) {
                    $slotTaken = true;
                    break;
                }
            }
        }

        $output[$slotTime] = $slotTaken;
    }
}

echo json_encode($output);