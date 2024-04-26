<?php
// Database connection settings
$servername = "192.168.1.152";
$dbusername = "username"; // Replace with your MySQL username
$dbpassword = "password"; // Replace with your MySQL password
$database = "5cvolpinari_milizia"; // Replace with your MySQL database name

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



// Fetch data from database grouped by month
$sql = "SELECT * FROM festivita";
$result = $conn->query($sql);

// Initialize array to hold grouped data
$grouped_data = array();

// Loop through each row in the result set
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Extract month from date
        $month = $row["num_mese"];
        //$date = date_create($row['data']);
        //$month = date_format($date, 'm');

        // Add data to the corresponding month in the grouped array
        $grouped_data[$month][] = array(
            'mese' => $mesi[intval($month)],
            'data' => $row['data'],
            'nome' => $row['nome']
        );
    }
}

// Close database connection
$conn->close();

// Return grouped data as JSON
header('Content-Type: application/json');
echo json_encode($grouped_data);
