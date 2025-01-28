<?php 
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$datab = 'user_data';
$conn = mysqli_connect($host, $user, $pass, $datab);

if ($conn) {
    echo '<h1 style="text-align: center;">Verbindung zur Datenbank erfolgreich!</h1>';
    mysqli_close($conn);
} else {
    echo '<h1 style="text-align: center;">Verbindung zur Datenbank fehlgeschlagen!</h1>' . mysqli_connect_error();
}
?>