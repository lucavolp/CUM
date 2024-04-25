<?php
header('Content-Type: application/json');

// Connessione al database (sostituisci con i tuoi dati)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "nome_database";

// Prendi i valori inviati dalla richiesta POST
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(array("message" => "Errore di connessione al database: " . $conn->connect_error));
    exit();
}

// Query per selezionare l'utente dal database
$sql = "SELECT * FROM utenti WHERE username = '$username' AND password = '$password'";
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