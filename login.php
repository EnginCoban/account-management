<?php
include 'connection-db.php';

session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <form action="check-user.php" method="POST">
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Benutzername</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">

                    </div>
                    <div>
                        <label for="exampleInputPassword1" class="form-label">Passwort</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary" name="login">einloggen</button>
                    <a href="register.php">hier registrieren!</a>
                    <a href="delete-user.php">hier Account löschen!</a>
                    <a href="forgot-password.php">Passwort vergessen?</a>
                </form>
            </div>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>