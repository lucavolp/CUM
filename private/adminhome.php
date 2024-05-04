<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../accesso2.html");
    exit();
}

$servername = "10.25.0.14";
$dbusername = "5cvolpinari";
$dbpassword = "5cvolpinari";
$dbname = "5cvolpinari_milizia";


// $servername = "192.168.1.152";
// $dbusername = "username";
// $dbpassword = "password";
// $dbname = "5cvolpinari_milizia";


$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$logged_in_username = $_SESSION['username'];

$sql = "SELECT * FROM Comunicazione";
$comun = $conn->query($sql);
$sql = "SELECT * FROM Servizio";
$serv = $conn->query($sql);
$sql = "SELECT * FROM Assenza";
$assen = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pagina Protetta</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .navbar-brand {
                font-weight: bold;
                font-size: 24px;
            }
            .card-title {
                font-weight: bold;
                font-size: 20px;
            }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Benvenuto, <?php echo '<i>'.$logged_in_username.'</i>'; ?></a>
            <a class="btn btn-danger" href="logout.php">Logout</a>
        </div>
    </nav>
    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Servizi</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                            <a href="addServizio.php">Aggiungi Servizio</a>
                                <?php
                                    if ($serv->num_rows > 0) {
                                        $nRighe=0;
                                        while (($row = $serv->fetch_assoc())&&($nRighe<=5)) {
                                            $edId= str_replace(' ', '_', $row['nome']);
                                            //echo '<li class="list-group-item">
                                            echo '
                                                    <a href="dett_ser.php?id=' . $edId . '">' . $row['nome'] . '</a>
                                                </li>';
                                            $nRighe++;
                                        }
                                    } else {
                                        echo '<li class="list-group-item">Nessun servizio svolto</li>';
                                    }
                                ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Elenco delle comunicazioni</h4>
                        <ul class="list-group">
                            <?php
                                if ($comun->num_rows > 0) {
                                    $nRighe=0;
                                    while (($row = $comun->fetch_assoc())&&($nRighe<=5)) {
                                        echo '<li class="list-group-item">
                                                <a href="dett_com.php?id='.$row['cod'].'">'.$row['oggetto'].'</a>
                                            </li>';
                                            $nRighe++;
                                            if($nRighe==5){
                                                echo '<li class="list-group-item"><a href="dett_com.php?id=';
                                            }
                                    }
                                } else {
                                    echo '<li class="list-group-item">Nessuna comunicazione trovata.</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assenze</h4>
                        <ul class="list-group">
                            <?php
                                if ($assen->num_rows > 0) {
                                    $nRighe=0;
                                    while (($row = $assen->fetch_assoc())&&($nRighe<=5)) {
                                        echo '<li class="list-group-item"><a href="dett_com.php?id=' . $row['cod'] . '">' . $row['oggetto'] . '</a></li>';
                                        $nRighe++;
                                        
                                    }
                                } else {
                                    echo '<li class="list-group-item">Nessuna assenza segnalata</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>
