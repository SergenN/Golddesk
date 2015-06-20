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
// hier een include naar bestand waar gegevens worden opgehaald
?>

<html>
	<body>
		<div class="container">
			<form>
				<div class="col-md-6">
					  <div class="form-group">
						<label for="InputUsername">Gebruikersnaam</label>
						<input type="text" class="form-control" id="InputUsername" placeholder="Gebruikersnaam">
					  </div>
					  <div class="form-group">
						<label for="InputName">Voornaam</label>
						<input type="text" class="form-control" id="InputName" placeholder="Voornaam">
					  </div>
					  <div class="form-group">
						<label for="InputSurname">Achternaam</label>
						<input type="text" class="form-control" id="InputSurname" placeholder="Achternaam">
					  </div>
					  <div class="form-group">
						<label for="InputEmail">E-mailadres</label>
						<input type="email" class="form-control" id="InputEmail" placeholder="E-mailadres">
					  </div>
					  <div class="form-group">
						<label for="InputCompany">Company</label>
							<select class="form-control">
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
						<input type="text" class="form-control" id="InputFunction" placeholder="Functie">
					  </div>
					  <div class="form-group">
						<label for="InputLevel">Toegangsniveau</label>
						<select class="form-control">
						  <option>0</option>
						  <option>1</option>
						  <option>2</option>
						  <option>3</option>
						  <option>4</option>
						</select>
					  </div>
					  <div class="form-group">
						<label for="InputSupervisor">Supervisor</label>
						<input type="number" class="form-control" id="InputSupervisor">
					  </div>
					  <div class="form-group">
						<label for="InputPassword">Wachtwoord</label>
						<input type="password" class="form-control" id="InputPassword" placeholder="Wachtwoord">
					  </div>
						<div class="form-group">
						<label for="SecondInputPassword">Wachtwoord herhalen</label>
						<input type="password" class="form-control" id="SecondInputPassword" placeholder="Wachtwoord">
					  </div>
					  <button type="submit" class="btn btn-default">Gebruiker toevoegen</button>
				</div>
			</form>
		</div>
	</body>
</html>
