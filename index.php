<?php
include_once"php/no-cache.php";
session_start();
if(isset($_SESSION['alphago_em']))
    header("location: main.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ConnectsU</title>
        <link rel="icon" href="img/connectsu.jpg">
        <link href="mdl/material.css" rel="stylesheet">
        <link href="css/jquery-ui.css" rel="stylesheet">
        <link href="css/jquery-ui.min.css.css" rel="stylesheet">
        <link href="css/alphago.css" rel="stylesheet">
        <style type="text/css">
            
            .title{
                color: #212121;
            }
            
            .cards{
                text-align: center;
                padding: 10px;
                background-color: rgba(255 ,255 ,255 , 0.9);
                margin: 10px;
                border-radius: 5px;
            }
            
            button{
                background-color: #212121;
            }

    #signin{
        top: 100px;
        height: 330px;
        position : absolute;
        right: 15%;
        width: 34%;
    }
    #signup{
        position : absolute;
        top: 440px;
        right: 30%;
        width: 40%;
    }
    
    #console{
        text-align: center;
        position: fixed;
        top:350px;
        right: 0%;
        background-color: rgb(0,200,50);
        color: white;
        padding: 10px;
        opacity: 0;
    }

    #desc{
        top: 100px;
        height: 330px;
        position : absolute;
        left: 15%;
        width: 34%;
        background: url('img/alphago.jpg') center/cover;
        opacity: 0.9;
    }
 
    #back{
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: url('img/back.jpg') center/cover;
    }
    </style>
    <script>
        function LoadOnce(){
            window.location.reload(true);
        }
    </script>
    </head>
    <body>
        <div id="back"></div>
    <header class="header mdl-layout__header">
          <div class="mdl-layout__header-row">
              <div id="title"><h3 >ConnectsU</h3></div>
        </div>
    </header> 
    <div class="cards mdl-card mdl-shadow--4dp" id="signin">
        <h4 class="title"><b>Login</b></h4><hr>
    <div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="email" id="lemail">
            <label class="mdl-textfield__label" for="sample3">moodle_id@students.iitmandi.ac.in</label>
        </div>
        <br/>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="password" id="lpassword">
            <label class="mdl-textfield__label" for="sample3">Password</label>
        </div>
        <br/><br/>
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" onclick='login()' name="login">Enter</button>
    </div>
    </div>
    <div class="cards mdl-card mdl-shadow--4dp" id="desc">
        <h4 class="title"><b>Description</b></h4>
        <hr>
        <br><br>
        <p>
            ConnectsU is a social networking site for IIT Mandi.<br>
            Special thanks to <b>Dr. Arti Kashyap</b> and <b>Chandan Purbia</b><br>
            <b>Developed by</b> : Indresh Kumar | Swapnil Sharma | Pranav Gupta<br>
            <b>Image Credits</b> : Chandan Purbia<br>
        </p>        
    </div>
     
        <div style="width: 10%;" id='console'></div>
    
    
    <div class="cards mdl-card mdl-shadow--4dp" id="signup">
        <h4 class="title"><b>Register</b></h4><hr>
        <br/>
        <div id="content">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="fullname">
            <label class="mdl-textfield__label" for="sample3">Full Name</label>
        </div>
        <br/>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="email" id="email">
            <label class="mdl-textfield__label" for="sample3">moodle_id@students.iitmandi.ac.in</label>
        </div>
        <br/>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="password" id="password">
            <label class="mdl-textfield__label" for="sample3">Password</label>
        </div>
        <br/>
        I'm:
        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
            <input type="radio" id="option-1" class="mdl-radio__button" name="gender" value="Female" checked>
            <span class="mdl-radio__label">Female</span>
        </label>
        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
            <input type="radio" id="option-2" class="mdl-radio__button" name="gender" value="Male">
            <span class="mdl-radio__label">Male</span>
        </label>
        <br/>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="dob">
            <label class="mdl-textfield__label" for="sample3"></label>
        </div>
        <br/><br/>
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" onclick="register()">Sign Up</button>
    </div>
    </div>
    
    <footer>
            
    </footer>
    <script src="script/jquery.min.js"></script>
    
    <script src="mdl/material.min.js"></script>
    <script src="script/jquery-ui.min.js"></script>
    <script src="script/jquery-ui.js"></script>
    <script>
    
        function register(){
            
            $("#console").animate({width: "200px", height: "60px", opacity: "1"}, 500)
                    
            if($("#option-1").val())
                    gender = "Female";
            if($("#option-2").val())
                    gender = "Male";
                
            $.post("php/a.php?a=register",
            {
                fullname: $("#fullname").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                gender: gender,
                dob: $("#dob").val()
            },
            function(reply){
                if(reply == "success"){
                    $("#console").css("background-color","rgb(0,200,50)");
                    $("#console").html("you have succesfully registered");
                    $("#console").delay(1000).animate({width: "0px", height: "0px", opacity: "0"}, 500);
                }
                else{
                    $("#console").css("background-color","rgb(230,91,94)");
                    $("#console").html(reply + "<br>");
                }
                
            });
        }
        
        function login(){
            $("#console").animate({width: "200px", height: "60px", opacity: "1"}, 500)
                
            $.post("php/a.php?a=login",
            {
                email: $("#lemail").val(),
                password: $("#lpassword").val(),
            },
            function(reply){
                if(reply == "success"){
                    $("#console").css("background-color","rgb(0,200,50)");
                    $("#console").html("you have succesfully signed in.");
                    $("#console").delay(500).animate({width: "0px", height: "0px", opacity: "0"}, 200).delay(10,function(){
                        window.location.href = "main.php";
                    });
                }
                else{
                    $("#console").css("background-color","rgb(230,91,94)");
                    $("#console").html(reply + "<br>");
                }
                
            });
        }
        $('#dob').datepicker();
        
    </script>
    </body>
</html>