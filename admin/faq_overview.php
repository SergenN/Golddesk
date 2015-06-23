<?php
/**
 * Created by PhpStorm.
 * User: Leon Wetzel
 * Date: 19-6-2015
 * Time: 13:19
 */
session_start();
$title = "FAQ-overzicht";
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald
?>

<h1>FAQ overzicht<h1>
        <!-- Knop naar pagina voor het toevoegen van een faq -->
		<a href="create_faq.php">FAQ toevoegen</a>
        <?php
        $sql = "SELECT id, vraag, antwoord FROM faq";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            // maak een html-tabel aan
            ?>
	                <table>
                    <th>ID</th>
                    <th>Vraag</th>
                    <th>Antwoord</th>
					<th>Bewerken</th>
					<th>Verwijderen</th>
                    <?php
                    // per rij data weergeven
                    while ($row = mysqli_fetch_assoc($result)) {
                        // hier data weergeven in tabel
                        echo '<tr>';
                        echo '<td>' . $row["id"] . '</td>';
                        echo '<td>' . $row["vraag"] . '</td>';
                        echo '<td>' . $row["antwoord"] . '</td>';
                        echo '<td><form method="post"><button class="btn btn-default" type="submit" formmethod="post" formaction="edit_faq.php" name="faq_info" value=' . $row["id"] . '>Bewerken</button></form></td>';
                        echo '<td><form method="post"><button class="btn btn-default" type="submit" formmethod="post" formaction="delete_faq.php" name="faq_info" value=' . $row["id"] . '>Verwijderen</button></form></td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
        <?php
        } else {
            // faq is leeg
            echo "FAQ is leeg.";
        }
        ?>
