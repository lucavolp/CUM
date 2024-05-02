<?php
session_start();
header('Content-Type: application/json');

$servername = "192.168.1.152";
$dbusername = "username";
$dbpassword = "password";
$dbname = "5cvolpinari_milizia";

$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(array("message" => "Errore di connessione al database: " . $conn->connect_error));
    exit();
}

$sql = "SELECT * FROM Utente WHERE usr = '$username' AND pwd = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username']=$username;
    echo json_encode(array("message" => "Login effettuato con successo"));
} else {
    http_response_code(401);
    echo json_encode(array("message" => "Credenziali non valide"));
}

$conn->close();