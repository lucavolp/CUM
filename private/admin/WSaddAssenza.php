<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include("../../assets/db/dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nome']) && isset($_POST['gettone']) && isset($_POST['ore_durata']) && isset($_POST['luogo']) && isset($_POST['min_persone'])) {
        //sta roba serve per evitare iniezioni sql
        $nome = $conn->real_escape_string($_POST['nome']);
        $gettone = $conn->real_escape_string($_POST['gettone']);
        $ore_durata = $conn->real_escape_string($_POST['ore_durata']);
        $luogo = $conn->real_escape_string($_POST['luogo']);

        $sql = "INSERT INTO Assenza (data, dettagli, utente_usr, is_tipologia) VALUES ('$min_persone', '$ore_durata', '$luogo', '$gettone')";

        if ($conn->query($sql) === TRUE) {
            $response = array('id' => $conn->insert_id);
            echo json_encode($response);
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo "1 Errore nell'inserimento del servizio: " . $conn->error;
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo "2 Si è verificato un errore. Assicurati di compilare tutti i campi.";
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo "3 Metodo non consentito.";
}

$conn->close();