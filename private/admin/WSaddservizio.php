<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include("../../assets/db/dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    $nome = $data["nome"];
    $gettone = $data["gettone"];
    $ore_durata = $data["ore_durata"];
    $min_persone = $data["min_persone"];
    $luogo = $data["luogo"];
    $usr_pers = $data["usr_pers"];


    if (isset($data['nome']) && isset($data['gettone']) && isset($data['ore_durata']) && isset($data['luogo']) && isset($data['min_persone'])) {
        
        //sta roba serve per evitare iniezioni sql
        /*
            $nome = $conn->real_escape_string($data['nome']);
            $gettone = $conn->real_escape_string($data['gettone']);
            $ore_durata = $conn->real_escape_string($data['ore_durata']);
            $luogo = $conn->real_escape_string($data['luogo']);
        */

        $sql = "INSERT INTO `Servizio` (`nome`, `min_persone`, `ore_durata`, `luogo`, `gettone`, `usr_pers`) VALUES ('$nome', '$min_persone', '$ore_durata', '$luogo', '$gettone', '$usr_pers')";

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
