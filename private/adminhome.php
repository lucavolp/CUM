<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../accesso2.html");
    exit();
}

include("../assets/db/dbconn.php");

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
                        <ul class="list-group" id="servizi-list">
                            <li class="list-group-item">
                            <a href="./admin/addServizio.php">Aggiungi Servizio</a></li>
                            
                                <?php
                                /*
                                    if ($serv->num_rows > 0) {
                                        $nRighe=0;
                                        while (($row = $serv->fetch_assoc())&&($nRighe<=5)) {
                                            $edId= str_replace(' ', '_', $row['nome']);
                                            echo '<li class="list-group-item">';
                                            echo '
                                                    <a href="dett_ser.php?id=' . $edId . '">' . $row['nome'] . '</a>
                                                </li>';
                                            $nRighe++;
                                        }
                                    } else {
                                        echo '<li class="list-group-item">Nessun servizio svolto</li>';
                                    }
                                    */
                                ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
<!--
                    <div class="card-body">
                        <h4 class="card-title">Elenco delle comunicazioni</h4>
                        <ul class="list-group">
                        <li class="list-group-item">
                            <a href="./admin/addComunicazione.php">Aggiungi Comunicazione</a></li>
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
                            -->
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assenze</h4>
                        <ul class="list-group">
                        <li class="list-group-item">
                            <a href="./admin/addAssenza.php">Aggiungi Assenza</a></li>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script>
            
            
            $(document).ready(function() {

                
                $.ajax({
                url: './ws/get_servizi.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        var nRighe = 0;
                        $.each(data, function(index, item) {
                                var edId = item.nome.replace(' ', '_');
                                $('#servizi-list').append(
                                    '<li class="list-group-item">' +
                                        '<a href="dett_ser.php?id=' + edId + '">' + item.nome + '</a>' +
                                    '</li>'
                                );
                                nRighe++;
                            
                        });
                    } else {
                        $('#servizi-list').append('<li class="list-group-item">Nessun servizio svolto</li>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Errore durante la richiesta AJAX:', status, error);
                }
            });
                
            $.ajax({
                url: './ws/get_comunicazioni.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        var nRighe = 0;
                        $.each(data, function(index, item) {
                            if (nRighe < 5) {
                                $('#comunicazioni-list').append(
                                    '<li class="list-group-item">' +
                                        '<a href="dett_com.php?id=' + item.cod + '">' + item.oggetto + '</a>' +
                                    '</li>'
                                );
                                nRighe++;
                            }
                        });
                    } else {
                        $('#comunicazioni-list').append('<li class="list-group-item">Nessuna comunicazione trovata.</li>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Errore durante la richiesta AJAX:', status, error);
                }
            });

            $.ajax({
                url: './ws/get_assenze.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        var nRighe = 0;
                        $.each(data, function(index, item) {
                            if (nRighe < 5) {
                                $('#assenze-list').append(
                                    '<li class="list-group-item">' +
                                        '<a href="dett_com.php?id=' + item.cod + '">' + item.oggetto + '</a>' +
                                    '</li>'
                                );
                                nRighe++;
                            }
                        });
                    } else {
                        $('#assenze-list').append('<li class="list-group-item">Nessuna assenza segnalata</li>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Errore durante la richiesta AJAX:', status, error);
                }
            });
                
            
            
        })

            
        </script>
    </body>

    
</html>
