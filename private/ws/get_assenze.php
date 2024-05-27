<?php
include("../../assets/db/dbconn.php");

// Check if a search parameter is provided
$search = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "SELECT * FROM Assenza";
if (!empty($search)) {
    $sql .= " WHERE 'id' = " . $search . "";
}

$result = $conn->query($sql);

$assenze = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $assenze[] = $row;
    }
}

echo json_encode($assenze);
$conn->close();