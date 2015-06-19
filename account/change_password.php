<?php
session_start();
$title = "Account";
$secure;
include'../components/header.php';

$query = "SELECT * FROM users WHERE `id`='".$_SESSION['id']."'";
$result = mysql_query($query);
while($row=mysql_fetch_assoc($result)){
?>


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