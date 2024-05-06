<?php

$servername = "10.25.0.14";
$dbusername = "5cvolpinari";
$dbpassword = "5cvolpinari";
$database = "5cvolpinari_milizia";

// $servername = "192.168.1.152";
// $dbusername = "username";
// $dbpassword = "password";
// $database = "5cvolpinari_milizia";

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


$sql = "SELECT * FROM Festivita";
$result = $conn->query($sql);
$grouped_data = array();
// $k=0;
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         if($k===0){
//             $month = $row["num_mese"];
//             $grouped_data[$month]=null;
//             $k++;
//         }
//         if(is_null($grouped_data[$month])){
//             // echo "<script>console.log('ciao');</script>";
//             $month = $row["num_mese"];
//             $lastM = $row["num_mese"];
//             $grouped_data[$month] = array(
//                 'mese' => $mesi[intval($month)],
//                 'data' => $row['data'],
//                 'nome' => $row['nome'],
//                 'id' => $row['id']
//             );
//         }else{
//             $month++;
//             $grouped_data[$month] = array(
//             'mese' => $mesi[intval($month-1)],
//             'data' => $row['data'],
//             'nome' => $row['nome'],
//             'id' => $row['id']
//             );
//         }
        
//     }
    
// }

$k = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = $row["num_mese"];
        if ($k === 0) {
            $grouped_data[$month] = null;
            $k++;
        }
        if (is_null($grouped_data[$month])) {
            $month = $row["num_mese"];
            $lastM = $row["num_mese"];
            $grouped_data[$month] = array(
                'mese' => $mesi[intval($month)],
                'data' => $row['data'],
                'nome' => $row['nome'],
                'id' => $row['id']
            );
        } else {
            // Controlla se il mese corrente è già presente nell'array $grouped_data
            while (array_key_exists($month, $grouped_data)) {
                $month++;
            }
            
            $grouped_data[$month] = array(
                'mese' => "ciaoo",//$mesi[intval($month - 1)],
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
