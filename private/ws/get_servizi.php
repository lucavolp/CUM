<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../accesso2.html");
    exit();
}

include("../../assets/db/dbconn.php");

//$sql = "SELECT * FROM Assenza WHERE utente_usr='".$_SESSION['username']."'";
$sql = "SELECT * FROM Servizio";
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
