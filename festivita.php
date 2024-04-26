<?php


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
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festivita Nazionali</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Festività Sammarinesi</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Mese</th>
                        <th>Data</th>
                        <th>Ricorrenza</th>
                    </tr>
                </thead>
                <tbody>
    <?php
        // Fetch festivity data from the web service
        $festivity_data = file_get_contents('WSfestivita.php'); // Replace 'your_web_service_url_here' with the actual URL of your web service
        $festivity_data = json_decode($festivity_data, true);

        foreach ($mesi as $numero_mese => $nome_mese) {
            if (isset($festivity_data[$numero_mese])) {
                foreach ($festivity_data[$numero_mese] as $festivity) {
                    echo '<tr>';
                    
                    echo '<td>' . $nome_mese . '</td>';
                    echo '<td>' . $festivity['data'] . '</td>';
                    echo '<td>' . $festivity['nome'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                
                echo '<td>' . $nome_mese . '</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
            }
        }
    ?>
</tbody>

            </table>
        </div>
    </div>
</div>



</body>
</html>
