<?php
session_start();
$title = "login";
include'../components/header.php';
;
if(!isset($_SESSION['myname'])){
    if(!isset($_SESSION['login_phase'])){
        include('login_main.php');
        include'../components/footer.php';
    }
}else{
    $_SESSION['success']= "login was successfull";
    //echo "<meta http-equiv='refresh' content='0;/index.php'/> ";
}









?>
