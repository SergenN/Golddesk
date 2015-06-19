<?php
session_start();
$php_only = true;
$secure;
include_once'../components/header.php';
/*
 * Filename:        pass_update.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file wordt de formulier 
 *      van `change_password.php`verwerkt 
 *      om de wachtwoord te wijzigen, van
 *      de gebruiker die is ingelogd.
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de codering.
 *  v1.1
 *      overzetten van mysql naar mysqli    
 * 
 */
 
 // Ga alle post gegevens door een anti-sql-injection filter halen.
$username = stripslashes($_POST['username']);
$password = stripslashes($_POST['password']);
$password_new = stripslashes($_POST['password_new']);
$password_repeat = stripslashes($_POST['password_repeat']);
$username = mysqli_real_escape_string($link,$_POST['username']);
$password = mysqli_real_escape_string($link,$_POST['password']);
$password_new = mysqli_real_escape_string($link,$_POST['password_new']);
$password_repeat = mysqli_real_escape_string($link,$_POST['password_repeat']);

//Als een veld niet leeg is ga dan verder. Anders geef een error.
if(!empty($password)||!empty($password_new)||!empty($password_repeat)||!empty($username)){
    //Als de velden van password_new en password_repeat gelijk zijn ga verder.
    //Anders geef een error.
    if($password_new == $password_repeat){
        //Als de gebruikers naam het zelfde is ga verder.
        //Anders geef een error.
        if($_SESSION['myusername']==$username){
            //Haal de gegevens van de gebruiker op
            $query = "SELECT * FROM users WHERE id=".$_SESSION['id'];
            $result = mysqli_query($link,$query);
            while($row=mysqli_fetch_assoc($result)){
                //ALs wachtwoord gelijk is aan de geëncrypt ga dan verder.
                //Anders geef error.
                if($row['password']==MD5($password)){
                    
                    $query2 = "UPDATE users SET password='".MD5($password_new)."' WHERE id=".$_SESSION['id'];
                    mysqli_query($link,$query2);
                    $_SESSION['success'] = "Wachtwoord veranderen geslaagd";
                }else{
                    $_SESSION['error'] = "verkeerd wachtwoord";
                }
            }
        }else{
            $_SESSION['error']  = "verkeerd gebruikersnaam";
        }  
    }else{
        $_SESSION['error']  = "Het wachtwoord is niet gelijk";
    }
}else{
    $_SESSION['error']  = "Niet volledig ingevuld";
}
header('location:change_password.php');









?>