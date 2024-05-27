<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../accesso2.html");
    exit();
}

$logged_in_username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Protetta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../media/logoSfondo.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
        }
        .card-title {
            font-weight: bold;
            font-size: 20px;
        }
        .card {
            background: rgba(255, 255, 255, 0.8); 
            border-radius: 10px;
        }
        .container {
            margin-top: 20px;
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
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Elenco delle comunicazioni</h4>
                        <ul class="list-group" id="comunicazioni-list">
                        </ul>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assenze</h4>
                        <ul class="list-group" id="assenze-list">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                            if (nRighe < 5) {
                                var edId = item.nome.replace(' ', '_');
                                $('#servizi-list').append(
                                    '<li class="list-group-item">' +
                                        '<a href="dett_ser.php?id=' + edId + '">' + item.nome + '</a>' +
                                    '</li>'
                                );
                                nRighe++;
                            }
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
                        $('#comunicazioni-list').append('<li class="list-group-item">Nessuna comunicazione trovata</li>');
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
                                        '<a href="dett_ass.php?id=' + item.cod + '">' + "Assenza n° " + item.id + '</a>' +
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
        });
    </script>
</body>
</html>
