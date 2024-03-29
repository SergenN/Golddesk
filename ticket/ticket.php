<?php
session_start();
$title = "Tickets";
$secure=0;
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
 *      Select Multiple in de Software/
 *      hardware selectie.
 *  v1.2
 *      ondersteuning voor inzien en 
 *      comment. en file uploaden.
 * 
 */
if(!isset($_POST['id'])&&!isset($_SESSION['page_id'])){
    ?>
    <div class="col-md-3">

        <img src="/img/golddesk.jpg" width="100%"/>
    </div>
    <div class="col-md-9">
        <h1>Nieuw Golddesk Support Ticket</h1>
        <br>
    </div>
    <br>
    <form action="verwerk_ticket.php" method="post">
        <!-- Static info -->
        <div class="col-md-12">
            <div class="col-md-3">
                <table class="table">
                    <tr>
                        <td colspan="2">
                            <label for="software">Selecteer de gerelateerde software.</label>
                            <select multiple="" name="software[]" class="form-control">
                                <option value=""> -Selecteer Software- </option>
                                <?php  
                                    $query ="SELECT * FROM `software` ORDER BY `name` ASC";
                                    $result = mysqli_query($link, $query);
                                    while($row=mysqli_fetch_assoc($result)){
                                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="hardware">Selecteer de gerelateerde hardware.</label>
                            <select multiple="" name="hardware[]" class="form-control">
                                <option value=""> -Selecteer Hardware- </option>
                                <?php  
                                    $query ="SELECT * FROM `hardware` ORDER BY `id` ASC";
                                    $result = mysqli_query($link, $query);
                                    while($row=mysqli_fetch_assoc($result)){
                                        echo "<option value='".$row['id']."'>".$row['id']."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="impact">Impact:</label><br><br><br><br><br><br></td>
                        <td>
                            <select name="impact" class="form-control" size="5">
                                <option value="0">Geen</option>
                                <option value="1">individue</option>
                                <option value="2">Groep</option>
                                <option value="3">Afdeling</option>
                                <option value="4">Globaal</option>
                            </select>
                            
                        </td>
                    </tr>
                    <tr>
                        <td><label for="prioriteit">Prioriteit:</label><br><br><br><br></td>
                        <td>
                            <select name="prioriteit" class="form-control" size="4">
                                <option value="0">Geen</option>
                                <option value="1">Laag</option>
                                <option value="2">Gemiddeld</option>
                                <option value="3">Hoog</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" name="type" value="new" class="btn btn-default navbar-right">Verzenden</button></td>
                    </tr>                    
                </table>
                </div>
            <!-- main div -->
            <div class="col-md-9 ">
                <label for="title">Titel</label>
                <input type="text" name="title" class="form-control" />
                <br>
                <label for="description">Omschrijving</label>
                <textarea name="description"class="form-control" rows="12"></textarea>
            </div>
        </div>
    
    </form>
    <?php
}else{
    /*
     * TICKET VIEW
     * 
     */
     if(isset($_SESSION['page_id'])){
         $_POST['id']=$_SESSION['page_id'];
         unset($_SESSION['page_id']);
     }
     $query ="SELECT `tickets`.`id` AS `id`, 
        `users`.`firstname` AS `firstname`, 
        `users`.`lastname` AS `lastname`,
        `tickets`.`title` AS `title`,
        `tickets`.`description` AS `description`,
        `tickets`.`creation_time` as `creation_time`, 
        `status`.`text` AS `status`, 
        (SELECT `users`.`firstname`FROM `users` WHERE `tickets`.`assigned`=`users`.`id`) AS `firstname_assigned`,
        (SELECT `users`.`lastname`FROM `users` WHERE `tickets`.`assigned`=`users`.`id`) AS `lastname_assigned`,
        (SELECT `users`.`id`FROM `users` WHERE `tickets`.`assigned`=`users`.`id`) AS `id_assigned`
    FROM `tickets` 
    LEFT JOIN `users` ON `tickets`.`creator`=`users`.`id` 
    LEFT JOIN `status` ON `tickets`.`status`=`status`.`id` 
    WHERE `tickets`.`id`='".secure($_POST['id'])."'";
    $result=mysqli_query($link, $query);
    while($row=mysqli_fetch_assoc($result)){
    ?>
    
    
    
    
    
    
    <div class="col-md-3">

        <img src="/img/golddesk.jpg" width="100%"/>
    </div>
    <div class="col-md-9">
        <h1>#<?php echo $row['id'];?> Ticket</h1>
        <br>
    </div>
    <br>
    <form action="verwerk_ticket.php" enctype="multipart/form-data" method="post">
        <!-- Static info -->
        <div class="col-md-12">
            <div class="col-md-3">
                <table class="table">
                    <tr>
                        <td>
                            <label>Aangemaakt door:</label>
                            <div class="form-control"><?php echo $row['firstname']." ".$row['lastname']?></div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            
                            <?php if($_SESSION['secure']>=1){ ?>
                            <div>
                                <label for="wijzig_status">Status</label>
                                <select name="nieuw_status" class="form-control">
                                    <?php 
                                        $query_status = "SELECT * FROM `status`";
                                        $result_status = mysqli_query($link, $query_status);
                                        while($row_status=mysqli_fetch_assoc($result_status)){
                                            echo "<option value='".$row_status['id']."'>".$row_status['text']."</option>";
                                            if($row['status']==$row_status['text']){
                                                echo "<option selected>".$row_status['text']."</option>";
                                            }
                                        }
                                     ?>
                                </select>
                            </div>
                            <?php }else{ ?>
                            <label for="status">status</label>
                            <div class="form-control" ><?php echo $row['status']?>
                            </div><?php };?>
                            
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="werknemer">Toegekende Werknemer</label>
                            <div class="form-control"><?php echo $row['firstname_assigned']." ".$row['lastname_assigned'];?></div>
                            <?php if($_SESSION['secure']>=1&& ($row['firstname_assigned']==""||$row['id_assigned']!=$_SESSION['id'])){
                                echo "<button class='btn btn-default' type='submit' name='type' value='take_assignment'>Ticket aannemen</button>";
                            }elseif($_SESSION['secure']==1&& $row['id_assigned']==$_SESSION['id']){
                                echo "<button class='btn btn-default' type='submit' name='type' value='escaleren2'>Ticket escaleren2</button>";
                            }elseif($_SESSION['secure']==2&& $row['id_assigned']==$_SESSION['id']){
                                echo "<button class='btn btn-default' type='submit' name='type' value='escaleren3'>Ticket escaleren3</button>";
                            }
                             
                             ?>
                             
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="returned_assignment">Geef opdracht terug aan:</label>
                            <select class="form-control" name="returned_assignment">
                                <option value=""selected></option>
                            <?php 
                                $query_assigned="SELECT `users`.`firstname` AS `firstname`,
                                 `users`.`lastname` AS `lastname`,
                                 `users`.`id` AS `id` 
                                 FROM `users`
                                 LEFT JOIN `notifications` ON `notifications`.`user`=`users`.`id`
                                 RIGHT JOIN `tickets` ON `notifications`.`ticket_id`=`tickets`.`id`
                                 WHERE `notifications`.`ticket_id`='".$_POST['id']."' 
                                    AND (`users`.`id`!=".$_SESSION['id']." 
                                    AND `users`.`id`!=`tickets`.`creator`)
                                 GROUP BY `users`.`id`
                                 ORDER BY `notifications`.`creation_date` DESC";   
                                 $result_assigned=mysqli_query($link, $query_assigned);
                                 while($row_assigned=mysqli_fetch_assoc($result_assigned)){
                                     echo "<option value='".$row_assigned['id']."' >".$row_assigned['firstname']." ".$row_assigned['lastname']."</option>";
                                 }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="impact">Aanmaak datum</label>
                            <div class="form-control"><?php echo $row['creation_time'];?></div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            hier komt nog text
                        </td>
                    </tr>                    
                </table>
                </div>
            <!-- main div -->
            <div class="col-md-9 ">
                
                <?php
                echo "<div class='panel panel-default panel-body'>".$row['description']."</div><div style='max-height: 500px; overflow-y: scroll;'>";
                    $query = "SELECT `notifications`.`creation_date` AS `creation_date`,
                                `notifications`.`content` AS `content`,
                                `notifications`.`privacy` AS `privacy`,
                                `notifications`.`type` AS `type`,
                                `users`.`firstname` AS `firstname`,
                                `users`.`lastname` AS `lastname`
                                FROM `notifications`
                                LEFT JOIN `users` ON `notifications`.`user`=`users`.`id`
                                WHERE `ticket_id`='".$_POST['id']."' AND `notifications`.`privacy`<='".$_SESSION['secure']."'
                                ORDER BY `creation_date` DESC";
                    $result=mysqli_query($link, $query);
                    while($row=mysqli_fetch_assoc($result)){
                        echo comment($row['firstname']." ".$row['lastname'],$row['creation_date'],$row['type'],$row['content'],$_POST['id'],$row['privacy']).'<hr>';
                    };?>
                    </div>
                    <div>
                        nieuw reactie:
                        
                                                   
                            <textarea  type="text" id="text" name="comment" wrap="hard" class="form-control" rows="10"></textarea><br>
                            <input name="id" value="<?php echo $_POST['id']; ?>"  class="hidden"/>
                            
                            
                            <div class="form-inline">
                                <input type="file" name="file" class="form-control"/>
                                <?php if($_SESSION['secure']>=1){
                                     echo '
                                <label>
                                    <input type="checkbox" value="1" name="privacy"/>
                                    verberg voor klant
                                </label>';}?>
                                <button  type="submit" name="type" value="comment" class="btn btn-default navbar-right">Verstuur</button>
                                
                            </div>
                        
                    </div>
            </div>
        </div>
    
    </form>
    
    
    
    <?php
    }
}

include'../components/footer.php';?>