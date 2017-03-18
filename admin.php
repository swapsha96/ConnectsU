<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ConnectsU</title>
        <link rel="icon" href="img/connectsu.jpg">
        <link href="mdl/material.css" rel="stylesheet">
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

            #noticeboard{
                position : absolute;
                top: 100px;
                right: 30%;
                width: 40%;
                padding: 10px;
            }

 
    </style>
    </head>
    <body>
        
    <header class="header mdl-layout__header">
          <div class="mdl-layout__header-row">
              <div id="title"><h3 >ConnectsU</h3></div>
        </div>
    </header> 
    
    <div class="cards mdl-card mdl-shadow--4dp" id="noticeboard">
        <h4 class="title"><b>Noticeboard</b></h4><hr>
    <form action="php/a.php?a=postnotice" method="POST">
        <br/>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style=" width: 90%">
                    <textarea class="mdl-textfield__input" maxlength="1000" name="notice" rows="10" id="notice"></textarea>
                    <label class="mdl-textfield__label" for="abt_me">Notice</label>
            </div>
            <br/>
            <br/>
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" name="submit">Submit</button>
        <?php
        if(isset($_GET['msg'])) {
            echo "<hr/><b>Notice has been posted successfully.</b>";
        }
        ?>
    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        
    </script>
    <script src="mdl/material.min.js"></script>
    </body>
</html>