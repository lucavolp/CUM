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

// Query per ottenere il nome dell'utente
$logged_in_username = $_SESSION['username'];

// Query per ottenere l'elenco delle comunicazioni
$sql = "SELECT * FROM Comunicazione";
$result = $conn->query($sql);

?>

<!DOCTYPE html>

<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Protetta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Benvenuto, <?php echo $logged_in_username; ?></a>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>Elenco delle comunicazioni:</h4>
            <ul class="list-group">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item"><a href="dett_com.php?id=' . $row['cod'] . '">' . $row['oggetto'] . '</a></li>';
                    }
                } else {
                    echo '<li class="list-group-item">Nessuna comunicazione trovata.</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>

</body>
</html>

<?php
// Chiudi la connessione al database
$conn->close();
?>
