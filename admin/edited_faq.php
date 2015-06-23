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
$id = $_POST["id"];
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
	$sql = "UPDATE faq SET vraag = '$vraag', antwoord = '$antwoord' WHERE id = $id";
}
?>

<html>
    <body>
        <h1>
            <?php
                if (mysqli_query($link, $sql)) {
                    echo "FAQ bewerken geslaagd!";
                } elseif(!empty($foutmeldingen)) {
					echo "Er is iets fout gegaan:";
				} else {
                    echo "Er is iets fout gegaan tijdens het bewerken van een FAQ.";
                }
            ?>
        </h1>
        <?php
		
        foreach($foutmeldingen as $foutmelding) {
            echo "- " . $foutmelding . "<br>";
        }
		
		if(empty($foutmeldingen)) { 
			echo 'Keer terug naar de <a href="faq_overview.php">homepagina</a>.';
		}
		?>
    </body>
</html>