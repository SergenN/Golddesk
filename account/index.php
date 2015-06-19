<?php
session_start();
$secure;
$title = "Account";
include'../components/header.php';

$query = "SELECT * FROM users WHERE gebruikers.id='".$_SESSION['id']."'";
$result = mysql_query($query);
while($row=mysql_fetch_assoc($result)){
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