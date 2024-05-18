<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.html");
        exit();
    }

    include("../assets/db/dbconn.php");

    $usernm=$_SESSION['username'];

    $id_servizio = $_GET['id'];
    $sql = "SELECT * FROM Assenze WHERE usr_utente = $usernm";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $ass = $result->fetch_assoc();
    } else {
        echo "Assenza non registrata.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli dell'assenza</title>
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
                            <h4>Data assenza: <?php echo $ass['data']; ?></h4>
                            <h4>Dettagli: <?php echo $ser['gettone']; ?> Euro</h4>
                        </tbody>
                    </table>
                </div>
            </div>
            <a type="button" class="btn btn-warning back-button" href="./dashboard.php" name="Indietro" style="position:absolute; left:10px">Indietro</a>
        </div>
    </div>
</div>

</body>
</html>

<?php
// Chiudi la connessione al database
$conn->close();
?>
