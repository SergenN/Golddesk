<?php 
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

if(isset($secure)){
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
}


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
        </head>
        <body>
        <?php include'menu.php';?>
        <div class='col-md-offset-2 col-md-8'>
        <?php 
        error_message();
}
?>