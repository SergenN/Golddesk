<?php
session_start();
$title = "Tickets";
$secure=0;
$php_only="s";
include'../components/secure_header.php';
/*
 * Filename:        index.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     20/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file wordt de ticket 
 *      hoofdpagina weergegeven.
 *      Voor deze pagina moet je ingelogd 
 *      zijn
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de pagina en
 *      codering  
 *  v1.1
 *      Ondersteuning Array van hardware/
 *      software naar database. 
 * 
 */
 $type=secure($_POST['type']);
 $title=secure($_POST['title']);
 $description=secure($_POST['description']);
 if($type=="new"){
    $query ="INSERT INTO `tickets` (`title`,`creator`,`creation_time`,`description`,`status`) 
              VALUES ('".$title."','".$_SESSION['id']."',NOW(),'".$description."','1')";
    mysqli_query($link, $query);
    $query2;
    $query = "SELECT `id` FROM `tickets` WHERE `creator`='".$_SESSION['id']."' AND `description`='".$description."' ORDER BY `id` DESC LIMIT 1";
    $result=mysqli_query($link, $query);
    while($row=mysqli_fetch_assoc($result)){
        $query2="INSERT INTO `notifications` (`user`,`creation_date`,`content`,`type`,`privacy`,`ticket_id`)
                VALUES ('".$_SESSION['id']."',NOW(),'<i>TICKET AANGEMAAKT</i>','info','0','".$row['id']."')";
        mysqli_query($link, $query2);
        
    
        for($i=0;$i<count($_POST['software']);$i++){
            if($_POST['software'][$i]!=""){
                $query3="INSERT INTO `ticket_software` (`ticket_id`,`software_id`)
                            VALUES('".$row['id']."','".$_POST['software'][$i]."')";
               mysqli_query($link, $query3);
           }
        }
        for($i=0;$i<count($_POST['software']);$i++){
            if($_POST['hardware'][$i]!=""){
                $query4="INSERT INTO `ticket_hardware` (`ticket_id`,`hardware_id`)
                            VALUES('".$row['id']."','".$_POST['hardware'][$i]."')";
               mysqli_query($link, $query4);
           }
        }
    }
    header('location:index.php');
 }elseif($_POST['type']=="comment"){
     $text = $_POST['comment'];
     nl2br($text);
     echo $text;
 }
 echo "<br> dit is de laatste<br>";
 print_r($_POST);
?>