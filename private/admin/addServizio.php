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
    <title>Aggiungi Nuovo Servizio</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Benvenuto,  <?php echo '<i>'.$logged_in_username.'</i>'; ?></a>
            <a class="btn btn-danger" href="../logout.php">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="container" id="primo">
                <h2>Aggiungi Nuovo Servizio</h2>
                <div class="card">
                    <div class="card-body">
                        
                            <form id="addServizioForm1">
                                <div class="form-group">
                                    <label for="nome">Nome Servizio:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                </div>
                                <div class="form-group">
                                    <label for="gettone">Gettone (Euro):</label>
                                    <input type="number" step="0.50" class="form-control" id="gettone" name="gettone" required>
                                </div>
                                <div class="form-group">
                                    <label for="ore_durata">Durata (Ore):</label>
                                    <input type="number" step="0.50" class="form-control" id="ore_durata" name="ore_durata" required>
                                </div>
                                <div class="form-group">
                                    <label for="min_persone">Numero Persone (minimo)</label>
                                    <input type="number" step="1" class="form-control" id="min_persone" name="min_persone" required>
                                </div>
                                <div class="form-group">
                                    <label for="luogo">Luogo:</label>
                                    <input type="text" class="form-control" id="luogo" name="luogo" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Aggiungi Servizio</button>
                                <button type="button" class="btn btn-warning" id="continua" name="continua">Assegna a</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-4" style="display: none" id="secondo">
        <div class="row">
            <div class="col-md-12">
                <h2>Aggiungi Nuovo Servizio</h2>
                <div class="card">
                    <div class="card-body">
                        <form id="addServizioForm2">
                            
                            <button type="submit" class="btn btn-primary">Aggiungi Servizio</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#continua').click(function() {
                        $('#primo').hide();
                        $('#secondo').show();
                });

            $('#addServizioForm1').submit(function(event) {
                event.preventDefault();
                
                var nome = $('#nome').val();
                var gettone = $('#gettone').val();
                var ore_durata = $('#ore_durata').val();
                var min_persone = $('#min_persone').val();
                var luogo = $('#luogo').val();


                var url = 'WSaddservizio.php';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: JSON.stringify({ nome: nome, gettone: gettone, ore_durata:ore_durata, min_persone:min_persone, luogo:luogo}),
                    //data: form.serialize(),
                    success: function(response) {
                        //window.location.href = '../dett_ser.php?id=' + response.nome;
                        console.log(response.nome);
                    },
                    error: function(xhr, status, error) {
                        console.error('Errore durante la richiesta AJAX:', status, error);
                        alert('Si è verificato un errore durante l\'aggiunta del servizio. Si prega di riprovare.');
                    }
                });
            });
        });
    </script>

    </body>
</html>