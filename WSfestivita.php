<?php
$servername = "192.168.1.152";
$dbusername = "username";
$dbpassword = "password";
$database = "5cvolpinari_milizia";

$conn = new mysqli($servername, $dbusername, $dbpassword, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mesi = [
    1=> "gennaio",
    2=> "febbraio",
    3=> "marzo",
    4=> "aprile",
    5=> "maggio",
    6=> "giugno",
    7=> "luglio",
    8=> "agosto",
    9=> "settembre",
    10=> "ottobre",
    11=> "novembre",
    12=> "dicembre"
];


$sql = "SELECT * FROM festivita";
$result = $conn->query($sql);
$grouped_data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = $row["num_mese"];
        $grouped_data[$month][] = array(
            'mese' => $mesi[intval($month)],
            'data' => $row['data'],
            'nome' => $row['nome']
        );
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($grouped_data);
