<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../accesso2.html");
    exit();
}

include("../../assets/db/dbconn.php");

$sql = "SELECT * FROM Comunicazione";
$result = $conn->query($sql);

$comunicazioni = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $comunicazioni[] = $row;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($comunicazioni);
