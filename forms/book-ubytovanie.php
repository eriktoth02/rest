<?php
if (!isset($_POST['g-recaptcha-response'])) {
    die("reCAPTCHA nebola vyplnená.");
}
$secretKey = "";
$responseKey = $_POST['g-recaptcha-response'];
$userIP = $_SERVER['REMOTE_ADDR'];

$verifyURL = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
$response = file_get_contents($verifyURL);
$response = json_decode($response);

if (!$response->success) {
    die("reCAPTCHA overenie zlyhalo. Skúste to znova.");
}
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
