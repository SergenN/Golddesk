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
$title = "Gebruiker verwijderen";
$id = $_POST["user_info"];
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald

$sql = "SELECT id, name, firstname, lastname FROM users WHERE id = $id ";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	$id = $row["id"];
	$username = $row["name"];
	$firstname = $row["firstname"];
	$lastname = $row["lastname"];
}
?>

<html>
	<body>
		<div>
			<h1>Gebruiker verwijderen</h1>
			<p>Weet u zeker dat u <?php echo $firstname . " " . $lastname . " (met gebruikersnaam <strong>" . $username . "</strong>) wilt verwijderen?";?> U kunt deze actie niet ongedaan maken.</p>
			<form>
				<button class="btn btn-default" type="submit" formaction="user_overview.php">Annuleren</button>
			</form>
			<form>
				<button class="btn btn-default" type="submit" formmethod="post" formaction="deleted_user.php" name="user_data" value="<?php echo $id; ?>">Ja, ik wil deze gebruiker verwijderen</button>
			</form>
		</div>
	</body>
</html>