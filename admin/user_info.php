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
 * 19-6-2015 16.07 uur: divs toegevoegd
 * 20-6-2015 14.20 uur: queries toegevoegd voor linkerbalk
 * 20-6-2015 15.19 uur: rechterzijbalk afgerond
 */
session_start();
$id = $_GET["user_info"];
$title = "Gebruiker " . $id;
include'../components/header.php';
$secure = 9;
// hier een include naar bestand waar gegevens worden opgehaald
?>

<html>
<body>
<div class=col-md-4>
    <table>
        <tr>
            <td><strong>Naam</strong></td>
            <td>
                <?php
                $hasName = 0;
                // onderstaande query graag in een ander bestand stoppen
                $sql = "SELECT firstname, lastname FROM users WHERE id = $id ";
                $result = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo $row["firstname"] . " " . $row["lastname"];
                    if(!empty($row["firstname"]) && !empty($row["lastname"])) {
                        $hasName = 1;
                    }
                }
                if(!$hasName) {
                    echo "Naam onbekend";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><strong>Gebruikersnaam</strong></td>
            <td><?php echo $id; ?></td>
        </tr>
        <tr>
            <td><strong>Laatste inlogmoment</strong></td>
            <td>
                <?php
                // onderstaande query graag in een ander bestand stoppen
                $sql = "SELECT last_login FROM users WHERE id = $id ";
                $result = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    if(!$row["last_login"]) {
                        $login = "Nog nooit ingelogd";
                    } else {
                        $login = $row["last_login"];
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><strong>E-mailadres</strong>
            <td>
                <?php
                // onderstaande query graag in een ander bestand stoppen
                $sql = "SELECT email FROM users WHERE id = $id ";
                $result = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo $row["email"];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><strong>Gebruikersniveau</strong></td>
            <td>
                <?php
                // onderstaande query graag in een ander bestand stoppen
                $sql = "SELECT level FROM users WHERE id = $id ";
                $result = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo $row["level"];
                }
                ?>
            </td>
        </tr>
    </table>

    <form>
        <button class="btn btn-default" type="submit" formmethod="post" formaction="edit_user.php" name="user_data" value="<?php echo $id; ?>">Gegevens aanpassen</button>
    </form>
    <form>
        <button class="btn btn-default" type="submit" formmethod="post" formaction="delete_user.php" name="user_data" value="<?php echo $id; ?>">Gebruiker verwijderen</button>
    </form>
</div>

<div class=col-md-8>
    <table>
        <?php
        // onderstaande query graag in een ander bestand stoppen
        $sql = "SELECT tickets.id, tickets.title, tickets.creator, tickets.creation_time, tickets.assigned, tickets.status, tickets.description, tickets.close_time FROM tickets JOIN users ON users.id = tickets.creator WHERE users.id = $id ";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>ID</td><td>' . $row["id"] . '</td>';
                echo '<td>Titel</td><td>' . $row["title"] . '</td>';
                echo '<td>Aangemaakt op</td><td>' . $row["creation_time"] . '</td>';
                echo '<td>Aangewezen</td><td>' . $row["assigned"] . '</td>';
                echo '<td>Status</td><td>' . $row["status"] . '</td>';
                echo '<td>Beschrijving</td><td>' . $row["description"] . '</td>';
                echo '<td>Sluitingstijd</td><td>' . $row["close_time"] . '</td>';
                echo '</tr>';
            }
        } else {
            // desbetreffende persoon heeft geen tickets
            echo "Gebruiker heeft (nog) geen tickets aangemaakt.";
        }
        ?>
    </table>
</div>
</body>
</html>
