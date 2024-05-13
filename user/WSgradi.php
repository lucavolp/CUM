<?php

    include("../assets/db/dbconn.php");

/*
    $sql = "SELECT * FROM Grado";
    $result = $conn->query($sql);
    $grouped_data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $gradi[] = $row;
        }
        echo json_encode($gradi);
        } else {
            echo json_encode(array("message" => "Nessun grado trovato nel database"));
        }





    $conn->close();

    header('Content-Type: application/json');
    $json_formato = json_encode($grouped_data);
    echo $json_formato;



    <?php
    */
    // Connessione al database

    // Query per recuperare i dati dalla tabella 'grado'
    $sql = "SELECT * FROM Grado";
    $result = $conn->query($sql);

    // Array per memorizzare i risultati
    $gradi = array();

    // Iterazione sui risultati della query e aggiunta dei dati all'array
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $gradi[] = $row["grado"];
        }
    } else {
        $gradi[] = "Nessun risultato trovato";
    }

    // Converti l'array in formato JSON
    echo json_encode($gradi);

    // Chiusura della connessione al database
    $conn->close();