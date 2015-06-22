<?php
/**
 * Created by PhpStorm.
 * User: Leon Wetzel
 * Date: 19-6-2015
 * Time: 13:19
 */

/**
 * Changelog
 *
 * 19-6-2015 13.00 uur: bestand aangemaakt
 * 19-6-2015 13.27 uur: functies toegevoegd
 * 19-6-2015 13.58 uur: kleine aanpassingen
 * 19-6-2015 15.17 uur: aanpassingen aan entiteiten gemaakt
 * 19-6-2015 16.02 uur: aanpassingen gemaakt m.b.t. Meer Informatie-optie
 * 20-6-2015 11.17 uur: link voor het toevoegen van gebruikers veranderd in knop
 */
session_start();
$title = "Gebruikersoverzicht";
include'../components/header.php';
// hier een include naar bestand waar gegevens worden opgehaald
?>

<h1>Gebruikersoverzicht<h1>
        <!-- Knop naar pagina voor het toevoegen van een gebruiker -->
        <button class="btn btn-default" href="create_user.php">Nieuwe gebruiker toevoegen</button>

        <?php
        $sql = "SELECT id, name, email, last_login FROM users";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            // maak een html-tabel aan
            ?>
            <form>
                <table>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>E-mailadres</th>
                    <th>Laatst ingelogd op</th>
                    <th>Opties</th>
                    <?php
                    // per rij data weergeven
                    while ($row = mysqli_fetch_assoc($result)) {
                        // hier data weergeven in tabel
                        if(!$row["last_login"]) {
                            $login = "Nog nooit ingelogd";
                        } else {
                            $login = $row["last_login"];
                        }
                        echo '<tr>';
                        echo '<td>' . $row["id"] . '</td>';
                        echo '<td>' . $row["name"] . '</td>';
                        echo '<td>' . $row["email"] . 'a</td>';
                        echo '<td>' . $login . '</td>';
                        echo '<td><button class="btn btn-default" type="submit" formmethod="post" formaction="user_info.php" name="user_info" value=' . $row["id"] . '>Meer informatie</button></td>';
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

        // hier het liefste een knop naar het bestand voor het maken van een nieuwe user

        // if (gebruikers > 0) {
        //  laat tabel met gegevens zien};

        // elke rij bevat ook de knoppen voor extra info
        ?>
