<?php
// Bezpečné ukladanie rezervácie ihriska s kontrolou na duration

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $date = $_POST['date'] ?? '';
    $field = $_POST['pitch'] ?? '';
    $time = $_POST['time'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $note = $_POST['message'] ?? '';

    if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($field) || empty($time) || empty($duration)) {
        die("Chyba: všetky polia musia byť vyplnené.");
    }

    // Overenie formátu času (15 min sloty)
    if (!preg_match('/^\d{2}:\d{2}$/', $time)) {
        die("Chyba: nesprávny formát času.");
    }

    list($hour, $minute) = explode(':', $time);
    if ($minute % 15 !== 0) {
        die("Chyba: čas musí byť v 15 minútových intervaloch.");
    }

    // Kontrola duration
    $duration = (int)$duration;
    if ($duration <= 0 || $duration > 480) { // max 8 hodín (bezpečnosť)
        die("Chyba: trvanie musí byť v rozsahu 1 - 480 minút.");
    }

    $file = "../data/rezervacie_ihriska.json";
    $reservations = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    $new_start = strtotime($date . ' ' . $time);
    $new_end = $new_start + $duration * 60;

    // Kontrola na kolíziu s existujúcimi rezerváciami
    foreach ($reservations as $res) {
        if (($res['date'] ?? '') === $date && ($res['field'] ?? '') === $field) {
            $existing_start = strtotime($res['date'] . ' ' . $res['time']);
            $existing_duration = (int)($res['duration'] ?? 60);
            $existing_end = $existing_start + $existing_duration * 60;

            // Ak sa časy prekrývajú
            if ($new_start < $existing_end && $existing_start < $new_end) {
                die("Tento termín sa prekrýva s existujúcou rezerváciou. Prosím vyberte iný čas.");
            }
        }
    }

    // Uloženie rezervácie
    $reservations[] = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'field' => $field,
        'date' => $date,
        'time' => $time,
        'duration' => $duration,
        'note' => $note
    ];

    file_put_contents($file, json_encode($reservations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "Rezervácia ihriska bola úspešne uložená.";
} else {
    die("Neplatná požiadavka.");
}
?>
