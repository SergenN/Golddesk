<?php
/**
 * Created by PhpStorm.
 * User: Leon Wetzel
 * Date: 19-6-2015
 * Time: 13:19
 */

/**
 * Changelog:
 *
 * 19-6-2015 13.00 uur: bestand aangemaakt
 * 19-6-2015 13.27 uur: functies getUsers() en displayUsers() toegevoegd
 * 19-6-2015 14.44 uur: entiteitsnamen aangepast aan huidige staat
 *
 */
session_start();
$title = "Gebruikersoverzicht";
include'../components/header.php';
// hier een include naar bestand waar gegevens worden opgehaald
// dit willen we niet hier doen
?>

<h1>Gebruikersoverzicht<h1>
        <!-- Knop naar pagina voor het toevoegen van een gebruiker -->
        <a class="btn btn-default" href="create_user.php" role="button">Nieuwe gebruiker toevoegen</a>

<?php
/**
 * Onderstaande graag later verwerken in een ander bestand
 * Deze functie haalt gebruikers op voor het overzicht
 * @param link
 * @return result
 */
function getUsers($link)
{
    $sql = "SELECT * FROM 'user'";
    $result = mysqli_query($link, $sql);
    return $result;
}

/**
 * Onderstaande graag verwerken in een ander bestand
 * Deze functie plaats de gebruikersdata in een tabel
 * @param $result
 */
function displayUsers($result)
{
    if (mysqli_num_rows($result) > 0) {
        // maak een html-tabel aan
        ?>
        <form action="user_info.php" method="post">
        <table>
            <th>ID</th>
            <th>Naam</th>
            <th>E-mailadres</th>
            <th>Laatst ingelogd op</th>

            <?php
        // per rij data weergeven
        while ($row = mysqli_fetch_assoc($result)) {
            // hier data weergeven in tabel
            // VERGEET NIET DE ENTITEITNAMEN ACHTERAF AAN TE PASSEN!
            echo '<tr>';
            echo '<td>' . '$row["user_id"]' . '</td>';
            echo '<td>' . '$row["user_name"]' . '</td>';
            echo '<td>' . '$row["user_email"]' . '</td>';
            echo '<td>' . '$row["user_last_login"]' . '</td>';
            echo '<td><button class="btn btn-default" type="button" formaction="user_info.php" name=' . $row["user_id"] . ' value="Meer informatie"></button></td>';
            echo '</tr>';
        }
            ?>
        </table>
        </form>
        <?php
    } else {
        // er zijn geen gebruikers gevonden
        echo "Er zijn geen gebruikers gevonden.";
    }
}
// hier het liefste een knop naar het bestand voor het maken van een nieuwe user

// if (gebruikers > 0) {
//  laat tabel met gegevens zien};

// elke rij bevat ook de knoppen voor extra info
?>
