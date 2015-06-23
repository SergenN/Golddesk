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
$title = "FAQ bewerken";
$id = $_POST["faq_info"];
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald

$sql = "SELECT vraag, antwoord FROM faq WHERE id = $id ";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	$vraag = $row["vraag"];
	$antwoord = $row["antwoord"];
}
?>
?>

<html>
<body>
<div class="container">
    <form action="edited_faq.php" method="post">
        <div class="col-md-6">
			  <div class="form-group">
				<label for="InputVraag">Vraag</label>
				<textarea class="form-control" name="InputVraag" rows="3"><?php echo $vraag; ?></textarea>
			  </div>
			  <div class="form-group">
				<label for="InputAntwoord">Antwoord</label>
				<textarea class="form-control" name="InputAntwoord" rows="3"><?php echo $antwoord; ?></textarea>
			  </div>
			  <button type="submit" class="btn btn-default" name="id"value="<?php echo $id; ?>">FAQ bewerken</button> 
        </div>
    </form>
</div>
</body>
</html>
