<?php
include_once"php/no-cache.php";
session_start();
if(isset($_SESSION['alphago_em'])) {
    include_once 'php/c.php';
    $id = $_SESSION['alphago_id'];
    if(isset($_GET['id'])) {
        $u = $_GET['id'];

        if ($u != "") {
            $q = mysqli_query($c, "SELECT * FROM members_list WHERE id = '".$u."'");
            if(mysqli_num_rows($q) != 1){
                header("location: /");
            }
        }
        else {
            $u = $id;
        }
    }
    else {
        $u = $id;
    }
}
else {
    header("location: ../");
}
?>
<?php
$q = mysqli_query($c, "SELECT * FROM members_list WHERE id = '".$u."'");
while ($f = mysqli_fetch_array($q)) {
    $fn = $f['fullname'];
    $em = $f['email'];
}
$q = mysqli_query($c, "SELECT * FROM members_details WHERE id = '".$u."'");
while ($f = mysqli_fetch_array($q)) {
    $gd = $f['gender'];
    $dob = $f['dob'];
    $contact = $f['contact'];
    $about = $f['about'];
    $hobbies = $f['hobbies'];
    $clubs = $f['clubs'];
    $courses = $f['courses'];
    $projects = $f['projects'];
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
    
    #center_tabs{
        position : absolute;
        top: 100px;
        left : 30%;
        right : 34.2%;
    }
    
     #left_tabs{
        position : absolute;
        width : 15%;
        top : 100px;
        left : 15%;
    }
    
     #right_tabs{
        position : fixed;
        width : 20%;
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
        if (file_exists("profiles/" . $u . "/back.png")) {
            $opa = fopen("profiles/" . $u . "/opa.dat","r");
            $opacity = fread($opa, filesize("profiles/" . $u . "/opa.dat"));
            fclose($opa);
            echo "<div id='back' style=\"opacity: ".$opacity."; background-image: url('profiles/" . $u . "/back.png');\" ></div>";
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
          <div class="block mdl-card mdl-shadow--4dp" id="profile_picture">
              <?php
                      echo "<img class=\"profile_pic\" src=\"profiles/" . $u . "/profile.png\" style=\"width : 100%\">";
              
                  echo "<hr>";
                  if($u == $id){
                      
                    echo '<a id="edit" href="settings.php?a=ppic" style="text-decoration:none"  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                            Update Photo
                            <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="edit">
                                Update Profile Picture
                            </div>
                        </a>';
                  }
                  else{
                      $t = $id."_mates";
                      $q = mysqli_query($c, "SELECT * FROM $t WHERE user = ".$u);
                      if(mysqli_num_rows($q) == 0) {
                            echo '<a id = "add" href="php/a.php?a=addmate&id='.$u.'" style="text-decoration:none;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                Add
                                <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="add">
                                    Be a mate
                                </div>
                            </a>';
                      }
                      else {
                          while ($f = mysqli_fetch_array($q))
                                  $r = $f['status'];
                          if($r == "request") {
                                
                                echo '<a id = "add" href="php/a.php?a=acceptmate&id='.$u.'" style="text-decoration:none;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                    Accept
                                    <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="add">
                                        Add as mate
                                    </div>
                                    </a><br/>
                                    <a id = "cancel" href="php/a.php?a=removemate&id='.$u.'" style="text-decoration:none;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                    Cancel
                                    <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="cancel">
                                        Reject the request
                                    </div>
                                    </a>';
                          }
                          elseif($r == "sent") {
                                echo '<a id = "add" href="php/a.php?a=removemate&id='.$u.'" style="text-decoration:none;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                Cancel
                                <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="add">
                                    Cancel the request
                                </div>
                                </a>';
                          }
                          elseif($r == "friend") {
                                echo '<a id = "add" href="php/a.php?a=removemate&id='.$u.'" style="text-decoration:none;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                Remove
                                <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="add">
                                    Disconnect
                                </div>
                                </a>';
                          }
                      }
                  }
              ?>
          </div>

        <div class="block mdl-card mdl-shadow--4dp" id="details">
            <?php
            
            $t = $u."_mates";
            $check = mysqli_query($c, "SELECT * FROM $t WHERE user = ".$id. " AND status = 'friend'");
            if(mysqli_num_rows($check) != 0 || $u == $id) {
                echo "<b style='font-size:20px'>$fn</b><hr/>"
                        . "<button id='show-dialog' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'>See all mates</button>"
                        . "<br/><br/>$gd</br>$dob";
            }
            else {
                echo "You need to need in his/her mates list.<br/>Send request to see profile.";
            }
            ?>
            
            <dialog style="width: 60%; max-height: 600px; border-radius: 2px; overflow-y: auto; background-color:rgba(255, 255, 255, 0.98)" id='mates' class="mdl-dialog">
                <div class="mdl-dialog__content">

                            <p style="font-size: 35px; text-align: center;">Mates<hr/></p>
                            <div>
                            <?php
                            $t = $u."_mates";
                            $q = mysqli_query($c, "SELECT * FROM $t WHERE status = 'friend'");
                            while($f = mysqli_fetch_array($q)) {
                                $user = $f['user'];
                                $q1 = mysqli_query($c, "SELECT * FROM members_list WHERE id = ".$user);
                                while ($f1 = mysqli_fetch_array($q1))
                                        $fn = $f1['fullname'];
                                if(file_exists("profiles/" . $user . "/profile.png"))
                                    echo "<img class=\"profile_pic\" src=\"profiles/" . $user . "/profile.png\" style=\"height: 125px\">";
                                else
                                    echo "<img class=\"profile_pic\" src=\"img/person.jpg\" style=\"height: 125px\">";
                                echo "<div style='float: right; text-align: right'>
                                    <span style='font-size: 20px'>$fn</span><br/>(<a href='profile.php?id=".$user."' style='font-size: 15px'>View profile</a>)<br/><br/>
                                    <a id = \"add\" href=\"php/a.php?a=removemate&id=".$user."\" style=\"text-decoration:none;\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent\">
                                            Remove
                                            <div class=\"mdl-tooltip mdl-tooltip--top\" data-mdl-for=\"add\">
                                                Disconnect
                                            </div>
                                            </a>
                                </div><hr/>";
                            }
                            ?>
                            </div>

                </div>
                <div class="mdl-dialog__actions">
                  <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent close">Close</button>
                </div>
              </dialog>
        </div>

        </div>

      <div id="center_tabs">  
          <div class="block mdl-card mdl-shadow--4dp" id="gallery">
              <b style="font-size: 20px">Know more about me</b><hr/>
              <?php
              if($contact == "" && $about == "" && $hobbies == "" && $clubs == "" && $courses == "" && $projects == "") {
                  echo "Nothing to show you right now.";
              }
              ?>
              <table>
              <?php
                if($contact != "") {
                    echo "<tr><td><b>Contact</b></td><td>".$contact."</td></tr>";
                }
                if($about != "") {
                    echo "<tr><td><b>About</b></td><td>".$about."</td></tr>";
                }
                if($hobbies != "") {
                    echo "<tr><td><b>Hobbies</b></td><td>".$hobbies."</td></tr>";
                }
                if($clubs != "") {
                    echo "<tr><td><b>Clubs</b></td><td>".$clubs."</td></tr>";
                }
                if($courses != "") {
                    echo "<tr><td><b>Courses</b></td><td>".$courses."</td></tr>";
                }
                if($projects != "") {
                    echo "<tr><td><b>Projects</b></td><td>".$projects."</td></tr>";
                }
              ?>
              </table>
          </div>


        <div class="block mdl-card mdl-shadow--4dp" id="status">
            <?php
            
            if(mysqli_num_rows($check) != 0 || $u == $id) {
                echo "<form action=\"php/a.php?a=submitpost&id=".$u."&target=profile\" method=\"POST\">
                    <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' style=' width: 100%'>
                    <textarea class='mdl-textfield__input' name='post_input' rows='5' id='status'></textarea>
                <label class='mdl-textfield__label' for='status'>What's new?</label>
                </div>
                <button id='post' class='mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-button--accent' name='post_submit'>Post</button>
                    ";
            }
            else {
                echo "You need to need in his/her mates list.<br/>Send request to see profile.";
            }
            ?>
                
            </form>
        </div>
      <?php
      $t = $u."_posts";
      $q = mysqli_query($c, "SELECT * FROM $t WHERE status = 'active' ORDER BY time DESC");
      while ($f = mysqli_fetch_array($q)) {
          $pid = $f['id'];
          $user = $f['user'];
          $q1 = mysqli_query($c, "SELECT * FROM members_list WHERE id = ".$user."");
          while ($f1 = mysqli_fetch_array($q1))
          $fn = $f1['fullname'];
          $post = nl2br($f['post']);
          $rx = '~
            ^(?:https?://)?              # Optional protocol
             (?:www\.)?                  # Optional subdomain
             (?:youtube\.com|youtu\.be)  # Mandatory domain name
             /watch\?v=([^&]+)           # URI with video id as capture group 1
             ~x';
          $has_match = preg_match($rx, $post, $matches);
          if($has_match) {
                $post = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$post);
          }
          else {
                $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                $post = preg_replace($url, '<a href="http$2://$4" target="_blank">$0</a>', $post);
          }
          $details = $f['details'];
          echo "<div class=\"block mdl-card mdl-shadow--4dp\" id='post".$pid."'>";
                
                if($u == $id || $id == $user){
                    echo "<div style='position : absolute; right:10px;'>
                            <a onclick=\"deletepost('".$u."','".$pid."')\" style='text-decoration:none' class='mdl-spacer'>
                                <button id = '$pid.delete' class='head_button mdl-button mdl-js-button'>
                                    <img class='headicon' src='img/remove.png'>
                                </button>
                                <div class='mdl-tooltip' data-mdl-for='$pid.delete'>
                                    Delete
                                </div>
                           </a>
                        </div>";
                }
                $t2 = $u."_".$pid."_votes";
                $q2 = mysqli_query($c, "SELECT * FROM $t2");
                $myvote = "<a onclick='vote(".$u.",".$pid.")' style='cursor: pointer' id='vote".$pid."'><img id='img".$pid."' width='3%' src='img/upvote.png'></a>"
                                     ."<div id='tooltip".$pid."' class='mdl-tooltip mdl-tooltip--top' data-mdl-for='vote".$pid."'>
                                        Vote
                                    </div>";
                while ($f2 = mysqli_fetch_array($q2)) {
        if ($f2['user'] == $id) {
            $myvote = "<a onclick='removevote(".$u.",".$pid.")' style='cursor: pointer' id='vote".$pid."'><img id='img".$pid."' width='3%' src='img/downvote.png'></a>"
                                     ."<div id='tooltip".$pid."' class='mdl-tooltip mdl-tooltip--top' data-mdl-for='vote".$pid."'>
                                        Remove Vote
                                    </div>";
            break;
        }
    }
                $count = mysqli_num_rows($q2);
                if($count == 1) {
                    echo "<table style='height: 30px; border-radius: 30px; background-color: #F5F5F5; padding: 5px;' ><tr><td><div style=\"width: 30px; height: 30px; border-radius: 30px; background-repeat: no-repeat; background-image: url('profiles/".$user."/profile.png'); background-size: cover; background-position: top;\"></div></td><td><a style='margin: 10px;' href='profile.php?id=".$user."'><b>$fn</b></a></td></tr></table>
                        <hr>$post<br><br>";
                    $t3 = $u."_".$pid."_comments";
                    mysqli_query($c, "CREATE TABLE IF NOT EXISTS $t3 (id INT(250) PRIMARY KEY AUTO_INCREMENT, user INT(250), comment LONGTEXT, status VARCHAR(250))");
                    $q3 = mysqli_query($c, "SELECT * FROM $t3 WHERE status = 'active'");
                    echo "<br><div style='block: inline'><form action='php/a.php?a=postcomment&id=".$u."&pid=".$pid."&redirect=profile.php' method='POST'><textarea placeholder='write a comment...' style='font-family: sans-serif; font-size: 12px; width: 70%;border:none;border-bottom: solid 1px #E2E2E2;' rows='2' name='comment'></textarea>"
                            . '<button id="comment" style="float: right" name="comment_submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                    Comment
                               </button></form></div><br>';
                    echo "<table id='comments' class= '".$pid."' style=' font-size: 15px;'>";
                    while($f3 = mysqli_fetch_array($q3)) {
                        $cid = $f3['id'];
                        $cu = $f3['user'];
                        $cq = mysqli_query($c, "SELECT * FROM members_list WHERE id = ".$cu."");
                        while ($cf = mysqli_fetch_array($cq))
                            $cfn = $cf['fullname'];
                        $comment = nl2br($f3['comment']);
                        echo "<tr id='c".$pid.$cid."'><td valign='top'><div style=\"width: 15px; height: 15px; border-radius: 15px; background-repeat: no-repeat; background-image: url('profiles/".$cu."/profile.png'); background-size: cover; background-position: top;\"></div></td><td valign='top'><a style='text-decoration: none; margin: 5px;' href='profile.php?id=".$cu."'><b>$cfn</b></a></td><td style='width: 95%'>$comment</td><td valign='top' style=' text-align: right' valign='top'>";
                        if($id == $cu || $id == $u) { 
                            echo "<a style='cursor: pointer; text-decoration: none' onclick='deletecomment(".$u.",".$pid.",".$cid.")'>X</a>";
                        }
                        else {
                            echo "";
                        }
                        echo "</td></tr>";
                    }
                    echo "</table><hr>";
                    echo "<span style='font-size: 70%;'>
                            <span style='float: left'>
                                <span style='padding:4px; background-color: #F5F5F5; border-radius: 1px;' id='nvote".$pid."'>1 vote</span> | 
                                $myvote
                            </span>
                            <span style='padding:4px; background-color: #F5F5F5; border-radius: 2px; position: absolute; right: 10px; bottom: 10px;'>
                                $details
                            </span>
                       </span></div>";
                }
                else {
                    echo "<table style='height: 30px; border-radius: 30px; background-color: #F5F5F5; padding: 5px'><tr><td><div style=\"width: 30px; height: 30px; border-radius: 30px; background-repeat: no-repeat; background-image: url('profiles/".$user."/profile.png'); background-size: cover; background-position: top; \"></div></td><td><a style='margin: 10px;' href='profile.php?id=".$user."'><b>$fn</b></a></td></tr></table>
                        <hr>$post<br><br>";
                    $t3 = $u."_".$pid."_comments";
                    mysqli_query($c, "CREATE TABLE IF NOT EXISTS $t3 (id INT(250) PRIMARY KEY AUTO_INCREMENT, user INT(250), comment LONGTEXT, status VARCHAR(250))");
                    $q3 = mysqli_query($c, "SELECT * FROM $t3 WHERE status = 'active'");
                    echo "<br><div style='block: inline'><form action='php/a.php?a=postcomment&id=".$u."&pid=".$pid."&redirect=profile.php' method='POST'><textarea placeholder='write a comment...' style='font-family: sans-serif; font-size: 12px; width: 70%;border:none;border-bottom: solid 1px #E2E2E2;' rows=2 name='comment'></textarea>"
                            . '<button id="comment" style="float: right" name="comment_submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                    Comment
                               </button></form></div><br>';
                    echo "<table id='comments'".$pid."' style='font-size: 15px'>";
                    while($f3 = mysqli_fetch_array($q3)) {
                        $cid = $f3['id'];
                        $cu = $f3['user'];
                        $cq = mysqli_query($c, "SELECT * FROM members_list WHERE id = ".$cu."");
                        while ($cf = mysqli_fetch_array($cq))
                            $cfn = $cf['fullname'];
                        $comment = nl2br($f3['comment']);
                        echo "<tr id='c".$pid.$cid."'><td valign='top'><div style=\"width: 15px; height: 15px; border-radius: 15px; background-repeat: no-repeat; background-image: url('profiles/".$cu."/profile.png'); background-size: cover; background-position: top;\"></div></td><td valign='top'><a style='text-decoration: none; margin: 5px;' href='profile.php?id=".$cu."'><b>$cfn</b></a></td><td>$comment</td><td valign='top' style='width:100%; text-align: right' valign='top'>";
                        if($id == $cu || $id == $u) { 
                            echo "<a style='cursor: pointer; text-decoration: none' onclick='deletecomment(".$u.",".$pid.",".$cid.")'>X</a>";
                        }
                        else {
                            echo "";
                        }
                        echo "</td></tr>";
                    }
                    echo "</table><hr>";
                    echo "<span style='font-size: 70%;'>
                            <span style='float: left'>
                                <span style='padding:4px; background-color: #F5F5F5; border-radius: 1px;' id='nvote".$pid."'>1 vote</span> | 
                                $myvote
                            </span>
                            <span style='padding:4px; background-color: #F5F5F5; border-radius: 2px; position: absolute; right: 10px; bottom: 10px;'>
                                $details
                            </span>
                       </span></div>";
                }
                echo "<script>setInterval(function(){"
                        
                        . "$.get('php/a.php?a=getvotes&id=".$u."&pid=".$pid."', function(data, status){"
                            . "if(data == 1)
                                    $('#nvote".$pid."').html(data + ' vote');
                                else
                                    $('#nvote".$pid."').html(data + ' votes');"
                        . "});"
                        . "}, 1000);</script>";
      }
      ?>
      </div>
        
        <dialog style="width: 60%; padding: 10px; max-height: 600px; border-radius: 2px; overflow-y: auto; background-color:rgba(255, 255, 255, 0.98)" id='noticeboard' class="mdl-dialog">
            <div id='notice' class="mdl-dialog__content"></div>
            <div class="mdl-dialog__actions">
                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent close">Close</button>
            </div>
        </dialog>
        
     <div id="right_tabs">
            <div class="block mdl-card mdl-shadow--4dp" id="notification">
                <span style="font-size: 25px">Notifications</span>
                <div style='position : absolute; top:20px; right:10px;'>
                    <a onclick="readall()" style='text-decoration:none' class='mdl-spacer'>
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
                    $q2 = 'SELECT '.$tfid.'_mates.user AS fid, COUNT('.$tfid.'_posts.id) AS nposts FROM '.$tfid.'_mates LEFT JOIN '.$tfid.'_posts ON '.$tfid.'_mates.user = '.$tfid.'_posts.user WHERE '.$tfid.'_mates.status LIKE "friend" AND '.$tfid.'_mates.user != "'.$id.'" AND 0 = (SELECT COUNT(*) FROM '.$id.'_mates WHERE '.$id.'_mates.user = '.$tfid.'_mates.user) GROUP BY '.$tfid.'_mates.user ORDER BY nposts DESC;';
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
        function LoadOnce() {
            window.location.reload(true);
        }
        function vote(i, pi){
            $.get("php/a.php?a=vote&id=" + i +"&pid=" + pi, function(data, status){
                
                
               $("#img" + pi).attr("src","img/downvote.png");
               $("#tooltip" + pi).html("Remove Vote");
               $("#vote" + pi).attr("onclick","removevote("+ i + "," + pi + ")");
               
               if(data == 1)
                   $("#nvote" + pi).html(data + " vote");
               else
                   $("#nvote" + pi).html(data + " votes");
            });
        }
        
        function removevote(i, pi){
            $.get("php/a.php?a=removevote&id=" + i +"&pid=" + pi, function(data, status){
               
               $("#img" + pi).attr("src","img/upvote.png");
               $("#tooltip" + pi).html("Vote");
               $("#vote" + pi).attr("onclick","vote("+ i + "," + pi + ")");
               
                if(data == 1)
                   $("#nvote" + pi).html(data + " vote");
               else
                   $("#nvote" + pi).html(data + " votes");
               
               
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
        
        function deletepost(id, pid){
            $.get("php/a.php?a=deletepost&id=" + id + "&pid=" + pid, function(){
                $("#post" + pid).animate({height: "0px",opacity: "0", padding: "0px"}, 500).fadeOut(1);
            });
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
        var mates = document.querySelector('#mates');
        var open = document.querySelector('#show-dialog');
        if (! notice.showModal) {
          dialogPolyfill.registerDialog(notice);
        }
        
        if (! mates.showModal) {
          dialogPolyfill.registerDialog(mates);
        }
        open.addEventListener('click', function() {
          mates.showModal();
        });
        mates.querySelector('.close').addEventListener('click', function() {
          mates.close();
        });
        
        notice.querySelector('.close').addEventListener('click', function() {
          notice.close();
        });
    </script>
  </body>
</html>