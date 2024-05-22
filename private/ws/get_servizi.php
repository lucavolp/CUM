<?php
session_start();


    //non so perche le assenze non le filtra bene


if (!isset($_SESSION['username'])) {
    header("Location: ../accesso2.html");
    exit();
}
$logged_in_username = $_SESSION['username'];
include("../../assets/db/dbconn.php");

if($logged_in_username=='admin'){
    $sql = "SELECT * FROM Servizio";
        //echo $logged_in_username;       //DEBUG
}else{
    $sql = "SELECT * FROM Servizio WHERE 'usr_pers' = '".$logged_in_username."'";
    //echo $logged_in_username;       //DEBUG
}

//$sql = "SELECT * FROM Assenza WHERE utente_usr='".$_SESSION['username']."'";

//$sql = "SELECT * FROM Servizio";
$result = $conn->query($sql);

$assenze = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $assenze[] = $row;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($assenze);
