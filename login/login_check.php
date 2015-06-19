<?php
session_start();
$php_only=true;




include'../components/header.php';

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=MD5($_POST['mypassword']); 
// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($link,$myusername);
$mypassword = mysqli_real_escape_string($link,$mypassword);
$sql="SELECT * FROM `users` WHERE name='".$myusername."' and password='".$mypassword."'";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_assoc($result);
$myname=$row['voornaam'];
$myid=$row['id'];
$mylastlogin=$row['last_login'];
$_SESSION['last_login']=$mylastlogin;
// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

    // Register $myusername, $mypassword and redirect to file "login_success.php"
    $_SESSION['myusername']=$myusername;
    //$_SESSION['mypassword']=$mypassword; 
    $_SESSION['myname']=$myname;
    $_SESSION['id']=$myid;
    $_SESSION['level']=$row['access_level'];
    
    $last_login = date('c',time());
    mysqli_query($link,"UPDATE gebruikers SET last_login='$last_login' WHERE id='".$_SESSION['id']."' LIMIT 1");
    
    $_SESSION['success'] = "Je bent successvol ingelogd ".$_SESSION['myname'];
    header("Location:/index.php");
    

}else {
$_SESSION['error']="Wrong Username or Password";
header("Location:index.php");
};

?>