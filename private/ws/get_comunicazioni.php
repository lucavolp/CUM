<?php
include("../assets/db/dbconn.php");

// Check if a search parameter is provided
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM Comunicazione";
if (!empty($search)) {
    $sql .= " WHERE oggetto LIKE '%" . $conn->real_escape_string($search) . "%'";
}

$result = $conn->query($sql);

$comunicazioni = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $comunicazioni[] = $row;
    }
}

echo json_encode($comunicazioni);
$conn->close();
