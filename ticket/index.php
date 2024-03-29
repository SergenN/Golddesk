<?php
session_start();
$title = "Tickets";
$secure=0;
include'../components/secure_header.php';
/*
 * Filename:        index.php
 * Creator:         Michaël van der Veen
 * Creation Date:   16/06/2015
 * Last Edited:     19/06/2015
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
 *      Pagina selectie + Nuttiger query 
 *  v1.1.1 
 *      dubbele waarde opgelost
 * 
 */
 
 if(isset($_GET['showClosed'])){
     $_SESSION['showClosed']=$_GET['showClosed'];
 }elseif(isset($_SESSION['showClosed'])){
     $_SESSION['showClosed']="TRUE";
 }
 
 
 
 
?>
<div class="col-md-3">

    <img src="/img/golddesk.jpg" width="100%"/>
</div>
<div class="col-md-9">
    <h1>Welkom bij Golddesk Support</h1>
    <br>
    Met Golddesk kunt u eenvoudig hulp tickets aanmaken en beheren. Wanneer u 
    een ticket heeft aangemaakt zal deze binnen 1 tot 365 werkdagen worden 
    behandeld (366 in een schrikkeljaar).<br> 
    <br> 
    Op deze pagina kunt u uw tickets beheren, klik op een ticket voor meer 
    informatie en om commentaar te plaatsen
    <br>
    <br>Weergeef geloten tickets 
    <?php 
    if($_GET['showClosed']=="FALSE"){
        echo '<a href="index.php?showClosed=TRUE" class="btn btn-default navbar-right">aan</a>';
    }else{
        echo '<a href="index.php?showClosed=FALSE" class="btn btn-default navbar-right">uit</a>';
    }
    ?>
    <a href="ticket.php" class="btn btn-default navbar-right">Maak een nieuwe ticket aan</a>
</div>
<br>
<br>
<form action="ticket.php" method="post">
    <table class="table">
        <tr class="active">
            <td>
                <b>Ticket ID</b>
            </td>
            <td>
                <b>Datum</b>    
            </td>
            <td>
                <b>Gebruiker</b>
            </td>
            <td>
                <b>Onderwerp</b>
            </td>
            <td>
                <b>Status</b>
            </td>
            <td colspan="3">
                <b>Laatste update</b>
            </td>
        </tr>
        <?php
        if(isset($_GET['page'])){
            $offset = ($_GET['page']-1)*10;
            $page=$_GET['page'];
        }else{
            $offset = 0;
            $page=1;
        }
        $query = 
        "SELECT 
            `tickets`.`id` AS `id`,
            `tickets`.`creation_time` AS `creation_time`,
            `tickets`.`assigned` AS `assigned_id`,
            `users`.`firstname` AS `firstname`,
            `users`.`lastname` AS `lastname`,
            `tickets`.`title` AS `title`,
            `status`.`text` AS `status`,
            `tickets`.`status` AS `status_id`,
            (SELECT `notifications`.`creation_date`
                FROM `notifications`
                WHERE `notifications`.`ticket_id` = `tickets`.`id` 
                    AND `notifications`.`privacy`<='".$_SESSION['secure']."'
                    AND `notifications`.`content`!='<i>TICKET AANGEMAAKT</i>' 
                ORDER BY `creation_date` DESC
                LIMIT 1)                AS `last_update`,
            (SELECT`users`.`firstname` 
                FROM `users`
                LEFT JOIN `notifications` ON `notifications`.`user`=`users`.`id` 
                WHERE `users`.`id`=`notifications`.`user` AND `notifications`.`ticket_id`=`tickets`.`id`
                    AND `notifications`.`privacy`<='".$_SESSION['secure']."'
                    AND `notifications`.`content`!='<i>TICKET AANGEMAAKT</i>'
                ORDER BY `creation_date` DESC
                LIMIT 1)    AS `firstname_comment`,
            (SELECT `users`.`lastname` 
                FROM `users`
                LEFT JOIN `notifications` ON `notifications`.`user`=`users`.`id` 
                WHERE `users`.`id`=`notifications`.`user` AND `notifications`.`ticket_id`=`tickets`.`id`
                    AND `notifications`.`privacy`<='".$_SESSION['secure']."'
                    AND `notifications`.`content`!='<i>TICKET AANGEMAAKT</i>'
                ORDER BY `creation_date` DESC
                LIMIT 1     )AS `lastname_comment`
            
        FROM `tickets` 
        LEFT JOIN `notifications` ON `notifications`.`ticket_id`=`tickets`.`id`
        LEFT JOIN `users` ON `tickets`.`creator`=`users`.`id`
        LEFT JOIN `status` ON `tickets`.`status`=`status`.`id`
        WHERE "; 
        if($_SESSION['showClosed']!="FALSE"){
            $query .=" (`tickets`.`status`<>'7') AND ";
        }
        $query .= "(`creator`='".$_SESSION['id']."' 
            OR `assigned`='".$_SESSION['id']."'"; 
            
        switch($_SESSION['secure']){
        case 1: 
            $query.= "OR (`tickets`.`status`<'8')";
            break;
        case 2:
            $query.= "OR (`tickets`.`status`='8')";
            break;
        case 3:
            $query.= "OR (`tickets`.`status`='9')";
            break;
        case 9:
            $query.= "OR (1=1)";
            break;
        }
        if($_SESSION['secure']>=1){$query.=
            " OR `assigned`=0";}
        $query.=") 
        GROUP BY `id`
        ORDER BY `creation_time` DESC,`last_update` DESC,`creation_date` DESC, `id` DESC 
        LIMIT 10 OFFSET ".$offset;
        
        $result = mysqli_query($link, $query);
        while($row=mysqli_fetch_assoc($result)){
            if($row['status_id']==7){
                echo "<tr class='active'>";
            }elseif($row['status_id']==1||($row['assigned_id']!=$_SESSION['id'])){
                echo "<tr class='success'>";
            }else{
                echo "<tr>";
            }
                
            echo "  
                        <td>".$row['id']."</td>
                        <td>".$row['creation_time']."</td>
                        <td>".$row['firstname']." ".$row['lastname']."</td>
                        <td>".$row['title']."</td>
                        <td>".$row['status']."</td>
                        <td>".$row['last_update']."</td>
                        <td>".$row['firstname_comment']." ".$row['lastname_comment']."</td>
                        <td><button class='btn btn-default' value='".$row['id']."' name='id' type='submit'>Bekijk </button></td>
                    </tr>";
            
        }
        
        ?>
        
    </table>
</form>




<?php 
    
    $query = "SELECT COUNT(*) AS 'counted' FROM `tickets` 
        WHERE ("; 
        if($_SESSION['showClosed']!="FALSE"){
            $query .="`tickets`.`status`<>'7') AND (";
        }
            $query .= "`creator`='".$_SESSION['id']."' 
            OR `assigned`='".$_SESSION['id']."' 
            OR 1<=".$_SESSION['secure'];
        if($_SESSION['secure']>=1){$query.=" OR `assigned`=0";}
        
        $query .=")";
        
    $result=mysqli_query($link, $query);
    while($row=mysqli_fetch_assoc($result)){
        $pages=floor($row['counted']/10)+1;
        
?>

<!--  Nav bar multipage -->
<nav>
  <ul class="pagination">
    <li>
      <a href="index.php?page=<?php if($page==1){echo 1;}else{echo ($page-1);};?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php 
        for($i=($page-5);$i<$page;$i++){
            if($i>=1){
                echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
            } 
        }
        echo '<li class="active"><a>'.$page.'</a></li>';
        for($i=($page+1);$i<=$page+5;$i++){
            if($i<=$pages){
                echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
            } 
        }
    ?>
    <li>
      <a href="index.php?page=<?php if($page==$pages){echo $pages;}else{echo ($page-1);};?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<?php

    }
    include'../components/footer.php';
?>