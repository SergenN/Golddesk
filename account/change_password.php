<?php
session_start();
$title = "Account";
$secure;
include'../components/secure_header.php';
/*
 * Filename:        change_password.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file wordt de formulier 
 *      weergegeven om de wachtwoord te 
 *      wijzigen, van de gebruiker die 
 *      is ingelogd.
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de formulier en
 *      codering
 *  v1.1
 *      overzetten van mysql naar mysqli    
 * 
 */

$query = "SELECT * FROM users WHERE `id`='".$_SESSION['id']."'";
$result = mysqli_query($link,$query);
while($row=mysqli_fetch_assoc($result)){
?>

<!--  
*   Tabel form met invoer voor gebruiker, oud wachtwoord, nieuw wachtwoord en herhaal wachtwoord
*   Na verzenden gaat het naar pass_update.php pagina.
 -->
<table class="col-md-12 table table-bordered">
    <tr>
        <td>
             <form class="form form-group" action="pass_update.php"method="post">
                <label for="username">Gebruikersnaam:</label>
                <input class="form-control" name="username"required  value="<?php echo $_SESSION['myusername']?>"/>
                
                <label for="password">oud wachtwoord</label>
                <input class="form-control"type="password" name="password" required/>
                
                <label for="password_new">nieuw wachtwoord</label>
                <input class="form-control"type="password" name="password_new" required/>
                
                <label for="password_repeat">herhaal wachtwoord</label>
                <input class="form-control"type="password" name="password_repeat" required/>
                
                <button class="btn btn-default" type="submit" value="Verzenden">verzenden</button>
             
             </form>
             
        </td>
        <td>
            <p><b>ACCOUNT DETAILS</b></p>
            <br>
            laatst gezien: <?php echo $_SESSION['last_login']?><br>
        </td>
    </tr>
</table>

<?php } ?>