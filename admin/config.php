<?php
$host = "localhost";
$user = "root"; // tvoje DB meno
$pass = "";     // tvoje DB heslo
$dbname = "tvojadatabaza";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Chyba pripojenia: " . $conn->connect_error);
}
?>