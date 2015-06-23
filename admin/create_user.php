<?php
/**
 * Created by PhpStorm.
 * User: Leon Wetzel
 * Date: 19-6-2015
 * Time: 16:03
 */

/**
 * Changelog
 *
 * 19-6-2015 16.03 uur: bestand aangemaakt
 */
session_start();
$title = "Gebruiker toevoegen";
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald
?>

<html>
<body>
<div class="container">
    <form action="new_user.php" method="post">
        <div class="col-md-6">
            <div class="form-group">
                <label for="InputUsername">Gebruikersnaam*</label>
                <input type="text" class="form-control" id="InputUsername" name="InputUsername" placeholder="Gebruikersnaam" required>
            </div>
            <div class="form-group">
                <label for="InputName">Voornaam*</label>
                <input type="text" class="form-control" id="InputName" name="InputName" placeholder="Voornaam">
            </div>
            <div class="form-group">
                <label for="InputSurname">Achternaam*</label>
                <input type="text" class="form-control" id="InputSurname" name="InputSurname" placeholder="Achternaam">
            </div>
            <div class="form-group">
                <label for="InputEmail">E-mailadres*</label>
                <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="E-mailadres" required>
            </div>
            <div class="form-group">
                <label for="InputCompany">Bedrijf</label>
                <select class="form-control" name="InputCompany">
                    <option value="0">Scholengemeenschap De Hondsrug (0)</option>
                    <?php
                    // onderstaande query graag in een ander bestand stoppen
                    $sql = "SELECT name, id FROM companies ORDER BY id";
                    $result = mysqli_query($link, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value=' . $row["id"] . '>' . $row["name"] . ' (' . $row["id"] . ')</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="InputFunction">Functie</label>
                <input type="text" class="form-control" id="InputFunction" name="InputFunction" placeholder="Functie">
            </div>
            <div class="form-group">
                <label for="InputLevel">Toegangsniveau*</label>
                <select class="form-control" name="InputLevel">
                    <option value="0">0 (gewone gebruiker)</option>
                    <option value="1">1 (eerstelijns)</option>
                    <option value="2">2 (tweedelijns)</option>
                    <option value="3">3 (derdelijns)</option>
                    <option value="9">9 (administrator)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="InputSupervisor">Supervisor</label>
                <select class="form-control" name="InputSupervisor">
                    <option value="1">Kies een supervisor</option>
                    <?php
                    // onderstaande query graag in een ander bestand stoppen
                    $sql = "SELECT name, id FROM users ORDER BY id";
                    $result = mysqli_query($link, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value=' . $row["id"] . '>' . $row["name"] . ' (' . $row["id"] . ')</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="InputPassword">Wachtwoord*</label>
                <input type="password" class="form-control" id="InputPassword" name="InputPassword" placeholder="Wachtwoord" required>
            </div>
            <div class="form-group">
                <label for="SecondInputPassword">Wachtwoord herhalen*</label>
                <input type="password" class="form-control" id="SecondInputPassword" name="SecondInputPassword" placeholder="Wachtwoord" required>
            </div>
            <button type="submit" class="btn btn-default">Gebruiker toevoegen</button>
        </div>
    </form>
</div>
</body>
</html>
