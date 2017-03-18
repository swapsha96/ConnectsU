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
$menu = 0;
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
        width: 20%;
        text-align: center;
        align-content: center;
    }
    
     #right_tabs{
        position : absolute;
        top : 100px;
        right : 15%;
        left: 35%;
        text-align: center;
        align-content: center;
    }
    
    #settings{
        position: absolute;
        top: 10px;
        left: 10px;
    }
    
    #changePass{
        display: block;
    }
    
    #changepPic{
        display: none;
    }
    
    #changebPic{
        display: none;
    }
    
    #editProfile{
        display: none;
    }
    
    #blockList{
        display: none;
    }
    
    .option{
        cursor: pointer;
    }
    
    #pass{
        opacity: 1;
    }
     
    #ppic{
        opacity: 0.6;
    }
    
    #bpic{
        opacity: 0.6;
    }
    
    #ep{
        opacity: 0.6;
    }
    
    #bl{
        opacity: 0.6;
    }
    
    </style>
    
    <script>
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
  <?php
    $q = mysqli_query($c, "SELECT * FROM members_details WHERE id = '".$u."'");
        while ($f = mysqli_fetch_array($q)) {
        $contact = $f['contact'];
        $about = $f['about'];
        $hobbies = $f['hobbies'];
        $clubs = $f['clubs'];
        $courses = $f['courses'];
        $projects = $f['projects'];
    }
  ?>
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
        if (file_exists("profiles/" . $u . "/opa.dat")){
            $opa = fopen("profiles/" . $id . "/opa.dat","r");
            $opacity = fread($opa, filesize("profiles/" . $id . "/opa.dat"));
            fclose($opa);
        }
        if (file_exists("profiles/" . $u . "/back.png")) {
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
            <div id = "options" class="block mdl-card mdl-shadow--4dp">
                
                <span style="font-size: 150%;"><b>Options</b></span><hr/>
                        
                <div id = "pass" class="option">Change Password<br/><br/></div>
                <div id = "ppic" class="option">Change Profile Picture<br/><br/></div>
                <div id = "bpic" class="option">Change Back Picture<br/><br/></div>
                <div id = "ep" class="option">Edit Profile<br/><br/></div>
                <!--<div id = "bl" class="option">Blocklist<br/><br/></div>-->
            </div>
        </div>
        
        <div id="right_tabs">
            <div class="settings block mdl-card mdl-shadow--4dp" id="changePass">
                
                <span style="font-size: 150%;"><b>Change Password</b></span><hr>
                
                <form action="php/a.php?a=changepass" method="POST">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" id = "old_password" name="old">
                        <label class="mdl-textfield__label">Old Password</label>
                    </div><br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" id = "new_password" name="new">
                        <label class="mdl-textfield__label">New Password</label>
                    </div><br><br>
                    
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-button--accent" id = "changepass" name="changepass">
                        Change Password
                    </button>
                </form>
                
            </div>
            
            <div class="settings block mdl-card mdl-shadow--4dp" id="changepPic" >
                
                <span style="font-size: 150%;"><b>Change Profile Picture</b></span><hr>
                <?php
                  if(file_exists("profiles/" . $u . "/profile.png"))
                      echo "<img class=\"profile_pic\" src=\"profiles/" . $u . "/profile.png\" style=\"box-shadow: 0 0 8px 2px gray; max-width : 400px\">";
                  else
                      echo "<img class=\"profile_pic\" src=\"img/person.jpg\" style=\"box-shadow: 0 0 8px 2px gray; max-width : 400px\">";
                ?>
                <br><br>
                
                <form action="php/upload.php?a=profilepic" method="POST" enctype="multipart/form-data">
                <div>
                    <div id = "pbrowse" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-button--accent">
                        Browse
                        <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="pbrowse">
                            Select file from desktop
                        </div>
                    </div><br><br>
                    <input  style="display: none" id="pexplorer" type="file" name="ppic" accept="image/*" >
                </div>
                    <button id = "pupdate" name = "pupload" disabled="true" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-button--accent">
                    Update
                    <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="pupdate">
                        Update Profile Picture
                    </div>
                </button>
                    
            </form>
                <br>
                
                <button id = "premove"  class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-button--accent">
                    Remove
                    <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="premove">
                        Remove Profile Picture
                    </div>
                </button>
            </div>
            
            <div class="settings block mdl-card mdl-shadow--4dp" id="changebPic" >
                
                <span style="font-size: 150%;"><b>Change Back Picture</b></span><hr>
                <?php
                  if(file_exists("profiles/" . $u . "/back.png"))
                      echo "<img class=\"profile_pic\" src=\"profiles/" . $u . "/back.png\" style=\"box-shadow: 0 0 8px 2px gray; max-width : 400px\">";
                  else {
                      echo "<span style='padding: 10px; box-shadow: 0 0 8px 2px gray;'>Please select a back pic.</span>";
                  }
                  
                ?>
                <br><br>
                
                <form action="php/upload.php?a=backpic" method="POST" enctype="multipart/form-data">
                    <div>
                        <div id = "bbrowse" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-button--accent">
                            Browse
                            <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="bbrowse">
                                Select file from desktop
                            </div>
                        </div><br><br>
                        <input  style="display: none" id="bexplorer" type="file" name="bpic" accept="image/*" >
                        <!-- Slider with Starting Value -->
                        <br>
                        <input class="mdl-slider mdl-js-slider" id = 'opacity' name='opacity' type="range"
                               min="0" max="100" <?php 
                               echo file_exists("profiles/" . $u . "/opa.dat")? "value=".($opacity * 100) : "value=70";?> tabindex="0">
                        <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="opacity">
                            Set Opacity
                        </div><br>
                    </div>
                    <button id = "bupdate" name = "bupload" disabled="true" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-button--accent">
                        Update
                        <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="bupdate">
                            Update Back Picture
                        </div>
                    </button>

                </form>
                <br>
                
                <button id = "bremove"  class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-button--accent">
                    Remove
                    <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="bremove">
                        Remove Back Picture
                    </div>
                </button>
                
            </div>
            
            <div class="settings block mdl-card mdl-shadow--4dp" id="editProfile" >
                
                <span style="font-size: 150%;"><b>Edit Profile</b></span><hr>
                        
                <form action="php/a.php?a=editprofile" method="POST">
                <?php
                echo '
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style=" width: 80%" >
                    <input class="mdl-textfield__input" type="text" id = "mobile" name="contact" value="'.$contact.'">
                    <label class="mdl-textfield__label">Contact</label>
                </div>
                <br/> 
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style=" width: 80%">
                    <textarea class="mdl-textfield__input" maxlength="1000" name="about" rows="5" id="abt_me">'.$about.'</textarea>
                    <label class="mdl-textfield__label" for="abt_me">About Me</label>
                </div>
                <br/>
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style=" width: 80%">
                    <textarea class="mdl-textfield__input" maxlength="1000" name="hobbies" rows="5" id="hobbies">'.$hobbies.'</textarea>
                    <label class="mdl-textfield__label" for="hobbies">Hobbies</label>
                </div>
                <br/>
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style=" width: 80%">
                    <textarea class="mdl-textfield__input" maxlength="1000" name="clubs" rows="5" id="clubs">'.$clubs.'</textarea>
                    <label class="mdl-textfield__label" for="clubs">Clubs</label>
                </div>
                <br/>
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style=" width: 80%">
                    <textarea class="mdl-textfield__input" maxlength="1000" name="courses" rows="5" id="courses">'.$courses.'</textarea>
                    <label class="mdl-textfield__label" for="courses">Courses</label>
                </div>
                <br/>
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style=" width: 80%">
                    <textarea class="mdl-textfield__input" maxlength="1000" name="projects" rows="5" id="projects">'.$projects.'</textarea>
                    <label class="mdl-textfield__label" for="projects">Projects</label>
                </div>
                <br/>
                ';
                ?>
                <button id="save" name="save" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                    Save
                    <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="save">
                        Save Changes
                    </div>
                </button>
                </form>
            </div>
            
            <div class="settings block mdl-card mdl-shadow--4dp" id="blockList" >
                <span style="font-size: 150%;"><b>Block List</b></span><hr>
            </div>
        </div>
    </div>
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="script/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="mdl/material.min.js"></script>
    <script src="script/jquery.min.js"></script>
    <script type="text/javascript">
               
        $prev = "#changePass";
        $prevo = "#pass";
        
            $("#pass").click(function(){
               
               $($prevo).fadeTo(10, 0.6);
               $("#pass").fadeTo(10, 1);
               $($prev).fadeOut(100);
               $("#changePass").delay(100).fadeIn(100);
               $prev = "#changePass";
               $prevo = "#pass";
            });
            
            $("#ppic").click(function(){
                      
               $($prevo).fadeTo(10, 0.6);
               $("#ppic").fadeTo(10, 1);
               $($prev).fadeOut(100);
               $("#changepPic").delay(100).fadeIn(100);
               $prev = "#changepPic";
               $prevo = "#ppic";
            });
            
            $("#ep").click(function(){
               
               $($prevo).fadeTo(10, 0.6);
               $("#ep").fadeTo(10, 1);
               $($prev).fadeOut(100);
               $("#editProfile").delay(100).fadeIn(100);
               $prev = "#editProfile";
               $prevo = "#ep";
            });
            
            $("#bl").click(function(){
                
               $($prevo).fadeTo(10, 0.6);
               $("#bl").fadeTo(10, 1);
               $($prev).fadeOut(100);
               $("#blockList").delay(100).fadeIn(100);
               $prev = "#blockList";
               $prevo = "#bl";
            });
            
            $("#bpic").click(function(){
                
               $($prevo).fadeTo(10, 0.6);
               $("#bpic").fadeTo(10, 1);
               $($prev).fadeOut(100);
               $("#changebPic").delay(100).fadeIn(100);
               $prev = "#changebPic";
               $prevo = "#bpic";
            });
            
            <?php
            if(isset($_GET['a'])){
                if($_GET['a'] == "ppic"){
                    echo '$("#ppic").click();';
                }
                
                if($_GET['a'] == "bpic"){
                    echo '$("#bpic").click();';
                }
            }
 
            ?>
                
            $(document).ready(function(){
                
                $("#pbrowse").click(function(){
                    $("#pexplorer").click();
                });
                
                $("#bbrowse").click(function(){
                    $("#bexplorer").click();
                });
                
                $('input:file').change(function(){
                    if ($("#pexplorer").val()) {
                        $('#pupdate').attr('disabled',false);
                        $('#premove').attr('disabled',true);
                    }   
                    else{
                        $('#pupdate').attr('disabled',true);
                        $('#premove').attr('disabled',false);
                    }
                    
                    if ($("#bexplorer").val()) {
                        $('#bupdate').attr('disabled',false); 
                        $('#bremove').attr('disabled',true); 
                    }   
                    else{
                        $('#bupdate').attr('disabled',true);
                        $('#bremove').attr('disabled',false);
                    }
                   
                });
                
                $("#opacity").change(function(){
                    $('#bupdate').attr('disabled',false);
                    $("#back").fadeTo(10, $("#opacity"). val()/100);
                    
                });
                
                $('#bremove').click(function(){
                   window.location.replace('php/upload.php?a=removebpic'); 
                });
                
                $('#premove').click(function(){
                   window.location.replace('php/upload.php?a=removeppic'); 
                });
                
                
              
            });
        
    </script>
    </div>
  </body>
</html>