<?php
/**
 * Created by PhpStorm.
 * User: Leon Wetzel
 * Date: 19-6-2015
 * Time: 13:19
 */
session_start();
$title = "Gebruikersoverzicht";
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald
?>

<h1>Gebruikersoverzicht<h1>
        <!-- Knop naar pagina voor het toevoegen van een gebruiker -->
        <a href="create_user.php">Nieuwe gebruiker toevoegen</a>
        <?php
        $sql = "SELECT id, name, email, last_login FROM users";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            // maak een html-tabel aan
            ?>
            <table>
                <th>ID</th>
                <th>Gebruikersnaam</th>
                <th>E-mailadres</th>
                <th>Laatst ingelogd op</th>
                <th>Extra</th>
                <th>Verwijderen</th>
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
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td>' . $login . '</td>';
                    echo '<td><form method="get"><button class="btn btn-default" type="submit" formmethod="get" formaction="user_info.php" name="user_info" value=' . $row["id"] . '>Meer informatie</button></form></td>';
                    echo '<td><form method="post"><button class="btn btn-default" type="submit" formmethod="post" formaction="delete_user.php" name="user_info" value=' . $row["id"] . '>Gebruiker verwijderen</button></form></td>';
                    echo '</tr>';
                }
                ?>
            </table>
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
