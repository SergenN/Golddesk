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
$title = "Gebruiker bewerken";
$id = $_POST["user_data"];
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald
?>

<html>
<body>
<div class="container">
    <form action="edited_user.php" method="post">
        <div class="col-md-6">
            <?php
            $sql = "SELECT id, name, password, email, company, function, level, supervisor, firstname, lastname FROM users WHERE id = $id ";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $username = $row["name"];
                $password = $row["password"];
                $email = $row["email"];
                $company = $row["company"];
                $function = $row["function"];
                $level = $row["level"];
                $supervisor = $row["supervisor"];
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
            }
            ?>
            <div class="form-group">
                <label for="InputUsername">Gebruikersnaam*</label>
                <input type="text" class="form-control" id="InputUsername" name="InputUsername" value="<?php echo $username; ?>" placeholder="<?php echo $username; ?>" required>
            </div>
            <div class="form-group">
                <label for="InputName">Voornaam*</label>
                <input type="text" class="form-control" id="InputName" name="InputName" value="<?php echo $firstname; ?>" placeholder="<?php echo $firstname; ?>">
            </div>
            <div class="form-group">
                <label for="InputSurname">Achternaam*</label>
                <input type="text" class="form-control" id="InputSurname" name="InputSurname" value="<?php echo $lastname; ?>" placeholder="<?php echo $lastname; ?>">
            </div>
            <div class="form-group">
                <label for="InputEmail">E-mailadres*</label>
                <input type="email" class="form-control" id="InputEmail" name="InputEmail" value="<?php echo $email; ?>" placeholder="<?php echo $email; ?>" required>
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
                <input type="text" class="form-control" id="InputFunction" name="InputFunction" value="<?php echo $function; ?>" placeholder="<?php echo $function; ?>">
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
                <label for="InputPassword">Nieuw wachtwoord</label>
                <input type="password" class="form-control" id="InputPassword" name="InputPassword" placeholder="Wachtwoord">
            </div>
            <div class="form-group">
                <label for="SecondInputPassword">Nieuw wachtwoord herhalen</label>
                <input type="password" class="form-control" id="SecondInputPassword" name="SecondInputPassword" placeholder="Wachtwoord">
            </div>
            <button type="submit" class="btn btn-default" name="edited_data" value="<?php echo $id; ?>">Gegevens wijzigen</button>
        </div>
    </form>
</div>
</body>
</html>
