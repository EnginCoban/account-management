<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div><a id="backButton" href="#">Zurück</a></div>

    <script>
        // Finde das Element mit der ID 'backButton'
        const backButton = document.getElementById('backButton');

        // Füge einen Event Listener für das 'click'-Ereignis hinzu
        backButton.addEventListener('click', function(event) {
            // Verhindere das Standardverhalten des Links
            event.preventDefault();

            // Navigiere zur vorherigen Seite im Verlauf
            history.back();
        });
    </script>
    <!--<a href="#" onclick="history.back(); return false;">Zurück</a>-->

</body>

</html>