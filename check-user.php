<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$datab = 'user_data';
$username = $_POST['username'];
$password = $_POST['password'];

$conn = mysqli_connect($host, $user, $pass, $datab);

if ($conn) {
    echo '<h1 style="text-align: center;">Verbindung zur Datenbank erfolgreich!</h1>';
} else {
    echo '<h1 style="text-align: center;">Verbindung zur Datenbank fehlgeschlagen!</h1>' . mysqli_connect_error();
}

if (!empty($username) && !empty($password) && isset($_POST['login'])) {

    $sqlQuerySelect = "SELECT password FROM reg_users WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sqlQuerySelect);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);


    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        $verifyPassword = password_verify($password, $hashedPassword);
        if ($verifyPassword) {
            echo '<p style="text-align: center;">Du bist eingeloggt!</p>';
            $deleteLogoutButton = false;
        } else {

            $deleteLogoutButton = true;
            echo '<p>Dieser Account existiert nicht!</p>';

            include 'back-button.php';
        }
    } else {
        echo '<p>Dieser Account existiert nicht!</p>';

        include 'back-button.php';
        $deleteLogoutButton = true;
    }
    mysqli_stmt_close($stmt);
} else {
    echo '<h2 style="display:block;">Bitte füllen Sie die Felder aus!</h2>';
    include 'back-button.php';
    $deleteLogoutButton = true;
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="delete-form.js"></script>
</head>

<body>
    <form action="login.php" method="POST" id="logout">
        <div>
            <button type="submit" class="btn btn-primary mb-3" name="logout">ausloggen</button>

            <?php if ($deleteLogoutButton) : ?>
                <script>
                    deleteForm();
                </script>
            <?php endif; ?>

        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>