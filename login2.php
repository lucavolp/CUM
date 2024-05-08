<?php
session_start();
header('Content-Type: application/json');

// Funzione per controllare le credenziali dell'utente nel database
function authenticateUser($username, $password) {
    //$servername = "10.25.0.14"; // Modifica con il tuo indirizzo del server
    //$dbusername = "5cvolpinari"; // Modifica con il tuo nome utente del database
    //$dbpassword = "5cvolpinari"; // Modifica con la tua password del database
    //$dbname = "5cvolpinari_milizia"; // Modifica con il nome del tuo database


    $servername = "192.168.1.152";
    $dbusername = "username";
    $dbpassword = "password";
    $dbname = "5cvolpinari_milizia";
    
    // Connessione al database
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        return array("success" => false, "message" => "Errore di connessione al database: " . $conn->connect_error);
    }

    // Query per verificare le credenziali dell'utente
    $sql = "SELECT * FROM Utente WHERE usr = '$username' AND pwd = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        return array("success" => true, "message" => "Login effettuato con successo");
    } else {
        return array("success" => false, "message" => "Credenziali non valide");
    }

    
}

// Verifica se è stata inviata una richiesta POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se i dati sono stati inviati correttamente come JSON
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if ($data === null) {
        echo json_encode(array("success" => false, "message" => "Dati JSON non validi"));
        $conn->close();
        exit();
    }

    // Verifica se sono presenti i campi username e password
    if (!isset($data["username"]) || !isset($data["password"])) {
        echo json_encode(array("success" => false, "message" => "Campi username e password richiesti"));
        $conn->close();
        exit();
    }

    // Ottieni username e password dalla richiesta
    $username = $data["username"];
    $password = $data["password"];

    // Autentica l'utente
    $authentication_result = authenticateUser($username, $password);

    // Restituisci il risultato dell'autenticazione come JSON
    echo json_encode($authentication_result);
} else {
    // Se la richiesta non è di tipo POST, restituisci un errore
    echo json_encode(array("success" => false, "message" => "Richiesta non valida"));
    $conn->close();
}

