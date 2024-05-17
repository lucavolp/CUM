<?php
session_start();
header('Content-Type: application/json');

function registerUser($usr, $pass, $nome, $cognome, $mail, $cell, $dataN, $grado, $pa) {


    include("../assets/db/dbconn.php");

    $crPsw=crypt($pass, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM Utente WHERE usr = '$usr' AND pwd = '$crPsw'";
    $result = $conn->query($sql);


    /*
        funziona la verifica se esiste gia un utente con lo stesso username
        - bisogna far la query d'inserimento
    */








    if ($result->num_rows <= 0) {
        $_SESSION['username'] = $usr;
        if($usr=="admin"){
            $admin=true;
        }else{
            $admin=false;
        }
        return array("success" => true, "message" => "Login effettuato con successo", "admin" => $admin);
    } else {
        return array("success" => false, "message" => "Username già in utilizzo");
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

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

    $username = $data["username"];
    $password = $data["password"];
    $nome = $data["nome"];
    $cognome = $data["cognome"];
    $mail = $data["mail"];
    $cellulare = $data["cellulare"];
    $dataN = $data["dataN"];
    $grado = $data["grado"];
    $pa = $data["pa"];

    $registrazione_result = registerUser($username, $password, $nome, $cognome, $mail, $cellulare, $dataN, $grado, $pa);

    echo json_encode($registrazione_result);
} else {
    echo json_encode(array("success" => false, "message" => "Richiesta non valida"));
    $conn->close();
}

