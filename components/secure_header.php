<?php 
include'connection.php';
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
include 'header.php';
?>