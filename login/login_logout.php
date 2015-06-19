<?php 
session_start();
session_destroy();
session_start();
/*
 * Filename:        login_logout.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file wordt de login 
 *      sessie vernietigd. Je wordt dan 
 *      succesvol uitgelogd.
 *      Je wordt dan doorgestuurd naar de 
 *      homepagina.
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de codering.
 * 
 */
$_SESSION['success'] = "Je bent succesvol uitgelogd";
header('location:../index.php');

?>