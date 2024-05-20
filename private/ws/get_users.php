<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../accesso2.html");
    exit();
}

include("../../assets/db/dbconn.php");

$sql = "SELECT usr, nome, cognome FROM Utente";  // Modifica questa query in base alla tua tabella degli utenti
$result = $conn->query($sql);

$users = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($users);
?>
