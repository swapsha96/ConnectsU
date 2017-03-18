<?php
session_start();
if(isset($_SESSION['alphago_em'])) {
    include_once 'php/c.php';
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
        
    <?php echo "body {background-color: #E0E0E0}" ?>
    
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
            <div class="block mdl-card mdl-shadow--4dp" id="search">
                <span style="font-size: 35px">Search</span><hr/>
                <div>
                <?php
                if(isset($_POST['search'])) {
                    include_once 'php/c.php';
                    $s = mysqli_real_escape_string($c, trim($_POST['search']));
                    if($s != "") {
                        $q = mysqli_query($c, "SELECT * FROM members_list WHERE NOT fullname = '".$_SESSION['alphago_fn']."' AND fullname LIKE '%".$s."%'");
                        if(mysqli_num_rows($q) > 0) {
                            while ($f = mysqli_fetch_array($q)) {
                                $user = $f['id'];
                                $fn = $f['fullname'];
                                if(file_exists("profiles/" . $user . "/profile.png"))
                                    echo "<img class=\"profile_pic\" src=\"profiles/" . $user . "/profile.png\" style=\"height: 100px\">";
                                else
                                    echo "<img class=\"profile_pic\" src=\"img/person.jpg\" style=\"height: 100px\">";
                                echo "<div style='float: right; text-align: right'>
                                    <span style='font-size: 20px'>$fn</span><br/>(<a href='profile.php?id=".$user."' style='font-size: 15px'>View profile</a>)<br/><br/>
                                </div><hr/>";
                            }
                        }
                        else {
                            echo "No users found.";
                        }
                    }
                    else {
                        $q = mysqli_query($c, "SELECT * FROM members_list");
                        if(mysqli_num_rows($q) > 0) {
                            while ($f = mysqli_fetch_array($q)) {
                                $user = $f['id'];
                                $fn = $f['fullname'];
                                if(file_exists("profiles/" . $user . "/profile.png"))
                                    echo "<img class=\"profile_pic\" src=\"profiles/" . $user . "/profile.png\" style=\"height: 150px\">";
                                else
                                    echo "<img class=\"profile_pic\" src=\"img/person.jpg\" style=\"height: 150px\">";
                                echo "<div style='float: right; text-align: right'>
                                    <span style='font-size: 20px'>$fn</span><br/>(<a href='profile.php?id=".$user."' style='font-size: 15px'>View profile</a>)<br/><br/>
                                </div><hr/>";
                            }
                        }
                        else {
                            echo "No users found.";
                        }
                    }
                }
                else {
                        $q = mysqli_query($c, "SELECT * FROM members_list");
                        if(mysqli_num_rows($q) > 0) {
                            while ($f = mysqli_fetch_array($q)) {
                                $user = $f['id'];
                                $fn = $f['fullname'];
                                if(file_exists("profiles/" . $user . "/profile.png"))
                                    echo "<img class=\"profile_pic\" src=\"profiles/" . $user . "/profile.png\" style=\"height: 150px\">";
                                else
                                    echo "<img class=\"profile_pic\" src=\"img/person.jpg\" style=\"height: 150px\">";
                                echo "<div style='float: right; text-align: right'>
                                    <span style='font-size: 20px'>$fn</span><br/>(<a href='profile.php?id=".$user."' style='font-size: 15px'>View profile</a>)<br/><br/>
                                </div><hr/>";
                            }
                        }
                        else {
                            echo "No users found.";
                        }
                }
                ?>
                </div>
            </div>
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
        </div>

    </div>
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="script/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="mdl/material.min.js"></script>
    <script>
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