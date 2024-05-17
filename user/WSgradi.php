<?php

    include("../assets/db/dbconn.php");
    $sql = "SELECT * FROM Grado";
    $result = $conn->query($sql);

    $gradi = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $gradi[] = $row["grado"];
        }
    } else {
        $gradi[] = "Nessun risultato trovato";
    }

    echo json_encode($gradi);

    $conn->close();