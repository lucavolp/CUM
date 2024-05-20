<?php
include("../assets/db/dbconn.php");

// Check if a search parameter is provided
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM Servizio";
if (!empty($search)) {
    $sql .= " WHERE nome LIKE '%" . $conn->real_escape_string($search) . "%'";
}

$result = $conn->query($sql);

$servizi = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $servizi[] = $row;
    }
}

echo json_encode($servizi);
$conn->close();
