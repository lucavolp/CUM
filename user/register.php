<?php
session_start();
header('Content-Type: application/json');

function registerUser($usr, $pass, $nome, $cognome, $mail, $cell, $dataN, $dataA, $grado, $pa) {

    
    include("../assets/db/dbconn.php");

    $crPsw=crypt($pass, PASSWORD_DEFAULT);          //d'ora in poi la password viene utilizzata criptata
    $sql = "SELECT * FROM Utente WHERE usr = '$usr'";
    $result = $conn->query($sql);

    if ($result->num_rows <= 0) {
        if($usr!="admin"){
            //if($pa==1)                    //NON FUNZIONA LA COSA DELLA PA
                $pa=true;
            $sql = "INSERT INTO `Utente` (`usr`, `pwd`, `nome`, `cognome`, `mail`, `cellulare`, `data_nascita`, `data_arruolo`, `id_grado`, `PA`, `id_ruolo`) VALUES ('$usr', '$crPsw', '$nome', '$cognome', '$mail', '$cell', $dataN, $dataA, $grado, $pa, 2);";
            $result = $conn->query($sql);
            //echo $sql;
            return array("success" => true, "message" => "Utente Creato", "risultato query" => $result);
        }else{
            return array("success" => false, "message" => "Username già in utilizzo", "result" => $result);
        }
    } else {
        return array("success" => false, "message" => "Username già in utilizzo");
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("../assets/db/dbconn.php");
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    $username = $data["username"];
    $password = $data["password"];
    $nome = $data["nome"];
    $cognome = $data["cognome"];
    $mail = $data["mail"];
    $cellulare = $data["cellulare"];
    $dataN = $data["dataN"];
    $dataA = $data["dataA"];
    $grado = $data["grado"];
    $pa = $data["pa"];

    if ($data === null) {
        echo json_encode(array("success" => false, "message" => "Dati JSON non validi"));
        $conn->close();
        exit();
    }

    if (!isset($data["username"]) || !isset($data["password"])) {
        echo json_encode(array("success" => false, "message" => "Almeno Campi username e password richiesti"));
        $conn->close();
        exit();
    }

    

    $registrazione_result = registerUser($username, $password, $nome, $cognome, $mail, $cellulare, $dataN, $dataA, $grado, $pa);

    echo json_encode($registrazione_result);
} else {
    echo json_encode(array("success" => false, "message" => "Richiesta non valida"));
    $conn->close();
}

