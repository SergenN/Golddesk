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
    //$input = stripslashes($input);
    //$input = mysqli_real_escape_string($link,$input);
    
    //$input = nl2br($input);
    $input = stripslashes($input);
    $input = mysqli_real_escape_string($link, $input);
    $input = str_replace('\r\n', "<br>", $input);
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

function comment($naam,$tijd,$type,$description,$id,$privacy){
    
         
   $info = '<b>'.$naam.'</b><br>Op: '.$tijd.'<br></div><div class="col-md-8">';
            if($privacy==0){
                switch($type){
                    case "info":
                        echo '<div class="col-md-12 panel panel-info"><div class="col-md-4 panel-heading">'
                        .$info;
                        echo $description;
                        break;
                    case "comment":
                        echo '<div class="col-md-12 panel panel-warning"><div class="col-md-4 panel-heading">'
                        .$info;
                        echo $description;
                        break;
                    case "file":
                        echo '<div class="col-md-12 panel panel-success"><div class="col-md-4 panel-heading">'
                        .$info;
                        echo '<a target="_blank" class="btn btn-default" href="/files/'.$id.'/'.$description.'">'.$description.'</a>';
                }
            }else{
                switch($type){
                    case "info":
                        echo '<div class="col-md-12 panel panel-danger"><div class="col-md-4 panel-heading">'
                        .$info;
                        echo $description;
                        break;
                    case "comment":
                        echo '<div class="col-md-12 panel panel-danger"><div class="col-md-4 panel-heading">'
                        .$info;
                        echo $description;
                        break;
                    case "file":
                        echo '<div class="col-md-12 panel panel-danger"><div class="col-md-4 panel-heading">'
                        .$info;
                        echo '<a target="_blank" class="btn btn-default" href="/files/'.$id.'/'.$description.'">'.$description.'</a>';
                }
                
            }
            ?>
            </div>
        </div><br>
        <?php
}


?>