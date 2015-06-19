<?php
/*
 * Filename:        function.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
 * ------------------------------------- 
 * Description:     
 *      In deze file worden de functies
 *      toegepast. Wanneer er een 
 *      herhalde stuk code voor meedere
 *      pagina's geld, kan hier een 
 *      functie voor komen. 
 *      
 * -------------------------------------
 * Changelog: 
 *  v1.0
 *      Opstelling van de functies
 *  v1.1
 *      overzetten van mysql naar mysqli    
 * 
 */
 
//zet de waarde van `input` om naar een waarde dat tegen sql-injecties is.
function secure($input){
    global $link;
    $input = stripslashes($input);
    $input = mysqli_real_escape_string($link,$input);
    return $input;
}

//Weergeef een infobericht. Wanneer er een Errormessage is
//komt dit als een error te voorschijn. Bij een success komt 
//een success bubbel tevoorschijn.
function error_message(){
    if(isset( $_SESSION['error'])){
        echo "<p class='bg-danger text-danger'><b>".$_SESSION['error'] ."<b></p>";
        unset( $_SESSION['error'] );
    }
    if(isset( $_SESSION['success'])){
        echo "<p class='bg-success text-success'><b>".$_SESSION['success'] ."<b></p>";
        unset( $_SESSION['success'] );
    };
}


?>