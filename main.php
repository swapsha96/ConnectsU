<?php
include_once"php/no-cache.php";
session_start();
if(isset($_SESSION['alphago_em'])) {
    $id = $_SESSION['alphago_id'];
    $fn = $_SESSION['alphago_fn'];
}
else {
    header("location: /");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ConnectsU</title>
    <link rel="icon" href="img/connectsu.jpg">

    <!-- Bootstrap -->
    <link href="mdl/material.css" rel="stylesheet">
    <link href="css/alphago.css" rel="stylesheet">
    
    <style type="text/css">
     
    
    #left_tabs{
        position : absolute;
        top: 100px;
        left : 15%;
        right : 39%;
    }
    
     #right_tabs{
        position : fixed;
        width : 25%;
        top : 100px;
        right : 15%;
        bottom : 100px;
    }
    
    </style>
    
    <script>
        function LoadOnce(){
            window.location.reload(true);
        }
        function myFunction() {
            myVar = setTimeout(showPage, 3000);
        }
        
        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("main").style.display = "block";
        } 
 
    </script>
  </head>
  <body onload="myFunction()" style="margin:0;">
           
    <div id = "loader" class="cs-loader">
        <div class="cs-loader-inner">
            <label style="width: 1%"> <img src="img/loading.png" width="100%" style="opacity: 0.4"></label>
            <label style="width: 1%"> <img src="img/loading.png" width="100%" style="opacity: 0.4"></label>
            <label style="width: 1%"> <img src="img/loading.png" width="100%" style="opacity: 0.4"></label>
            <label style="width: 1%"> <img src="img/loading.png" width="100%" style="opacity: 0.4"></label>
            <label style="width: 1%"> <img src="img/loading.png" width="100%" style="opacity: 0.4"></label>
            <label style="width: 1%"> <img src="img/loading.png" width="100%" style="opacity: 0.4"></label>
        </div>
    </div>
      
    <div id="main" style="display: none" class="animate-bottom">
        <?php 
        if (file_exists("profiles/" . $id . "/back.png")) {
            $opa = fopen("profiles/" . $id . "/opa.dat","r");
            $opacity = fread($opa, filesize("profiles/" . $id . "/opa.dat"));
            fclose($opa);
            echo "<div id='back' style=\"opacity: ".$opacity."; background-image: url('profiles/" . $id . "/back.png');\" ></div>";
        }
            ?>
        <header class="header mdl-layout__header">
          <div class="mdl-layout__header-row">
              <div id="title"><h3 >ConnectsU</h3></div>
              <div id = "headbtn">
                  <a href="main.php" style="text-decoration:none">
                  <button id="home" class="head_button mdl-button mdl-js-button">
                      <img class="headicon" src="img/home.png">
                  </button>
                  </a>
                  <div class="mdl-tooltip" data-mdl-for="home">
                      Main
                  </div>
                  <a href="profile.php" style="text-decoration:none">
                  <button id = "profile" class="head_button mdl-button mdl-js-button">
                      <img class="headicon" src="img/user-shape.png">
                  </button>
                  <div class="mdl-tooltip" data-mdl-for="profile">
                      Profile
                  </div>
                  </a>
                  <a href="settings.php" style="text-decoration:none">
                  <button id = "setting" class="head_button mdl-button mdl-js-button">
                      <img class="headicon" src="img/settings.png">
                  </button>
                  <div class="mdl-tooltip" data-mdl-for="setting">
                      Settings
                  </div>
                  </a>
                  <a href="php/a.php?a=logout" style="text-decoration:none">
                  <button id = "logout" class="head_button mdl-button mdl-js-button">
                      <img class="headicon" src="img/sign-out-option.png">
                  </button>
                  <div class="mdl-tooltip" data-mdl-for="logout">
                      Log Out
                  </div>
                  </a>
              </div>
              <div id="searchbar">
                  <form action="search.php" method="POST">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
                          <label id = "search" class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp">
                              <img class="headicon" src="img/search.png">
                          </label>
                          <div class="mdl-tooltip" data-mdl-for="search">
                               Search
                          </div>
                          <div class="mdl-textfield__expandable-holder">
                              <input class="mdl-textfield__input" type="text" name="search" id="fixed-header-drawer-exp">
                          </div>
                      </div>
                  </form>
              </div>
        </header>

        <div id="left_tabs">  

         <div class="block mdl-card mdl-shadow--4dp" id="status">
             <?php echo "<form action=\"php/a.php?a=submitpost&id=".$id."&target=main\" method=\"POST\">"; ?>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style=" width: 100%">
                    <textarea class="mdl-textfield__input" name="post_input" rows="5" id="status"></textarea>
                <label class="mdl-textfield__label" for="status">What's new?</label>
                </div>
                <button id="post" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-button--accent" name="post_submit">Post</button>
            </form>
          </div>
            
            <?php
            include_once 'php/c.php';
            $t = $id."_main";
            $q = mysqli_query($c, "SELECT * FROM $t WHERE status = 'active' ORDER BY time DESC");
            if(mysqli_num_rows($q) > 0) {
                while ($f = mysqli_fetch_array($q)) {
                    $pid = $f['user'];
                    $time = $f['time'];
                    $tc = $pid."_posts";
                    $qc = mysqli_query($c, "SELECT * FROM $tc WHERE time = ".$time."");
                    if(mysqli_num_rows($qc) == 0)
                    continue;
                    $q1 = mysqli_query($c, "SELECT fullname FROM members_list WHERE id = ".$pid);
                    while ($f1 = mysqli_fetch_array($q1)){
                        $pfn = $f1['fullname'];
                    }
                    $post = nl2br($f['post']);
                    $details = $f['details'];
                    echo "<div class=\"block mdl-card mdl-shadow--4dp\" id=\"status\">
                        <table style='height: 30px; border-radius: 30px; background-color: #F5F5F5; padding: 5px'><tr><td><div style=\" width: 30px; height: 30px; border-radius: 15px; background-repeat: no-repeat; background-image: url('profiles/".$pid."/profile.png'); background-size: cover; background-position: top;\"></div></td><td><a style='margin: 10px;' href='profile.php?id=".$pid."'><b>$pfn</b></a></td></tr></table>
                        <br/>$post<hr/>";
                    $t3 = $pid."_posts";
                    $q3 = mysqli_query($c, "SELECT * FROM $t3 WHERE time = ".$time);
                    while($f3 = mysqli_fetch_array($q3)){
                        $postid = $f3['id'];
                    }
                    $t3 = $pid."_".$postid."_comments";
                    mysqli_query($c, "CREATE TABLE IF NOT EXISTS $t3 (id INT(250) PRIMARY KEY AUTO_INCREMENT, user INT(250), comment LONGTEXT, status VARCHAR(250))");
                    $q3 = mysqli_query($c, "SELECT * FROM $t3 WHERE status = 'active'");
                    echo "<br><div style='block: inline'><form action='php/a.php?a=postcomment&id=".$pid."&pid=".$postid."&redirect=main.php' method='POST'><textarea placeholder='write a comment...' style='font-family: sans-serif; font-size: 12px; width: 70%;border:none;border-bottom: solid 1px #E2E2E2;' rows='2' name='comment'></textarea>"
                            . '<button id="comment" style="float: right" name="comment_submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                    Comment
                               </button></form></div><br>';
                    echo "<table id='comments' class= '".$postid."' style=' font-size: 15px;'>";
                    while($f3 = mysqli_fetch_array($q3)) {
                        $cid = $f3['id'];
                        $cu = $f3['user'];
                        $cq = mysqli_query($c, "SELECT * FROM members_list WHERE id = ".$cu."");
                        while ($cf = mysqli_fetch_array($cq))
                            $cfn = $cf['fullname'];
                        $comment = nl2br($f3['comment']);
                        echo "<tr id='c".$postid.$cid."'><td valign='top'><div style=\"width: 15px; height: 15px; border-radius: 15px; background-repeat: no-repeat; background-image: url('profiles/".$cu."/profile.png'); background-size: cover; background-position: top;\"></div></td><td style='width: 10%; margin: 5px; text-align: center;' valign='top'><a style='text-decoration: none;' href='profile.php?id=".$cu."'><b>$cfn</b></a></td><td style='margin-left: 15px; width: 80%'>$comment</td><td valign='top' style=' text-align: right' valign='top'>";
                        if($id == $cu ) { 
                            echo "<a style='cursor: pointer; text-decoration: none' onclick='deletecomment(".$id.",".$postid.",".$cid.")'>X</a>";
                        }
                        else {
                            echo "";
                        }
                        echo "</td></tr>";
                    }
                    echo "</table><hr>";
                $t2 = $pid."_".$postid."_votes";
                $q2 = mysqli_query($c, "SELECT * FROM $t2");
                $myvote = "<a onclick='vote(".$pid.",".$postid.")' style='cursor: pointer' id='vote".$postid.$pid."'><img id='img".$postid.$pid."' width='3%' src='img/upvote.png'></a>"
                                     ."<div id='tooltip".$postid.$pid."' class='mdl-tooltip mdl-tooltip--top' data-mdl-for='vote".$postid.$pid."'>
                                        Vote
                                    </div>";
                while ($f2 = mysqli_fetch_array($q2)){
                        if($f2['user'] == $id) {
                            $myvote = "<a onclick='removevote(".$pid.",".$postid.")' style='cursor: pointer' id='vote".$postid.$pid."'><img id='img".$postid.$pid."' width='3%' src='img/downvote.png'></a>"
                                     ."<div id='tooltip".$postid.$pid."' class='mdl-tooltip mdl-tooltip--top' data-mdl-for='vote".$postid.$pid."'>
                                        Remove Vote
                                    </div>";
                            break;
                        }
                }
                $count = mysqli_num_rows($q2);
                if($count == 1) {
                    echo "
                        <span style='font-size: 70%;'>
                            <span style='float: left'>
                                <span style='padding:4px; background-color: #F5F5F5; border-radius: 1px;' id='nvote".$postid.$pid."'>1 vote</span> | 
                                $myvote
                            </span>
                            <span style='padding:4px; background-color: #F5F5F5; border-radius: 2px; position: absolute; right: 10px; bottom: 10px;'>
                                $details
                            </span>
                       </span>
                    </div>";
                }
                else {
                    echo "
                        <span style='font-size: 70%;'>
                            <span style='float: left'>
                               <span style='padding:4px; background-color: #F5F5F5; border-radius: 1px;' id='nvote".$postid.$pid."'>".$count." votes</span> | 
                                $myvote
                            </span>
                            <span style='padding:4px; background-color: #F5F5F5; border-radius: 2px; position: absolute; right: 10px; bottom: 10px;'>
                                $details
                            </span>
                    </div>";
                }
                echo "<script>setInterval(function(){"
                        
                        . "$.get('php/a.php?a=getvotes&id=".$pid."&pid=".$postid."', function(data, status){"
                            . "if(data == 1)
                                    $('#nvote".$postid.$pid."').html(data + ' vote');
                                else
                                    $('#nvote".$postid.$pid."').html(data + ' votes');"
                        . "});"
                        . "}, 1000);</script>";
                }
            }
            else {
                echo "<div class=\"block mdl-card mdl-shadow--4dp\" id=\"status\"><b>Nothing new in the world. :/</b><br/>Make new mates and find more about their life.</div>";
            }
     ?>
             <dialog style="width: 60%; padding: 10px; max-height: 600px; border-radius: 2px; overflow-y: auto; background-color:rgba(255, 255, 255, 0.98)" id='noticeboard' class="mdl-dialog">
            <div id='notice' class="mdl-dialog__content"></div>
            <div class="mdl-dialog__actions">
                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent close">Close</button>
            </div>
        </dialog>
        </div>

        <div id="right_tabs">
            <div class="block mdl-card mdl-shadow--4dp" id="notification">
                <span style="font-size: 25px">Notifications</span>
                <div style='position : absolute; top:20px; right:10px;'>
                    <a onclick='readall()' style='text-decoration:none' class='mdl-spacer'>
                        <button id = 'readall' class='head_button mdl-button mdl-js-button'>
                            <img class='headicon' src='img/read-all.png'>
                        </button>
                        <div class='mdl-tooltip' data-mdl-for='readall'>
                        Mark all as read
                        </div>
                    </a>
                </div>
                <hr/>
                <?php
                $t = $id."_notify";
                $q = mysqli_query($c, "SELECT * FROM $t WHERE status = 'unread' ORDER BY time DESC");
                if(mysqli_num_rows($q) == 0) {
                    echo "No new notifications!";
                }
                else {
                    while ($f = mysqli_fetch_array($q)) {
                        $nid = $f['id'];
                        $notify = $f['notify'];
                        $details = $f['details'];
                        $status = $f['status'];
                        echo "<div style='display: block;' id='n".$nid."'>
                                <div style='float:right'>
                                    <a onclick='read(".$nid.")' style='cursor: pointer; text-decoration:none' class='mdl-spacer'>
                                        <button id = 'n.".$nid."' class='head_button mdl-button mdl-js-button'>
                                            <img class='headicon' src='img/read.png'>
                                        </button>
                                        <div class='mdl-tooltip' data-mdl-for='n.".$nid."'>
                                        Mark as read
                                        </div>
                                    </a>
                                </div>
                                <b>$notify</b>
                                <br/><br/><span style='float: right; font-size: 15px'>$details</span><hr/>
                            </div>";
                    }
                }
                ?>
            </div>
            <div id="suggestedfriends" class="block mdl-card mdl-shadow--4dp">
           <span style="font-size: 25px">Suggested Mates</span><hr>
            <?php
                $q1 = 'SELECT '.$id.'_mates.user AS fid, COUNT('.$id.'_posts.id) AS nposts FROM '.$id.'_mates LEFT JOIN '.$id.'_posts ON '.$id.'_mates.user = '.$id.'_posts.user WHERE '.$id.'_mates.status LIKE "friend" GROUP BY '.$id.'_mates.user ORDER BY nposts DESC LIMIT 3;';
                $r1 = mysqli_query($c, $q1);
                echo "<table>";
                while($row1 = mysqli_fetch_array($r1)){
                    $tfid = $row1['fid'];
                    $q2 = 'SELECT '.$tfid.'_mates.user AS fid, COUNT('.$tfid.'_posts.id) AS nposts FROM '.$tfid.'_mates LEFT JOIN '.$tfid.'_posts ON '.$tfid.'_mates.user = '.$tfid.'_posts.user WHERE '.$tfid.'_mates.status LIKE "friend" AND '.$tfid.'_mates.user != "'.$id.'" AND 0 = (SELECT COUNT(*) FROM '.$id.'_mates WHERE '.$id.'_mates.user = '.$tfid.'_mates.user ) GROUP BY '.$tfid.'_mates.user ORDER BY nposts DESC;';
                    $r2 = mysqli_query($c, $q2);
                    while($row2 = mysqli_fetch_array($r2)){
                        $sfid = $row2['fid'];
                        $q3 = 'SELECT * FROM members_list WHERE id = '.$sfid;
                        $r3 = mysqli_query($c, $q3);
                        while($row3 = mysqli_fetch_array($r3)){
                            $sffn = $row3['fullname'];
                            echo "<tr><td valign='center' style='width: 30px'><div style=\"width: 15px; height: 15px; border-radius: 15px; background-repeat: no-repeat; background-image: url('profiles/".$sfid."/profile.png'); background-size: cover; background-position: top;\"></div></td><td><a style='text-decoration: none; margin: 5px;' href='profile.php?id=".$sfid."'><b>$sffn</b></a></td><td>"
                                    . "<a id = 'add".$sfid."' href='php/a.php?a=addmate&id=".$sfid."' style='text-decoration:none;' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'>
                                Add
                                <div class='mdl-tooltip mdl-tooltip--top' data-mdl-for='add".$sfid."'>
                                    Be a mate
                                </div>
                            </a></td></tr>";
                               break;
                        }
                    }
                }
                echo "</table>";
            ?>
        </div>
        </div>

    </div>
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="script/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="mdl/material.min.js"></script>
    <script>
        function vote(i, pi){
            $.get("php/a.php?a=vote&id=" + i +"&pid=" + pi, function(data, status){
                
                
               $("#img" + pi + i).attr("src","img/downvote.png");
               $("#tooltip" + pi + i).html("Remove Vote");
               $("#vote" + pi + i).attr("onclick","removevote("+ i + "," + pi + ")");
               
               if(data == 1)
                   $("#nvote" + pi + i).html(data + " vote");
               else
                   $("#nvote" + pi + i).html(data + " votes");
            });
        }
        
        function removevote(i, pi){
            $.get("php/a.php?a=removevote&id=" + i +"&pid=" + pi, function(data, status){
               
               $("#img" + pi + i).attr("src","img/upvote.png");
               $("#tooltip" + pi + i).html("Vote");
               $("#vote" + pi + i).attr("onclick","vote("+ i + "," + pi + ")");
               
                if(data == 1)
                   $("#nvote" + pi + i).html(data + " vote");
               else
                   $("#nvote" + pi + i).html(data + " votes");
               
               
            });
        }
        
        function read(nid){
            $.get("php/a.php?a=readnotify&nid=" + nid, function(){
                    $("#n" + nid).fadeOut(100);
            });
        }
        
        function readall(){
            <?php
            $t = $id."_notify";
                $q = mysqli_query($c, "SELECT * FROM $t WHERE status = 'unread'");
                 while ($f = mysqli_fetch_array($q)){
                     $nid = $f['id'];
                     echo "$('#n".$nid."').fadeOut(100);";
                 }
            ?>
            $.get("php/a.php?a=readall");
        }
        
        function deletecomment(u, pid, cid){
             $.get("php/a.php?a=deletecomment&id=" + u + "&pid=" + pid + "&cid=" + cid, function(){
     
                    $("#c" + pid + cid).animate({opacity: "0"},500).fadeOut(1);
            });
        }
        head = "<p style='text-align: center; font-size: 35px;'>Noticeboard<hr/></p>"
        function viewnotice(id) {
            $.get("php/a.php?a=viewnotice", {"nid": id}, function(reply) {
                $("#notice").html(head + reply);
                notice.showModal();
            });
        }
        
        var notice = document.querySelector('#noticeboard');
        if (! notice.showModal) {
          dialogPolyfill.registerDialog(notice);
        }
        notice.querySelector('.close').addEventListener('click', function() {
          notice.close();
        });
    </script>
  </body>
</html>