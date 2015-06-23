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
$title = "FAQ verwijderen";
$id = $_POST["faq_data"];
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald

$sql = "DELETE FROM faq WHERE id = $id ";
$result = mysqli_query($link, $sql);

?>

<html>
	<body>
		<div>
			<h1>
			<?php
			if($result) {
				echo "FAQ verwijderen geslaagd!";
			} else {
				echo "FAQ verwijderen mislukt";
			}
			?>
			</h1>
			<p>
			<?php
				if($result) { 
					echo 'Keer terug naar de <a href="user_overview.php">homepagina</a>.';
				} else {
					echo 'Probeer het later opnieuw. Keer terug naar de <a href="faq_overview.php">homepagina</a>.';
				}
			?>
			</p>
		</div>
	</body>
</html>