<?php
session_start();
header('Content-Type: application/json');

function registerUser($usr, $pass) {


    include("../assets/db/dbconn.php");
/*
    $crPsw=crypt($pass, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM Utente WHERE usr = '$usr' AND pwd = '$crPsw'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $usr;
        if($usr=="admin"){
            $admin=true;
        }else{
            $admin=false;
        }
        return array("success" => true, "message" => "Login effettuato con successo", "admin" => $admin);
    } else {
        return array("success" => false, "message" => "Credenziali non valide");
    }
    */
    return(""); //per non avere warning adesso
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


    $registrazione_result = registerUser($username, $password);

    echo json_encode($authentication_result);
} else {
    echo json_encode(array("success" => false, "message" => "Richiesta non valida"));
    $conn->close();
}

