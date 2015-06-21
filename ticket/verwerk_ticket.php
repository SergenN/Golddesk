<?php
session_start();
$title = "Tickets";
$secure=0;
$php_only="s";
include'../components/secure_header.php';
ini_set('file_uploads', 'On');
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
 *  v1.2
 *      Ondersteuning voor comments +
 *      file uploaden.
 *  v1.2.1
 *      maakt nu mappen aan als deze niet
 *      bestaat.
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
     $text = nl2br($_POST['comment']);
    
                $target_dir = "../files/".$_POST['id']."/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $FileName = pathinfo($target_file,PATHINFO_FILENAME);
                $sqlfilename = $_FILES['file']['name'];
                
                // Check if file already exists
                if (file_exists($target_file)) {
                    for($i=1;$i<10;$i++){
                        $newname = (string)$FileName.$i;
                        $target_file = $target_dir.$newname.".".$imageFileType;
                        $sqlfilename = $newname.".".$imageFileType;
                        if(!file_exists($target_file)){
                            break;
                        }
                        if($i>=9){$_SESSION['error'] = "Sorry, file already exists.";
                    $uploadOk = 0;}
                    }
                    
                }
                // Check file size
                if ($_FILES["file"]["size"] > 500000) {
                    $_SESSION['error'] = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "doc" && $imageFileType != "docx" 
                && $imageFileType != "pdf" && $imageFileType != "pptx"&& $imageFileType != "ppt"
                && $imageFileType != "log" && $imageFileType != "txt" && $imageFileType != "mp3"
                && $imageFileType != "wav" && $imageFileType != "wma" && $imageFileType != "mp4"
                && $imageFileType != "avi" && $imageFileType != "flv" && $imageFileType != "mpg"
                && $imageFileType != "xls" && $imageFileType != "xlsx"&& $imageFileType != "accdb" 
                && $imageFileType != "zip" && $imageFileType != "zipx"&& $imageFileType != "rar") {
                    $_SESSION['error'] = "Sorry, the file is not allowed.";
                    $uploadOk = 0;
                }
                
                if (!file_exists('../files/'.$_POST['id'])) {
                    mkdir('../files/'.$_POST['id'], 0777, true);
                }
                
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {

                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                        $_SESSION['success'] = "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                    } else {
                        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                    }
                }
    
     if(isset($_FILES['file'])){
         $query = "INSERT INTO `notifications`(`user`,`creation_date`,`content`,`type`,`privacy`,`ticket_id`)
                VALUES ('".$_SESSION['id']."',NOW(),'".$sqlfilename."','file','".$_POST['secure']."','".$_POST['id']."')";
         mysqli_query($link, $query);
     }
     if(!empty($_POST['comment'])){
         $query ="INSERT INTO `notifications`(`user`,`creation_date`,`content`,`type`,`privacy`,`ticket_id`)
                    VALUES ('".$_SESSION['id']."',NOW(),'".$text."','comment','".$_POST['secure']."','".$_POST['id']."') ";
         mysqli_query($link, $query);
         
     }
     $_SESSION['page_id']=$_POST['id'];
     header('location:ticket.php');
 }
 
?>