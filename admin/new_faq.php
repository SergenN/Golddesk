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
$title = "FAQ toevoegen";
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald
$foutmeldingen = array();

// post ontvangen
$vraag = $_POST["InputVraag"];
$antwoord = $_POST["InputAntwoord"];

// data voorbereiden
if(!empty($vraag)) {
    $vraag = mysqli_real_escape_string($link, trim($vraag));
} else {
    $foutmeldingen[] = "Vraag ontbreekt.";
}

if(!empty($antwoord)) {
    $antwoord = mysqli_real_escape_string($link, trim($antwoord));
} else {
   $foutmeldingen[] = "Antwoord ontbreekt.";
}

// query die data in de db moet zetten
if(empty($foutmeldingen)) {
	$sql = "INSERT INTO faq (vraag, antwoord)
	VALUES ('$vraag', '$antwoord')";
}
?>

<html>
    <body>
        <h1>
            <?php
                if (mysqli_query($link, $sql)) {
                    echo "FAQ toevoegen geslaagd!";
                } elseif(!empty($foutmeldingen)) {
					echo "Er is iets fout gegaan:";
				} else {
                    echo "Er is iets fout gegaan tijdens het toevoegen van een FAQ.";
                }
            ?>
        </h1>
        <?php
		
        foreach($foutmeldingen as $foutmelding) {
            echo "- " . $foutmelding . "<br>";
        }
		
		if(empty($foutmeldingen)) { 
			echo 'Keer terug naar de <a href="faq_overview.php">homepagina</a>, of voeg nog een FAQ <a href="create_faq.php">toe</a>.';
		}
		?>
    </body>
</html>