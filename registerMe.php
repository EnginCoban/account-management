<?php
include 'connectionDB.php';
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
                <form action="database.php" method="POST" id="form">
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Benutzername</label>
                        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">

                    </div>
                    <div>
                        <label for="exampleInputPassword1" class="form-label">Passwort</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div>
                        <label for="exampleInputPassword1" class="form-label">Email-Adresse</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <button type="submit" class="btn btn-primary" name="createAccount" id="submit">Account erstellen</button>

                </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        let form = document.getElementById("form");

        function validateForm(username, password, email, emailRegex) {
            if (username.trim().length === 0 || password.trim().length === 0 || email.trim().length === 0) {
                alert("Bitte Füllen Sie alle Felder aus!");
                return false;
            } else if (!emailRegex.test(email)) {
                alert("Falsches Email-Format!");
                return false;
            } else {
                return true;
            }
        }

        form.addEventListener('submit', function(event) {
            let username = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            let email = document.getElementById("email").value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let isFormValid = validateForm(username, password, email, emailRegex);
            if (!isFormValid) {
                event.preventDefault();
            }

        });
    </script>
</body>

</html>