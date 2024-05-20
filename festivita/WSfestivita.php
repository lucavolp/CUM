<?php
/*
include("../assets/db/dbconn.php");
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


$sql = "SELECT * FROM Festivita";
$result = $conn->query($sql);
$grouped_data = array();

$k = -1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = $row["num_mese"];
        if ($k != 0) {
            //echo "ciao";
            $grouped_data[$month] = null;
            $k++;
        }
        if (is_null($grouped_data[$month])) {
            //echo "punto1 ".$k;
            $month = $row["num_mese"];
            $lastM = $row["num_mese"];
            $grouped_data[$month] = array(
                'mese' => $mesi[intval($month)],
                'data' => $row['data'],
                'nome' => $row['nome'],
                'id' => $row['id']
            );
            $k++;
        } else {
            // Controlla se il mese corrente è già presente nell'array $grouped_data
            while (array_key_exists($month, $grouped_data)) {
                $month++;
            }
            //echo "punto2 ".$k;
            $grouped_data[$month] = array(
                'mese' => $mesi[intval($month - 1)],
                'data' => $row['data'],
                'nome' => $row['nome'],
                'id' => $row['id']
            );
        }
    }
}



$conn->close();

header('Content-Type: application/json');
$json_formato = json_encode($grouped_data);
echo $json_formato;
*/


include("../assets/db/dbconn.php");

$mesi = [
    1 => "Gennaio",
    2 => "Febbraio",
    3 => "Marzo",
    4 => "Aprile",
    5 => "Maggio",
    6 => "Giugno",
    7 => "Luglio",
    8 => "Agosto",
    9 => "Settembre",
    10 => "Ottobre",
    11 => "Novembre",
    12 => "Dicembre"
];

$sql = "SELECT * FROM Festivita";
$result = $conn->query($sql);
$grouped_data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = intval($row["num_mese"]);
        if (!isset($grouped_data[$month])) {
            $grouped_data[$month] = array(
                'mese' => $mesi[$month],
                'eventi' => array()
            );
        }
        $grouped_data[$month]['eventi'][] = array(
            'data' => $row['data'],
            'nome' => $row['nome'],
            'id' => $row['id']
        );
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($grouped_data);