<?php 
/*
 * Filename:        secure_header.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file wordt de pagina 
 *      beveiligd. De script zorgt ervoor
 *      dat er, bij geen inlog-sessie of
 *      rechten de pagina niet wordt 
 *      weergegeven.
 *      Het script zal zichzelf dan 
 *      stoppen voordat er één HTML code
 *      wordt weergegeven.
 *      
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de formulier en
 *      codering   
 * 
 */
if(!isset($_SESSION["myusername"])){
    $_SESSION['REQUEST_URI'] = $_SERVER['REQUEST_URI']; 
    header("location:/login/index.php");
}else{

    $idletime=3600;//na 1uur uitgelogd
    
    if (time()-$_SESSION['timestamp']>$idletime){
        session_destroy();
        session_unset();
        header("location:/login/index.php");
    } else {
        $_SESSION['timestamp']=time();
    }
}
if(isset($secure)){
    if($_SESSION['secure']<$secure){
        exit("<a href='/index.php'>404-page not found return here: </a>");
    }
}

include 'header.php';
?>