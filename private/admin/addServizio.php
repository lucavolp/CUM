<?php
/*
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
    <title>Aggiungi Nuovo Servizio</title>
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
                                <button class="btn btn-warning" id="continua" name="continua">Assegna a</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4" style="display: none" id="secondo">
            <div class="row">
                <div class="col-md-12">
                    <h2>Assegna Servizio agli Utenti</h2>
                    <div class="card">
                        <div class="card-body">
                            <form id="addServizioForm2">
                                <div class="form-group">
                                    <label>Seleziona Utenti:</label>
                                    <div id="users-container">
                                        <!-- I checkbox verranno inseriti qui tramite JavaScript -->
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Conferma Assegnazione</button>
                            </form>
                        </div>
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
                
                // Carica gli utenti
                $.ajax({
                    url: '../ws/get_users.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var usersContainer = $('#users-container');
                        var index = 1;
                        $.each(data, function(index, user) {
                            usersContainer.append(
                                '<div class="form-check">' +
                                    '<input class="form-check-input" type="checkbox" value="' + user.usr + '" id="user' + user.usr + '">' +
                                    '<label class="form-check-label" for="user' + user.id + '">' +
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

            $('#addServizioForm1').submit(function(event) {
                event.preventDefault();
                
                var nome = $('#nome').val();
                var gettone = $('#gettone').val();
                var ore_durata = $('#ore_durata').val();
                var min_persone = $('#min_persone').val();
                var luogo = $('#luogo').val();

                $.ajax({
                    url: 'WSaddservizio.php',
                    type: 'POST',
                    data: JSON.stringify({ nome: nome, gettone: gettone, ore_durata: ore_durata, min_persone: min_persone, luogo: luogo }),
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Errore durante la richiesta AJAX:', status, error);
                        alert('Si è verificato un errore durante l\'aggiunta del servizio. Si prega di riprovare.');
                    }
                });
            });

            $('#addServizioForm2').submit(function(event) {
                event.preventDefault();
                
                var nome = $('#nome').val();
                var gettone = $('#gettone').val();
                var ore_durata = $('#ore_durata').val();
                var min_persone = $('#min_persone').val();
                var luogo = $('#luogo').val();
                var selectedUsers = [];
                $('#users-container input:checked').each(function() {
                    selectedUsers.push($(this).val());
                });



                // Logica per assegnare il servizio agli utenti selezionati





                        //////////////////////////////
                        event.preventDefault();
                
                var nome = $('#nome').val();
                var gettone = $('#gettone').val();
                var ore_durata = $('#ore_durata').val();
                var min_persone = $('#min_persone').val();
                var luogo = $('#luogo').val();
                

                $.ajax({
                    url: 'WSaddservizio.php',
                    type: 'POST',
                    data: JSON.stringify({ nome: nome, gettone: gettone, ore_durata: ore_durata, min_persone: min_persone, luogo: luogo, selectedUserss:selectedUsers}),
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Errore durante la richiesta AJAX:', status, error);
                        alert('Si è verificato un errore durante l\'aggiunta del servizio. Si prega di riprovare.');
                    }
                });
                        //////////////////////////////





                console.log('Utenti selezionati:', selectedUsers);
            });
        });
    </script>
</body>
</html>
*/
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
    <title>Aggiungi Nuovo Servizio</title>
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
                <h2>Assegna Servizio agli Utenti</h2>
                <div class="card">
                    <div class="card-body">
                        <form id="addServizioForm2">
                            <div class="form-group">
                                <label>Seleziona Utenti:</label>
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
<script>
    /*
$(document).ready(function() {
    $('#continua').click(function() {
        $('#primo').hide();
        $('#secondo').show();

        // Carica gli utenti
        $.ajax({
            url: '../ws/get_users.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var usersContainer = $('#users-container');
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

    $('#addServizioForm1').submit(function(event) {
        event.preventDefault();

        var nome = $('#nome').val();
        var gettone = $('#gettone').val();
        var ore_durata = $('#ore_durata').val();
        var min_persone = $('#min_persone').val();
        var luogo = $('#luogo').val();

        // Salva i dati del servizio nel form nascosto
        $('#secondo').data('formData', {
            nome: nome,
            gettone: gettone,
            ore_durata: ore_durata,
            min_persone: min_persone,
            luogo: luogo
        });
        $('#continua').trigger('click');
    });

    $('#addServizioForm2').submit(function(event) {
        event.preventDefault();

        var formData = $('#secondo').data('formData');
        var selectedUsers = [];
        $('#users-container input:checked').each(function() {
            selectedUsers.push($(this).val());
        });
        
        formData.selectedUsers = selectedUsers; //errore 

        $.ajax({
            url: 'WSaddservizio.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                console.log(response);
                // Redirect or show a success message
            },
            error: function(xhr, status, error) {
                console.error('Errore durante la richiesta AJAX:', status, error);
                alert('Si è verificato un errore durante l\'aggiunta del servizio. Si prega di riprovare.');
            }
        });

        console.log('Utenti selezionati:', selectedUsers);
    });
});*/
$('#continua').click(function() {
    var nome = $('#nome').val();
    var gettone = $('#gettone').val();
    var ore_durata = $('#ore_durata').val();
    var min_persone = $('#min_persone').val();
    var luogo = $('#luogo').val();

    var formData = {
        nome: nome,
        gettone: gettone,
        ore_durata: ore_durata,
        min_persone: min_persone,
        luogo: luogo
    };

    // Memorizza i dati nel container del secondo form
    $('#secondo').data('formData', formData);

    $('#primo').hide();
    $('#secondo').show();

    // Carica gli utenti
    $.ajax({
        url: '../ws/get_users.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var usersContainer = $('#users-container');
            usersContainer.empty(); // Pulisce il contenitore degli utenti prima di aggiungere nuovi elementi
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

$('#addServizioForm2').submit(function(event) {
    event.preventDefault();

    // Recupera i dati dal form precedente
    var formData = $('#secondo').data('formData');

    // Verifica che formData sia un oggetto JavaScript
    formData = formData || {}; // Assicura che formData sia un oggetto

    var selectedUsers = [];
    $('#users-container input:checked').each(function() {
        selectedUsers.push($(this).val());
    });

    formData.selectedUsers = selectedUsers;

    $.ajax({
        url: 'WSaddservizio.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        success: function(response) {
            console.log(response);
            // Redirect or show a success message
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