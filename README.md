# Benutzerverwaltung mit PHP und MySQL

## Projektbeschreibung

Dieses Projekt ist ein einfaches Benutzerverwaltungssystem, das mit **PHP** und **MySQL** entwickelt wurde. Die Benutzer können sich registrieren, anmelden und ihre Daten verwalten. Passwörter werden sicher mit `password_hash()` gespeichert, und SQL-Injections werden durch prepared Statements verhindert.

Das Projekt nutzt **Bootstrap** für ein responsives Design sowie **JavaScript** und **PHP** zur einfachen Formularvalidierung.

## Features

- Benutzerregistrierung mit sicherem Passwort-Hashing ([database.php](database.php))*➡️ `if (isset($_POST['createAccount']))...`* ([siehe](database.php#L18))
- Benutzer-Login mit Passwortprüfung ([check-user.php](check-user.php)) *➡️ `if (!empty($username) && !empty($password) && isset($_POST['login']))`*
- Benutzerdaten zurücksetzen mit Bestätigungscode ([database.php](database.php))*➡️ `if (isset($_POST['forgot']))...if (isset($_POST['change']))...`*
- Benutzerkonto löschen ([database.php](database.php)) *➡️ `if (isset($_POST['delete']))...`*
- Verwendung von MySQLi für die Datenbankkommunikation
- Nutzung von Bootstrap für das Design
- einfache Formularvalidierung mit JavaScript, PHP

## Technologien

- PHP
- MySQL
- Bootstrap
- JavaScript
- HTML/CSS


## Installation und Nutzung

1. **Repository klonen:**
   ```bash
   git clone https://github.com/EnginCoban/account-management.git
   ```

2. **Projektverzeichnis wechseln:**
   ```bash
   cd account-management
   ```

3. **Lokalen Webserver starten:**
   Nutze XAMPP, WAMP oder einen anderen lokalen Server mit PHP und MySQL-Unterstützung.

4. **Datenbank erstellen:**
   - Melde dich in **phpMyAdmin** an.
   - Erstelle eine neue Datenbank (z. B. `user_data`).
   - Erstelle die notwendige Tabelle, welche sich in der jeweiligen Datenbank befindet (siehe `database.php`).

5. **Datenbankverbindung konfigurieren:**
   - Öffne `connection-db.php` und passe die Datenbankzugangsdaten an (*passe auch die Datenbankzugangsdaten in* `check-user.php`, *und* `database.php` *an* ):
  <br><br>
   ```php
   $host = 'localhost';
   $user = 'root';
   $pass = '';
   $datab = 'user_data';
   ```

7. **Projekt testen:**
    - Nutze `login.php`, um dich mit einem erstellten Benutzer einzuloggen.
    - Rufe `register.php` auf, um einen neuen Benutzer anzulegen.
    - etc. <br>

      *Hinweis :* `login.php` *dient als index/menü von dem man bequem auf alle Seiten navigieren kann.*



