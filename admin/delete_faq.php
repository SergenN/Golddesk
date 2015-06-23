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
$id = $_POST["faq_info"];
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald

$sql = "SELECT id, vraag, antwoord FROM faq WHERE id = $id ";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	$id = $row["id"];
	$vraag = $row["vraag"];
	$antwoord = $row["antwoord"];
}
?>

<html>
	<body>
		<div>
			<h1>FAQ verwijderen</h1>
			<p>Weet u zeker dat u FAQ #<?php echo $id;?> wilt verwijderen? U kunt deze actie niet ongedaan maken.</p>
			<form>
				<button class="btn btn-default" type="submit" formaction="faq_overview.php">Annuleren</button>
			</form>
			<form>
				<button class="btn btn-default" type="submit" formmethod="post" formaction="deleted_faq.php" name="faq_data" value="<?php echo $id; ?>">Ja, ik wil deze FAQ verwijderen</button>
			</form>
		</div>
	</body>
</html>