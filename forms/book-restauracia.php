<?php
include 'save_to_json.php';

$data = [
    "name" => $_POST['name'] ?? '',
    "email" => $_POST['email'] ?? '',
    "phone" => $_POST['phone'] ?? '',
    "date" => $_POST['date'] ?? '',
    "time" => $_POST['time'] ?? '',
    "people" => $_POST['people'] ?? '',
    "message" => $_POST['message'] ?? ''
];

save_to_json("../data/rezervacie_restauracia.json", $data);
echo "OK";
?>
