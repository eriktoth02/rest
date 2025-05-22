<?php
include 'save_to_json.php';

$data = [
    "name" => $_POST['name'] ?? '',
    "email" => $_POST['email'] ?? '',
    "subject" => $_POST['subject'] ?? '',
    "date_from" => $_POST['date_from'] ?? '',
    "date_to" => $_POST['date_to'] ?? '',
    "message" => $_POST['message'] ?? ''
];

save_to_json("../data/rezervacie_ubytovanie.json", $data);
echo "OK";
?>
