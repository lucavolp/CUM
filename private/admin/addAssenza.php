<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../accesso2.html");
    exit();
}

$logged_in_username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Nuova Assenza</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="../dashboard.php">Benvenuto,  <?php echo '<i>'.$logged_in_username.'</i>'; ?></a>
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
                        <form id="addAssenzaForm1">
                            <div class="form-group">
                                <label for="nome">Dettagli e motivazione:</label>
                                <input type="text" class="form-control" id="dettagli" name="dettagli" required>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input name="data" id="data" class="form-control datepicker" placeholder="Data Assenza" autocomplete="off" required>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-warning" id="continua">Assegna a</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4" style="display: none" id="secondo">
        <div class="row">
            <div class="col-md-12">
                <h2>Assegna Assenza</h2>
                <div class="card">
                    <div class="card-body">
                        <form id="addAssenzaForm2">
                            <div class="form-group">
                                <label>Seleziona Utente:</label>
                                <div id="users-container">
                                    
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Conferma Assegnazione</button>
                        </form>
                    </div>
                </div>
                <button type="button" class="btn btn-warning" id="ind">Indietro</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>

$(document).ready(function(){
    // Initialize the datepicker
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });
});


$('#continua').click(function() {
    var dettagli = $('#dettagli').val();
    var data = $('#data').val();

    var formData = {
        dettagli: dettagli,
        data: data,
    };

    $('#secondo').data('formData', formData);

    $('#primo').hide();
    $('#secondo').show();

    $.ajax({
        url: '../ws/get_users.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var usersContainer = $('#users-container');
            usersContainer.empty();
            $.each(data, function(index, user) {
                usersContainer.append(
                    '<div class="form-check">' +
                        '<input class="form-check-input" type="checkbox" value="' + user.usr + '" id="user' + user.usr + '">' +
                        '<label class="form-check-label" for="user' + user.usr + '">' +
                            user.nome + ' ' + user.cognome +
                        '</label>' +
                    '</div>'
                );
            });
        },
        error: function(xhr, status, error) {
            console.error('Errore durante la richiesta AJAX:', status, error);
        }
    });
});

$('#addAssenzaForm2').submit(function(event) {
    event.preventDefault();

    var formData = $('#secondo').data('formData');

    formData = formData || {}; 

    var selectedUsers = [];
    $('#users-container input:checked').each(function() {
        selectedUsers.push($(this).val());
    });

    formData.selectedUsers = selectedUsers;

    $.ajax({
        url: 'WSaddAssenza.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        success: function(response) {
            console.log(response);

        },
        error: function(xhr, status, error) {
            console.error('Errore durante la richiesta AJAX:', status, error);
            alert('Si è verificato un errore durante l\'aggiunta del servizio. Si prega di riprovare.');
        }
    });

    console.log('Utenti selezionati:', selectedUsers);
});

$('#ind').click(function() {
    $('#primo').show();
    $('#secondo').hide();
});




</script>
</body>
</html>