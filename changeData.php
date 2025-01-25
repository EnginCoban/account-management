<?php
include 'connectionDB.php';



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="database.php" method="POST">
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">

                    </div>
                    <div>
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div>
                        <label for="exampleInputPassword1" class="form-label">Code</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="code" value=<?= $_SESSION['randomCode']; ?>>
                    </div>
                    <div style="visibility: hidden;">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputPassword1" name="email" value=<?= $_SESSION['email']; ?>>
                    </div>

                    <button type="submit" class="btn btn-primary" name="change">change Data</button>

                </form>
            </div>
        </div>

    </div>

</body>

</html>