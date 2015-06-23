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
$title = "FAQ toevoegen";
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald
?>

<html>
	<body>
		<div class="container">
			<form action="new_faq.php" method="post">
				<div class="col-md-6">
					  <div class="form-group">
						<label for="InputVraag">Vraag</label>
						<textarea class="form-control" name="InputVraag" rows="3"></textarea>
					  </div>
					  <div class="form-group">
						<label for="InputAntwoord">Antwoord</label>
						<textarea class="form-control" name="InputAntwoord" rows="3"></textarea>
					  </div>
					  <button type="submit" class="btn btn-default">FAQ toevoegen</button>
				</div>
			</form>
		</div>
	</body>
</html>
