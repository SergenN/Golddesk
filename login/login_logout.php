<?php 
session_start();
session_destroy();
session_start();
$_SESSION['success'] = "Je bent succesvol uitgelogd";
header('location:../index.php');
?>