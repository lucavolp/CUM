<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.html");
        exit();
    }

    include("../assets/db/dbconn.php");

    $id_servizio = $_GET['id'];
    $sql = "SELECT * FROM Servizio WHERE nome LIKE '%$id_servizio'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $ser = $result->fetch_assoc();
    } else {
        echo "Servizio non trovato.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli del Servizio</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">Benvenuto, <?php echo $_SESSION['username']; ?></a>
        <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Dettagli del Servizio</h2>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <h4>Nome servizio: <?php echo $ser['nome']; ?></h4>
                            <h4>Gettone: <?php echo $ser['gettone']; ?> Euro</h4>
                            <h4>Durata: <?php echo $ser['ore_durata']; ?> Ore</h4>
                            <h4>Luogo: <?php echo $ser['luogo']; ?> </h4>
                        </tbody>
                    </table>

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
