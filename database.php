<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$datab = 'user_data';


$conn = mysqli_connect($host, $user, $pass, $datab);

if ($conn) {
    echo '<h1 style="text-align: center;">Verbindung zur Datenbank erfolgreich!</h1>';
} else {
    echo '<h1 style="text-align: center;">Verbindung zur Datenbank fehlgeschlagen!</h1>' . mysqli_connect_error();
}

if (isset($_POST['createAccount'])) {
    
    $_SESSION['newUsername'] = $_POST['username'];
    $_SESSION['newPassword'] = $_POST['password'];
    $_SESSION['email'] = $_POST['email'];
    $email = $_SESSION['email'];
    $username = $_SESSION['newUsername'];
    $password = $_SESSION['newPassword'];

   
    $newSqlQuery = "SELECT name, email FROM reg_users WHERE name = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $newSqlQuery);
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $newResult = mysqli_stmt_get_result($stmt);


    if ($newResult && mysqli_num_rows($newResult) > 0) {
        $row = mysqli_fetch_assoc($newResult);
        $nameFromDataBase = $row['name'];
        $emailFromDataBase = $row['email'];
        if ($nameFromDataBase === $username || $emailFromDataBase === $email) {
            echo 'Es gibt schon diese Benutzerdaten, legen Sie andere Daten fest';
            include 'back-button.php';
        }
    }

    else {
       
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
     
        $sqlQueryInsert = "INSERT INTO reg_users (name, password, email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sqlQueryInsert);
        mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPassword, $email,);
        $result = mysqli_stmt_execute($stmt);

        
   
        if ($result) {
            echo 'Ihre Daten wurden angelegt.';
            echo '<a href="login.php">zurück zum login</a>';
        }
      
        else {
            echo 'Daten konnten nicht angelegt werden.';
            include 'back-button.php';
        }
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['delete'])) {
    $deleteEmail = $_POST['email'];
    
    $sqlQuerySelectEmail = "SELECT email FROM reg_users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sqlQuerySelectEmail);
    mysqli_stmt_bind_param($stmt, "s", $deleteEmail);
    mysqli_stmt_execute($stmt);
    $resultFromEmail = mysqli_stmt_get_result($stmt);

    if ($resultFromEmail && mysqli_num_rows($resultFromEmail) > 0) {
    

        $deleteData = "DELETE FROM reg_users WHERE email = ?";
        $stmtDelete = mysqli_prepare($conn, $deleteData);
        mysqli_stmt_bind_param($stmtDelete, "s", $deleteEmail);
        mysqli_stmt_execute($stmtDelete);

        echo 'Daten wurden gelöscht';
        echo '<a href="login.php">zurück zum login</a>';
        mysqli_stmt_close($stmtDelete);
    } else {
        echo 'Diese Email existiert nicht. Versuchen Sie es nochmal.';
        include 'back-button.php';
    }
    mysqli_stmt_close($stmt);
}
if (isset($_POST['forgot'])) {
    if (!empty($_POST['email'])) {
        $forgotData = $_POST['email'];
        $sqlQuerySelectEmail = "SELECT email FROM reg_users WHERE email = ?";
     

        $stmt = mysqli_prepare($conn, $sqlQuerySelectEmail);
        mysqli_stmt_bind_param($stmt, "s", $forgotData);
        mysqli_stmt_execute($stmt);
        $resultFromEmail = mysqli_stmt_get_result($stmt);


        if ($resultFromEmail && mysqli_num_rows($resultFromEmail) > 0) {

            // Zufälliger 4-stelliger Zahlencode zwischen 0000 und 9999
            $randomCode = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $_SESSION['randomCode'] =  $randomCode;
            $_SESSION['email'] =  $forgotData;
            header('Location: change-data.php');
            exit;
        } else {
            echo 'Diese Email existiert nicht. Versuchen Sie es nochmal.';
            include 'back-button.php';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo 'Bitte füllen Sie die Felder aus!';
        include 'back-button.php';
    }
}


if (isset($_POST['change'])) {

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $changeData = $_SESSION['email'];
        $changeUsername = $_POST['username'];
        $changePassword = $_POST['password'];
        $hashedPassword = password_hash($changePassword, PASSWORD_DEFAULT);
        $sqlQueryUpdate = "UPDATE reg_users SET name = ?, password = ? WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sqlQueryUpdate);
        mysqli_stmt_bind_param($stmt, "sss", $changeUsername,  $hashedPassword, $changeData);

        $resultFromUpdate = mysqli_stmt_execute($stmt);
      

        if ($resultFromUpdate) {
            echo 'Daten wurden angelegt';
            echo '<div><a href="login.php">zum login</a></div>';
        } else {
            echo 'Error versuchen Sie es nochmal.';
            header('Location: forgot-password.php');
            exit;
        }
        mysqli_stmt_close($stmt);
    } else {
        echo 'Bitte füllen Sie die Felder aus!';
        include 'back-button.php';
    }
}




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