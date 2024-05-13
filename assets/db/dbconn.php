<?php
    $servername = "10.25.0.14";
    $dbusername = "5cvolpinari";
    $dbpassword = "5cvolpinari";
    $dbname = "5cvolpinari_milizia";


    $servername = "192.168.1.152";
    $dbusername = "username";
    $dbpassword = "password";
    $dbname = "5cvolpinari_milizia";


    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }