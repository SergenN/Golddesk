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
$title = "Gebruiker toevoegen";
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


// data voorbereiden
if(!empty($username)) {
    $username = mysqli_real_escape_string($link, strtolower(trim($username)));
} else {
    $foutmeldingen[] = "Gebruikersnaam ontbreekt en/of ongeldig.";
}

if(!empty($name)) {
    $name = mysqli_real_escape_string($link, ucfirst(trim($name)));
} else {
    $foutmeldingen[] = "Voornaam ontbreekt en/of ongeldig.";
}

if(!empty($surname)) {
    $surname = mysqli_real_escape_string($link, trim($surname));
} else {
    $foutmeldingen[] = "Achternaam ontbreekt en/of ongeldig.";
}

if(!empty($email)) {
    $email = mysqli_real_escape_string($link, strtolower(trim($email)));
} else {
    $foutmeldingen[] = "E-mailadres ontbreekt en/of ongeldig.";
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

if(empty($wachtwoord) || empty($wachtwoord2) || strcmp($wachtwoord, $wachtwoord2) !== 0) {
    $foutmeldingen[] = "Het wachtwoord ontbreekt en/of de ingevoerde wachtwoorden komen niet overeen.";
    $check = 0;
} else {
    $wachtwoord = mysqli_real_escape_string($link, $wachtwoord);
    $wachtwoord = md5($wachtwoord);
    $check = 1;
}

// query die data in de db moet zetten
if($check) {
    $sql = "INSERT INTO users (name, password, last_login, email, company, function, level, supervisor, firstname, lastname)
	VALUES ('$username', '$wachtwoord', null, '$email', '$company', '$function', '$level', '$supervisor', '$name', '$surname')";
}
?>

<html>
<body>
<h1>
    <?php
    if (mysqli_query($link, $sql)) {
        echo "Gebruiker toevoegen geslaagd!";
    } elseif(!empty($foutmeldingen)) {
        echo "Er is iets fout gegaan:";
    } else {
        echo "Er is iets fout gegaan tijdens het afhandelen van het toevoegen van de gebruiker.";
    }
    ?>
</h1>
<?php

foreach($foutmeldingen as $foutmelding) {
    echo "- " . $foutmelding . "<br>";
}
?>
</body>
</html>