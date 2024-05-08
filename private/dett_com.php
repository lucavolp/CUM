<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

include("../assets/db/dbconn.php");

$id_comunicazione = $_GET['id'];


$sql = "SELECT * FROM Comunicazione WHERE cod = $id_comunicazione";
$result = $conn->query($sql);

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
        <a class="btn btn-danger" href="logout.php">Logout</a>
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
$conn->close();
?>
