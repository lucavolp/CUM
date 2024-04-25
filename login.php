<?php
header('Content-Type: application/json');

// Connessione al database (sostituisci con i tuoi dati)
$servername = "192.168.1.152";
$dbusername = "username";
$dbpassword = "password";
$dbname = "5cvolpinari_milizia";

// Prendi i valori inviati dalla richiesta POST
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(array("message" => "Errore di connessione al database: " . $conn->connect_error));
    exit();
}

// Query per selezionare l'utente dal database
$sql = "SELECT * FROM Utente WHERE usr = '$username' AND pwd = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Le credenziali sono corrette, l'utente è autenticato
    echo json_encode(array("message" => "Login effettuato con successo"));
} else {
    // Credenziali non valide
    http_response_code(401);
    echo json_encode(array("message" => "Credenziali non valide"));
}

// Chiudi la connessione al database
$conn->close();
?>