<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$datab = 'user_data';

#Verbindung zur Datenbank aufbauen
$conn = mysqli_connect($host, $user, $pass, $datab);
#Verbindung überprüfen
if ($conn) {
    echo '<h1 style="text-align: center;">Connection successful!</h1>';
}
#
else {
    echo '<h1 style="text-align: center;">Failed connection!</h1>' . mysqli_connect_error();
}

if (isset($_POST['createAccount'])) {
    #abgefangene Daten in Session Variablen speichern
    $_SESSION['newUsername'] = $_POST['username'];
    $_SESSION['newPassword'] = $_POST['password'];
    $_SESSION['email'] = $_POST['email'];
    $email = $_SESSION['email'];
    $username = $_SESSION['newUsername'];
    $password = $_SESSION['newPassword'];
 
    $newSqlQuery = "SELECT name, email FROM reg_users WHERE name = '$username' OR email = '$email'";

    $newResult = mysqli_query($conn, $newSqlQuery);

    if ($newResult && mysqli_num_rows($newResult) > 0) {
        $row = mysqli_fetch_assoc($newResult);
        $nameFromDataBase = $row['name'];
        $emailFromDataBase = $row['email'];
        if ($nameFromDataBase === $username || $emailFromDataBase === $email) {
            echo 'Es gibt schon diese Benutzerdaten, legen Sie andere Daten fest';
        }
    }
    # Wenn false...
    else {
        #hashe Password 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        #speichere es in der Datenbank
        $sqlQueryInsert = "INSERT INTO reg_users (name, password, email) VALUES('$username', '$hashedPassword','$email') ";
        $result = mysqli_query($conn, $sqlQueryInsert);
        #Wenn true...
        if ($result) {
            echo 'Ihre Daten wurden angelegt.';
        }
        #Wenn false...
        else {
            echo 'Daten konnten nicht angelegt werden.';
        }
    }
}
#Löschen der Daten
if (isset($_POST['delete'])) {
    $deleteEmail = $_POST['email'];
    $sqlQuerySelectEmail = "SELECT * FROM reg_users WHERE email = '$deleteEmail'";
    $resultFromEmail = mysqli_query($conn, $sqlQuerySelectEmail);
    if ($resultFromEmail && mysqli_num_rows($resultFromEmail) > 0) {
        $deleteData = "DELETE FROM reg_users WHERE email = '$deleteEmail'";
        $resultFromDelete = mysqli_query($conn, $deleteData);
        echo 'Daten wurden gelöscht';
    } else {
        echo 'Diese Email existiert nicht. Versuchen Sie es nochmal.';
    }
}
if (isset($_POST['forgot'])) {
    $forgotData = $_POST['email'];
    $sqlQuerySelectEmail = "SELECT email FROM reg_users WHERE email = '$forgotData'";
    $resultFromEmail = mysqli_query($conn, $sqlQuerySelectEmail);
    if ($resultFromEmail && mysqli_num_rows($resultFromEmail) > 0) {
    
        // Zufälliger 4-stelliger Zahlencode zwischen 0000 und 9999
        $randomCode = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $_SESSION['randomCode'] =  $randomCode;
        $_SESSION['email'] =  $forgotData;
        header('Location: changeData.php');
    } else {
        echo 'Diese Email existiert nicht. Versuchen Sie es nochmal.';
    }
}


if (isset($_POST['change'])) {
    $changeData = $_SESSION['email'];
    $changeUsername = $_POST['username'];
    $changePassword = $_POST['password'];
    $hashedPassword = password_hash($changePassword, PASSWORD_DEFAULT);
    $sqlQueryUpdate = "UPDATE reg_users SET name = '$changeUsername', password = '$hashedPassword' WHERE email = '$changeData'";
    $resultFromUpdate = mysqli_query($conn, $sqlQueryUpdate);
    if ($resultFromUpdate) {
     
       
        echo 'Daten wurden angelegt';
    } else {
        echo 'Error versuchen Sie es nochmal.';
        header('Location : forgotPassword.php');
    }
}



#schließe Verbindung
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>