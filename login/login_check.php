<?php
session_start();
$php_only=true;
include'../components/header.php';
/*
 * Filename:        login_check.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file wordt de login 
 *      gecheckt of dit klopt.
 *      wanneer dit klopt, mag je een
 *      selectie pagina's bekijken waar
 *      je voor gemachtigd bent.
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de codering en
 *      checking
 *  v1.1
 *      overzetten van mysql naar mysqli    
 * 
 */


$myusername=$_POST['myusername']; 
//wachtwoord enchrypten.
$mypassword=MD5($_POST['mypassword']); 
// beschreming tegen SQL injecties.
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($link,$myusername);
$mypassword = mysqli_real_escape_string($link,$mypassword);
$sql="SELECT * FROM `users` WHERE name='".$myusername."' and password='".$mypassword."'";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_assoc($result);
$myid=$row['id'];
$_SESSION['last_login']=$row['last_login'];
// tel de aantal resultaten.
$count=mysqli_num_rows($result);

// Als er maar 1 check gebruiker is dan:
if($count==1){

    // Register $myusername, $mypassword and redirect to file "../index.php"
    $_SESSION['myusername']=$myusername;
    $_SESSION['id']=$myid;
    $_SESSION['secure']=$row['level'];
    
    $last_login = date('c',time());
    mysqli_query($link,"UPDATE users SET `last_login`=NOW() WHERE `id`='".$_SESSION['id']."' LIMIT 1");
    
    $_SESSION['success'] = "Je bent successvol ingelogd ".$_SESSION['myname'];
    header("Location:/index.php");
    

}else {
$_SESSION['error']="Wrong Username or Password";
header("Location:index.php");
};

?>