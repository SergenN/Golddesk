<?php
session_start();
$secure;
$title = "Account";
include'../components/secure_header.php';
/*
 * Filename:        index.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file wordt de gebruikers 
 *      info weergegeven.
 *      Op deze pagina is het mogelijk 
 *      je gebruikersnaam, laatste inlog
 *      tijdstip en rechten inzien.
 *      Ook is het mogelijk om je 
 *      wachtwoord te wijzigen.
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de pagina en
 *      codering
 *  v1.1
 *      overzetten van mysql naar mysqli    
 * 
 */
$query = "SELECT * FROM users WHERE id='".$_SESSION['id']."'";
$result = mysqli_query($link,$query);
while($row=mysqli_fetch_assoc($result)){
?>


<table class="col-md-12 table table-bordered">
    <tr>
        <td>
             <p>ACCOUNT INFORMATIE</p>
             <br>
             ingelogd als: <?php echo $row['firstname']." ".$row['lastname'];?><br>
             gebruikersnaam: <?php echo $row['name'];?><br>
             <a href="change_password.php">wijzig wachtwoord</a><br>
             
             
             
        </td>
        <td>
            <p>ACCOUNT DETAILS</p>
            <br>
            laatst gezien: <?php echo $_SESSION['last_login']?><br>
            
        </td>
    </tr>
</table>

<?php } ?>