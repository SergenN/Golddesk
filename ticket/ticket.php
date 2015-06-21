<?php
session_start();
$title = "Tickets";
$secure=0;
include'../components/secure_header.php';
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
 * 
 */
if(!isset($_POST['id'])){
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
     $query ="SELECT `tickets`.`id` AS `id`, 
        `users`.`firstname` AS `firstname`, 
        `users`.`lastname` AS `lastname`,
        `tickets`.`title` AS `title`,
        `tickets`.`description` AS `description`,
        `tickets`.`creation_time` as `creation_time`, 
        `status`.`text` AS `status`, 
        (SELECT `users`.`firstname`FROM `users` WHERE `tickets`.`assigned`=`users`.`id`) AS `firstname_assigned`,
        (SELECT `users`.`lastname`FROM `users` WHERE `tickets`.`assigned`=`users`.`id`) AS `lastname_assigned`
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
    <form action="verwerk_ticket.php" method="post">
        <!-- Static info -->
        <div class="col-md-12">
            <div class="col-md-3">
                <table class="table">
                    <tr>
                        <td>
                            <label for="status">status</label>
                            <div class="form-control" ><?php echo $row['status']?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="werknemer">Toegekende Werknemer</label>
                            <div class="form-control"><?php echo $row['firstname_assigned']." ".$row['lastname_assigned'];?></div>
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
                echo "<div class='panel panel-default panel-body'>".$row['description']."</div>";
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
                        echo comment($row['firstname']." ".$row['lastname'],$row['creation_date'],$row['type'],$row['content'],$_POST['id']).'<hr>';
                    };?>
                    <div>
                        nieuw reactie:
                        
                        <form action="verwerk_ticket.php" method="post">
                            <textarea  type="text" id="text" name="comment" wrap="hard" class="form-control" rows="10"></textarea><br>
                            
                            
                            
                            <div class="form-inline">
                                <input type="file" class="form-control"/>
                                <?php if($_SESSION['secure']>=1){
                                     echo '
                                <label>
                                    <input type="checkbox" value="1" name="privacy"/>
                                    verberg voor klant
                                </label>';}?>
                                <button  type="submit" name="type" value="comment" class="btn btn-default navbar-right">Verstuur</button>
                                
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    
    </form>
    
    
    
    <?php
    }
}

include'../components/footer.php';?>