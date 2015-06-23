<?php
/**
 * Created by PhpStorm.
 * User: Leon
 * Date: 22-6-2015
 * Time: 09:37
 */

/**
 * Changelog
 *
 * 22-6-2015 9.37 uur: Bestand aangemaakt
 */

session_start();
$title = "Gebruiker bewerken";
$id = $_POST["edited_data"];
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald
$foutmeldingen = array();

// post ontvangen
$username = $_POST["InputUsername"];                    // verplicht
$name = $_POST["InputName"];
$surname = $_POST["InputSurname"];
$email = $_POST["InputEmail"];                          // verplicht
$company = $_POST["InputCompany"];
$function = $_POST["InputFunction"];
$level = $_POST["InputLevel"];                          // verplicht
$supervisor = $_POST["InputSupervisor"];
$wachtwoord = $_POST["InputPassword"];                  // verplicht
$wachtwoord2 = $_POST["SecondInputPassword"];           // verplicht

// oude gegevens van gebruiker
$sql = "SELECT id, name, password, email, company, function, level, supervisor, firstname, lastname FROM users WHERE id = $id ";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $us = $row["name"];
    $password = $row["password"];
    $em = $row["email"];
    $cp = $row["company"];
    $ft = $row["function"];
    $lvl = $row["level"];
    $sv = $row["supervisor"];
    $fn = $row["firstname"];
    $ln = $row["lastname"];
}

// data voorbereiden
if(!empty($username)) {
    $username = mysqli_real_escape_string($link, strtolower(trim($username)));
} else {
    $foutmeldingen[] = "Gebruikersnaam is ongeldig.";
}

if(!empty($name)) {
    $name = mysqli_real_escape_string($link, ucfirst(trim($name)));
} else {
    $foutmeldingen[] = "Voornaam is ongeldig.";
}

if(!empty($surname)) {
    $surname = mysqli_real_escape_string($link, trim($surname));
} else {
    $foutmeldingen[] = "Achternaam is ongeldig.";
}

if(!empty($email)) {
    $email = mysqli_real_escape_string($link, strtolower(trim($email)));
} else {
    $foutmeldingen[] = "E-mailadres is ongeldig.";
}

if(!empty($company)) {
    $company = trim($company);
} else {
    $company = 0;
}

if(!empty($function)) {
    $function = mysqli_real_escape_string($link, ucfirst(trim($function)));
} else {
    $function = "Onbekend";
}

if(!empty($supervisor)) {
    $supervisor = trim($supervisor);
} else {
    $supervisor = 0;
}

if(strcmp($wachtwoord, $wachtwoord2) !== 0) {
    // ingevoerde wachtworden komen niet overeen
    $foutmeldingen[] = "De ingevoerde wachtwoorden komen niet overeen.";
    $check = 0;
} elseif(empty($wachtwoord) && empty($wachtwoord2)) {
    // wachtwoord is onveranderd
    $wachtwoord = $password;
    $check = 1;
} else {
    // nieuw wachtwoord ingevoerd
    $wachtwoord = mysqli_real_escape_string($link, $wachtwoord);
    $wachtwoord = md5($wachtwoord);
    $check = 1;
}

// query die data in de db moet zetten
if($check) {
    $sql = "UPDATE users SET name = '$username', password = '$password', email = '$email', company = '$company', function = '$function', level = $level, supervisor = $supervisor, firstname = '$name', lastname = '$surname' WHERE id = $id ";
}
?>

<html>
<body>
<h1>
    <?php
    if (mysqli_query($link, $sql)) {
        echo "Gebruiker bewerken geslaagd!";
    } elseif(!empty($foutmeldingen)) {
        echo "Er is iets fout gegaan:";
    } else {
        echo "Er is iets fout gegaan tijdens het bewerken van de gegevens van een gebruiker.";
    }
    ?>
</h1>
<?php

foreach($foutmeldingen as $foutmelding) {
    echo "- " . $foutmelding . "<br>";
}

if($check) {
    echo 'Keer terug naar de <a href="user_overview.php">homepagina</a>.';
}
?>
</body>
</html>