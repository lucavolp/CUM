<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Comunicazione</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Benvenuto, <?php echo '<i>' . $_SESSION['username'] . '</i>'; ?></a>
        <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Dettagli della comunicazione</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" id="comunicazione-oggetto">Oggetto</h5>
                    <p class="card-text" id="comunicazione-contenuto">Contenuto</p>
                </div>
            </div>
            <a type="button" class="btn btn-warning back-button" href="./dashboard.php" name="Indietro" style="position:absolute; left:10px">Indietro</a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var id_comunicazione = '<?php echo $_GET['id']; ?>';
/*
        $.ajax({
            url: './ws/get_comunicazioni.php',
            type: 'GET',
            success: function(response) {
                //var comunicazioni = JSON.parse(response);
                //var comunicazione = comunicazioni.find(c => c.cod == id_comunicazione);
                console.log(response);

            
                if (response) {
                    $('#comunicazione-oggetto').append(
                                    '<p>' +
                                        response[0].oggetto
                                    + '</p>'
                                );
                    $('#comunicazione-contenuto').text(response.contenuto);
                } else {
                    $('.card-body').html('<h5 class="card-title">Comunicazione non trovata.</h5>');
                }
            },
            error: function() {
                $('.card-body').html('<h5 class="card-title">Errore nel recupero dei dettagli della comunicazione.</h5>');
            }
        });*/
        $.ajax({
                url: './ws/get_comunicazioni.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        $.each(data, function(index, item) {
                            if (item.cod==id_comunicazione) { 
                                $('#comunicazione-oggetto').append(
                                    '<p>' +
                                         item.oggetto +
                                    '</li>'
                                );
                                $('#comunicazione-contenuto').append(
                                    '<p>' +
                                         item.contenuto +
                                    '</li>'
                                );
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
    });
</script>

</body>
</html>
