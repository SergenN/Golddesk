<?php
session_start();
$title = "login";
include'../components/header.php';
/*
 * Filename:        index.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file wordt de login 
 *      pagina weergegeven. Hierin kan 
 *      men inloggen op de website
 *      om hieraan restricte pagina's
 *      te bezoeken.
 * 
 *      Wanneer men al is ingelogd, 
 *      redirect dan naar de home pagina
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de formulier en
 *      codering 
 * 
 */
 
 
if(!isset($_SESSION['myusername'])){
    include('login_main.php');
    include'../components/footer.php';
}else{
    $_SESSION['success']= "login was successfull";
    echo "<meta http-equiv='refresh' content='0;/index.php'/> ";
}
?>
