<?php
session_start();
$php_only = true;
$secure;
include_once'../components/header.php';
$username = secure($_POST['username']);
$password = secure($_POST['password']);
$password_new = secure($_POST['password_new']);
$password_repeat = secure($_POST['password_repeat']);

if(!empty($password)||!empty($password_new)||!empty($password_repeat)||!empty($username)){
    if($password_new == $password_repeat){//Gelijke wachtwoord
        if($_SESSION['myusername']==$username){//gelijke gebruikersnaam
            $query = "SELECT * FROM gebruikers WHERE id=".$_SESSION['id'];
            $result = mysql_query($query);
            while($row=mysql_fetch_assoc($result)){
                if($row['password']==MD5($password)){
                    
                    $query2 = "UPDATE gebruikers SET password='".MD5($password_new)."' WHERE id=".$_SESSION['id'];
                    mysql_query($query2);
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