<?php 
/*
 * Filename:        header.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file wordt de header 
 *      weergegeven en de connectie met
 *      de database geset. 
 *      Ook zal het de vooraf gestelde 
 *      variablen checken of de pagina
 *      alleen voor php of php met html
 *      doeleinden heeft.
 *      Als het een php_only doeleind 
 *      heeft, dan zal die geen html 
 *      weergeven.
 * 
 *      Als er vooral een $title is 
 *      gedefineerd dan wordt dit in 
 *      de header gezet samen met de 
 *      titel.
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de header en
 *      codering
 *  v1.1
 *      overzetten van mysql naar mysqli  
 *  v1.1.1
 *      bodyclass aangepast, van offspan 2 
 *      naar offspan 1, met col-md-8 naar 
 *      col-md-10  
 * 
 */
$dbhost="rdbms.strato.de";
$dbuser="U2174000";
$dbpasswoord="ditisgeenfietsrec1";
$dbdatabase="DB2174000";


$link = mysqli_connect($dbhost, $dbuser, $dbpasswoord, $dbdatabase);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
include 'functions.php'; 



if(!isset($php_only)){?>
   
        <head>
            <title>
                <?php if(isset($title)){
                echo $title." - ";}
                ?>
                
                Golddesk
            </title>
            <link href='/css/bootstrap.css' rel='stylesheet'>
            <link href='/css/own.css' rel="stylesheet">
            <meta lang="nl" />
            <meta charset="UTF-8">
            
            <script src="../js/jquery.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/bootstrap.js"></script>
            <script src="../js/collapse.js"></script>
            <script src="../js/tooltip.js"></script>
            <script src="../js/carousel.js"></script>
            <script src="../js/dropdown.js"></script>
            
            <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
            <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
            
        </head>
        <body class="bg-warning">
        <?php include'menu.php';?>
        <div class='col-md-offset-1 col-md-10' style="background-color: white">
        <?php 
        error_message();
}
?>