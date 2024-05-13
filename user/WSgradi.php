<?php

    include("../assets/db/dbconn.php");


    $sql = "SELECT * FROM Grado";
    $result = $conn->query($sql);
    $grouped_data = array();

    $k = 0;
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
