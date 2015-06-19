<?php

function secure($input){
    $input = stripslashes($input);
    $input = mysql_real_escape_string($input);
    return $input;
}

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