<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once "php/c.php";

$r = mysqli_query($c, 'SELECT * FROM members_list');

while($r1 = mysqli_fetch_array($r)){
    $id = $r1['id'];
    
    $r2 = mysqli_query($c, 'SELECT * FROM '.$id.'_mates');
    
    $triggerdel = "CREATE TRIGGER ".$id."del
                                                    BEFORE DELETE ON ".$id."_posts
                                                    FOR EACH ROW
                                                    BEGIN";
    
    $triggerins = "CREATE TRIGGER ".$id."ins
                                                    AFTER INSERT ON ".$id."_posts
                                                    FOR EACH ROW
                                                    BEGIN";
    while($r3 = mysqli_fetch_array($r2)){
        $u = $r3['user'];
        $triggerdel .= " DELETE FROM ".$u."_main WHERE ".$u."_main.id = old.id;";
        $triggerins .= ' INSERT INTO '.$u.'_main VALUES(new.id, new.user, new.post, new.time, new.details,"public", "active" );';
      
    }
    
    $triggerdel .= " END";
    $triggerins .= " END";
    echo $triggerdel;
    mysqli_multi_query($c, $triggerdel);
    mysqli_multi_query($c, $triggerins);
    echo "<html><hr></html>";
}