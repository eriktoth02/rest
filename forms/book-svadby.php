<?php
include 'save_to_json.php';

$data = [
    "name" => $_POST['name'] ?? '',
    "email" => $_POST['email'] ?? '',
    "subject" => $_POST['subject'] ?? '',
    "message" => $_POST['message'] ?? ''
];

save_to_json("../data/rezervacie_svadby.json", $data);
echo "Rezervácia na svadbu bola uložená.";
?>
