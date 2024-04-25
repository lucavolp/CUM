<?php
session_start();

// Verifica se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Reindirizza alla pagina di login se l'utente non è autenticato
    exit();
}

// Connessione al database (sostituisci con i tuoi dati)
$servername = "192.168.1.152";
$dbusername = "username";
$dbpassword = "password";
$dbname = "5cvolpinari_milizia";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Prendi l'ID della comunicazione dalla query string
$id_comunicazione = $_GET['id'];



// Query per ottenere i dettagli della comunicazione
$sql = "SELECT * FROM Comunicazione WHERE cod = $id_comunicazione";
$result = $conn->query($sql);

// Verifica se la comunicazione esiste
if ($result->num_rows > 0) {
    $comunicazione = $result->fetch_assoc();
} else {
    echo "Comunicazione non trovata.";
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
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Benvenuto, <?php echo '<i>'.$_SESSION['username'].'</i>'; ?></a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Dettagli della comunicazione</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $comunicazione['oggetto']; ?></h5>
                    <p class="card-text"><?php echo $comunicazione['contenuto']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

<?php
// Chiudi la connessione al database
$conn->close();
?>
