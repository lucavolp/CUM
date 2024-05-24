<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../accesso2.html");
    exit();
}

$isAdmin = ($_SESSION['username'] === 'admin');

if (!$isAdmin) {
    header("Location: ../dashboard.php");
    exit();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection
    include("../../assets/db/dbconn.php");

    // Escape the ID to prevent SQL injection
    $id_servizio = $conn->real_escape_string($_POST['id_servizio']);

    // Prepare the SQL statement to delete the service
    $sql = "DELETE FROM Servizio WHERE nome = '$id_servizio'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to dashboard after successful deletion
        header("Location: ../adminhome.php");
    } else {
        // If deletion fails, display an error message
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request method is not POST, redirect to dashboard
    header("Location: dashboard.php");
}
?>
