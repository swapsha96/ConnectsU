<?php

    $error = "none";
    if($_GET['a'] == "register") {
        if(isset($_POST['fullname'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['gender'])&&isset($_POST['dob'])) {
            include_once 'c.php';
            $fn = mysqli_real_escape_string($c, trim($_POST['fullname']));
            $em = mysqli_real_escape_string($c, trim($_POST['email']));
            $pw = mysqli_real_escape_string($c, trim($_POST['password']));
            $gd = mysqli_real_escape_string($c, trim($_POST['gender']));
            $dob = mysqli_real_escape_string($c, trim($_POST['dob']));
            if($fn != "" && $em != "" && $pw != "" && $gd != "" && $dob != "") {
                $re1='((?:[a-z][a-z0-9_]*))';	# Variable Name 1
                $re2='(@)';	# Any Single Character 1
                $re3='(students\\.iitmandi\\.ac\\.in)';	# Fully Qualified Domain Name 1
                if(preg_match_all ("/".$re1.$re2.$re3."/is", $em, $matches)) {
                    if(preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{6,25}$/', $pw)) {
                        $pw = md5($pw);
                        
                        $q = mysqli_query($c, "SELECT * FROM members_list WHERE email = '".$em."'");
                        if(mysqli_num_rows($q) == 0) {
                        mysqli_query($c, "INSERT INTO members_list VALUES ('','".$fn."','".$em."','".$pw."','active')") or die(mysqli_error($c));
                        $q = mysqli_query($c, "SELECT * FROM members_list WHERE email = '".$em."'");
                        $f = mysqli_fetch_array($q);
                        $id = $f['id'];
                        mysqli_query($c, "INSERT INTO members_details VALUES ('".$id."','".$gd."','".$dob."','','','','','','')");
                        $t = $id."_posts";
                        mysqli_query($c, "CREATE TABLE $t (id INT PRIMARY KEY AUTO_INCREMENT,user VARCHAR(250), post TEXT(10000), time INT, details VARCHAR(250), privacy VARCHAR(250), status VARCHAR(250))");
                        $t = $id."_main";
                        mysqli_query($c, "CREATE TABLE $t (id INT,user VARCHAR(250), post TEXT(10000), time INT PRIMARY KEY, details VARCHAR(250), privacy VARCHAR(250), status VARCHAR(250))");
                        $t = $id."_mates";
                        mysqli_query($c, "CREATE TABLE $t (user INT PRIMARY KEY, relation VARCHAR(250), status VARCHAR(250))");
                        $t = $id."_notify";
                        mysqli_query($c, "CREATE TABLE $t (id INT PRIMARY KEY AUTO_INCREMENT, notify VARCHAR(250), time INT, details VARCHAR(250), status VARCHAR(250))");
                        mkdir("../profiles/" . $id);
                        copy("../img/person.jpg", "../profiles/".$id."/profile.png");
                        $error = "success";
                        }
                        else {
                            $error = "User already exists.";
                        }
                    }
                    else {
                        $error =  "Your password must be alphanumeric between 6 and 25 characters." ;
                    }
                }
                else {
                    $error = "Invalid student email ID.";
                }
            }
            else {
                $error = "Form incomplete.";
            }
        }
        else {
            $error = "Form incomplete.";
        }
        echo $error;
    }
    elseif($_GET['a'] == "login") {
        if(isset($_POST['email'])&&isset($_POST['password'])) {
            include_once 'c.php';
            $em = mysqli_real_escape_string($c, trim($_POST['email']));
            $pw = mysqli_real_escape_string($c, trim($_POST['password']));
            if($em != "" && $pw != "") {
                if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
                    if(preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{6,25}$/', $pw)) {
                        $pw = md5($pw);
                        $q = mysqli_query($c, "SELECT * FROM members_list WHERE email = '".$em."' AND password = '".$pw."'");
                        if(mysqli_num_rows($q) == 1) {
                            while ($f = mysqli_fetch_array($q)) {
                                 $status = $f['status'];
                                 $pid = $f['id'];
                                 $pfn = $f['fullname'];
                            }
                            if($status == "active") {
                                session_start();
                                $_SESSION['alphago_em'] = $em;
                                $_SESSION['alphago_id'] = $pid;
                                $_SESSION['alphago_fn'] = $pfn;
                                $error = "success";
                            }
                            else {
                                $error = "This account is not active due to some reason. Contact administrator.";
                            }
                        }
                        else {
                            $error = "Incorrect username/password.";
                        }
                    }
                    else {
                        $error =  "Your password must be alphanumeric between 6 and 25 characters." ;
                    }
                }
                else {
                    $error = "Invalid student email ID.";
                }
            }
            else {
                $error = "Enter both username/password.";
            }
        }
        else {
            $error = "Enter both username/password.";
        }
        echo $error;
    }
    elseif($_GET['a'] == "logout") {
        session_start();
        session_destroy();
        header("location: ../");
    }
    elseif($_GET['a'] == "submitpost") {
        if(isset($_POST['post_input'])&&isset($_POST['post_submit'])&&isset($_GET['target'])) {
            $target = $_GET['target'];
            if(isset($_GET['id'])){
                include_once 'c.php';
                $u = mysqli_real_escape_string($c, trim($_GET['id']));
                $post = mysqli_real_escape_string($c, trim($_POST['post_input']));
                if($post != "") {
                    session_start();
                    $id = $_SESSION['alphago_id'];
                    include_once 'c.php';
                    $q = mysqli_query($c, "SELECT * FROM members_list WHERE id = ".$u."");
                    if(mysqli_num_rows($q) == 1) {
                        date_default_timezone_set("Asia/Dhaka");
                        $details = date('d/m/y H:i');
                        $time = time();
                        $t = $u."_posts";
                        mysqli_query($c, "INSERT INTO $t VALUES('','".$id."','".$post."','".$time."','".$details."','public','active')");
                        $q1 = $q = mysqli_query($c, "SELECT * FROM $t WHERE time = ".$time."");
                        while ($f1 = mysqli_fetch_array($q1))
                                $pid = $f1['id'];
                        $t = $u."_".$pid."_votes";
                        mysqli_query($c, "CREATE TABLE $t (user INT PRIMARY KEY)");
                        $t = $u."_".$pid."_comments";
                        mysqli_query($c, "CREATE TABLE $t (id INT(250) PRIMARY KEY AUTO_INCREMENT, user INT(250), comment LONGTEXT, status VARCHAR(250))");
                        $t = $u."_mates";
                        if($u == $id) {
                            
                        }
                        else {
                            $t = $u."_notify";
                            $fn = $_SESSION['alphago_fn'];
                            mysqli_query($c, "INSERT INTO $t VALUES ('','<a href=\"profile.php?id=".$id."\">".$fn."</a> posted on your profile. <a href=\"profile.php?id=".$u."\">View post</a>.','".$time."','".$details."','unread')");
                        }
                        header("location: ../".$target.".php?id=".$u);
                    }
                    else {
                        header("location: ../");
                    }
                }
                else {
                    header("location: ../".$target.".php?id=".$u);
                }
            }
            else {
                header("location: ../");
            }
        }
        else
            header("location: ../");
    }
    elseif($_GET['a'] == "postcomment") {
        if(isset($_GET['id'])&&isset($_GET['pid'])) {
            $u = $_GET['id'];
            $pid = $_GET['pid'];
            $comment = $_POST['comment'];
            session_start();
            $id = $_SESSION['alphago_id'];
            include_once 'c.php';
            $t = $u."_".$pid."_comments";
            mysqli_query($c, "INSERT INTO $t VALUES('',".$id.",'".$comment."','active')");
            if($_GET['redirect'] == "profile.php")
                header("location: ../profile.php?id=".$u."");
            
            if($_GET['redirect'] == "main.php")
                header("location: ../main.php");
        }
        else {
            header("location: ../");
        }
    }
    elseif($_GET['a'] == "postnotice") {
        if(isset($_POST['submit'])&&isset($_POST['notice'])) {
            include_once 'c.php';
            $notice = mysqli_real_escape_string($c, trim($_POST['notice']));
            $time = time();
            $details = date('d/m/y H:i');
            mysqli_query($c, "INSERT INTO noticeboard VALUES('','".$notice."',".$time.",'active')");
            $q = mysqli_query($c, "SELECT * FROM noticeboard WHERE time = ".$time."");
            while($f = mysqli_fetch_array($q))
                $nid = $f['id'];
            $q = mysqli_query($c, "SELECT * FROM members_list WHERE status = 'active'");
            while ($f = mysqli_fetch_array($q)) {
                $n = $f['id'];
                $t = $n."_notify";
                mysqli_query($c, "INSERT INTO $t VALUES ('','You have a new notice to view. <a href=\"#\" onclick=\"viewnotice(\'".$nid."\')\">Click here</a>','".$time."','".$details."','unread')");
            }
            header("location: ../admin.php?msg=success");
        }
        else {
            header("location: ../");
        }
    }
    elseif($_GET['a'] == "viewnotice") {
        if(isset($_GET['nid'])) {
            include_once 'c.php';
            $nid = mysqli_real_escape_string($c, trim($_GET['nid']));
            $q = mysqli_query($c, "SELECT * FROM noticeboard WHERE id = ".$nid." AND status = 'active'");
            if(mysqli_num_rows($q) != 0)
            while($f = mysqli_fetch_array($q)) {
                $notice = $f['notice'];
                echo nl2br($notice);
            }
            else {
                echo "No notice.";
            }
        }
        else {
            header("location: ../");
        }
    }
    elseif($_GET['a'] == "deletecomment") {
        if(isset($_GET['id'])&&isset($_GET['pid'])) {
            $u = $_GET['id'];
            $pid = $_GET['pid'];
            $cid = $_GET['cid'];
            session_start();
            $id = $_SESSION['alphago_id'];
            include_once 'c.php';
            $t = $u."_".$pid."_comments";
            mysqli_query($c, "DELETE FROM $t WHERE id = ".$cid."");
        }
        else {
            header("location: ../");
        }
    }
    elseif ($_GET['a'] == "deletepost") {
        if(isset($_GET['id'])&&isset($_GET['pid'])) {
            $u = $_GET['id'];
            $pid = $_GET['pid'];
            session_start();
            $id = $_SESSION['alphago_id'];
            include_once 'c.php';
            
            $q = mysqli_query($c, "DROP TABLE ".$u."_".$pid."_votes");
            $q = mysqli_query($c, "DROP TABLE ".$u."_".$pid."_comments");
            $t = $u."_posts";
            $q = mysqli_query($c, "SELECT * FROM $t WHERE id = ".$pid);
            if(mysqli_num_rows($q) == 1) {
                while ($f = mysqli_fetch_array($q))
                    $user = $f['user'];
                if($u == $id || $user == $id) {
                    mysqli_query($c, "DELETE FROM $t WHERE id = ".$pid."");
                    echo mysqli_error($c);
                }
                else {
                    echo "You cannot delete this post.";
                }
            }
            else {
                echo "Post doesn't exist.";
            }
        }
        else {
            header("location: ../");
        }
    }
    elseif ($_GET['a'] == "vote") {
        if(isset($_GET['id'])&&isset($_GET['pid'])) {
            $u = $_GET['id'];
            $pid = $_GET['pid'];
            session_start();
            $id = $_SESSION['alphago_id'];
            include_once 'c.php';
            $t = $u."_".$pid."_votes";
            mysqli_query($c, "INSERT INTO $t VALUES (".$id.")");
            
            header("location: a.php?a=getvotes&id=".$u."&pid=".$pid);
        }
        else {
            header("location: ../");
        }
    }
    elseif($_GET['a'] == "getvotes"){
        if(isset($_GET['id'])&&isset($_GET['pid'])) {
            $u = $_GET['id'];
            $pid = $_GET['pid'];
            session_start();
            $id = $_SESSION['alphago_id'];
            include_once 'c.php';
            $t = $u."_".$pid."_votes";
            $r = mysqli_query($c, "SELECT * FROM $t");
            echo mysqli_num_rows($r);
        }
    }
    elseif ($_GET['a'] == "removevote") {
        if(isset($_GET['id'])&&isset($_GET['pid'])) {
            $u = $_GET['id'];
            $pid = $_GET['pid'];
            session_start();
            $id = $_SESSION['alphago_id'];
            include_once 'c.php';
            $t = $u."_".$pid."_votes";
            mysqli_query($c, "DELETE FROM $t WHERE user = ".$id);
            
            header("location: a.php?a=getvotes&id=".$u."&pid=".$pid);
        }
        else {
            header("location: ../");
        }
    }
    elseif ($_GET['a'] == "addmate") {
        if(isset($_GET['id'])) {
            $u = $_GET['id'];
            session_start();
            $id = $_SESSION['alphago_id'];
            include_once 'c.php';
            $t1 = $id."_mates";
            $t2 = $u."_mates";
            mysqli_query($c, "INSERT INTO $t1 VALUES ('".$u."','friend','sent')");
            mysqli_query($c, "INSERT INTO $t2 VALUES ('".$id."','friend','request')");
            $details = date('d/m/y H:i');
            $time = time();
            $t = $u."_notify";
            $fn = $_SESSION['alphago_fn'];
            mysqli_query($c, "INSERT INTO $t VALUES ('','<a href=\"profile.php?id=".$id."\">".$fn."</a> wants to be your mate.','".$time."','".$details."','unread')");
            
            header("location: ../profile.php?id=".$u."");
        }
        else {
            header("location: ../");
        }
    }
    elseif ($_GET['a'] == "removemate") {
        if(isset($_GET['id'])) {
            $u = $_GET['id'];
            session_start();
            $id = $_SESSION['alphago_id'];
            include_once 'c.php';
            $t1 = $id."_mates";
            $t2 = $u."_mates";
            mysqli_query($c, "DELETE FROM $t1 WHERE user = ".$u."");
            mysqli_query($c, "DELETE FROM $t2 WHERE user = ".$id."");
            
            mysqli_query($c, 'DROP TRIGGER '.$id.'ins');
            mysqli_query($c, 'DROP TRIGGER '.$u.'ins');
            mysqli_query($c, 'DROP TRIGGER '.$id.'del');
            mysqli_query($c, 'DROP TRIGGER '.$u.'del');
            
            
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
                    $uL = $r3['user'];
                    $triggerdel .= " DELETE FROM ".$uL."_main WHERE ".$uL."_main.id = old.id;";
                    $triggerins .= ' INSERT INTO '.$uL.'_main VALUES(new.id, new.user, new.post, new.time, new.details,"public", "active" );';

                }

                $triggerdel .= " END";
                $triggerins .= " END";
                mysqli_multi_query($c, $triggerdel);
                mysqli_multi_query($c, $triggerins);
                
                
               $r2 = mysqli_query($c, 'SELECT * FROM '.$u.'_mates');
    
                $triggerdel = "CREATE TRIGGER ".$u."del
                                                    BEFORE DELETE ON ".$u."_posts
                                                    FOR EACH ROW
                                                    BEGIN";
    
                $triggerins = "CREATE TRIGGER ".$u."ins
                                                    AFTER INSERT ON ".$u."_posts
                                                    FOR EACH ROW
                                                    BEGIN";
                while($r3 = mysqli_fetch_array($r2)){
                    $uL = $r3['user'];
                    $triggerdel .= " DELETE FROM ".$uL."_main WHERE ".$uL."_main.id = old.id;";
                    $triggerins .= ' INSERT INTO '.$uL.'_main VALUES(new.id, new.user, new.post, new.time, new.details,"public", "active" );';

                }

                $triggerdel .= " END";
                $triggerins .= " END";
                mysqli_multi_query($c, $triggerdel);
                mysqli_multi_query($c, $triggerins);
            header("location: ../profile.php?id=".$u."");
        }
        else {
            header("location: ../");
        }
    }
    elseif ($_GET['a'] == "acceptmate") {
        if(isset($_GET['id'])) {
            $u = $_GET['id'];
            session_start();
            $id = $_SESSION['alphago_id'];
            include_once 'c.php';
            $t1 = $id."_mates";
            $t2 = $u."_mates";
            mysqli_query($c, "UPDATE $t1 SET status = 'friend' WHERE user = '$u'");
            mysqli_query($c, "UPDATE $t2 SET status = 'friend' WHERE user = '$id'");
            $details = date('d/m/y H:i');
            $time = time();
            $t = $u."_notify";
            $fn = $_SESSION['alphago_fn'];
            mysqli_query($c, "INSERT INTO $t VALUES ('','<a href=\"profile.php?id=".$id."\">".$fn."</a> is now your mate.','".$time."','".$details."','unread')");
            
            
            mysqli_query($c, 'DROP TRIGGER '.$id.'ins');
            mysqli_query($c, 'DROP TRIGGER '.$u.'ins');
            mysqli_query($c, 'DROP TRIGGER '.$id.'del');
            mysqli_query($c, 'DROP TRIGGER '.$u.'del');
            
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
                    $uL = $r3['user'];
                    $triggerdel .= " DELETE FROM ".$uL."_main WHERE ".$uL."_main.id = old.id;";
                    $triggerins .= ' INSERT INTO '.$uL.'_main VALUES(new.id, new.user, new.post, new.time, new.details,"public", "active" );';

                }

                $triggerdel .= " END";
                $triggerins .= " END";
                mysqli_multi_query($c, $triggerdel);
                mysqli_multi_query($c, $triggerins);
                
                
               $r2 = mysqli_query($c, 'SELECT * FROM '.$u.'_mates');
    
                $triggerdel = "CREATE TRIGGER ".$u."del
                                                    BEFORE DELETE ON ".$u."_posts
                                                    FOR EACH ROW
                                                    BEGIN";
    
                $triggerins = "CREATE TRIGGER ".$u."ins
                                                    AFTER INSERT ON ".$u."_posts
                                                    FOR EACH ROW
                                                    BEGIN";
                while($r3 = mysqli_fetch_array($r2)){
                    $uL = $r3['user'];
                    $triggerdel .= " DELETE FROM ".$uL."_main WHERE ".$uL."_main.id = old.id;";
                    $triggerins .= ' INSERT INTO '.$uL.'_main VALUES(new.id, new.user, new.post, new.time, new.details,"public", "active" );';

                }

                $triggerdel .= " END";
                $triggerins .= " END";
                mysqli_multi_query($c, $triggerdel);
                mysqli_multi_query($c, $triggerins);
            header("location: ../profile.php?id=".$u."");
        }
        else {
            header("location: ../");
        }
    }
    elseif ($_GET['a'] == "readall") {
       
        session_start();
        $id = $_SESSION['alphago_id'];
        include_once 'c.php';
        $t = $id."_notify";
        mysqli_query($c, "UPDATE $t SET status = 'read'");
        
    }
    elseif ($_GET['a'] == "readnotify") {
        
        session_start();
        $id = $_SESSION['alphago_id'];
        $nid = $_GET['nid'];
        include_once 'c.php';
        $t = $id."_notify";
        mysqli_query($c, "UPDATE $t SET status = 'read' WHERE id = ".$nid);
        
    }
    elseif ($_GET['a'] == "changepass") {
        if(isset($_POST['old']) && isset($_POST['new'])) {
            if(trim($_POST['old']) != "" && trim($_POST['new']) != "") {
                include_once 'c.php';
                $old = md5(trim(mysqli_real_escape_string($c, $_POST['old'])));
                $new = trim(mysqli_real_escape_string($c, $_POST['new']));
                session_start();
                $id = $_SESSION['alphago_id'];
                $q = mysqli_query($c, "SELECT * FROM members_list WHERE id = ".$id." AND password = '".$old."'");
                if(mysqli_num_rows($q) == 1) {
                    if(preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{6,25}$/', $new)) {
                        $new = md5($new);
                        mysqli_query($c, "UPDATE members_list SET password = '".$new."' WHERE id = ".$id);
                        header("location: ../settings.php");
                    }
                    else
                        echo "Your new password must be alpha-numeric in between 6 and 25 characters.";
                }
                else
                    echo "Incorrect old password.";
            }
            else {
                echo "Enter both old and new passwords.";
            }
            
        }
        else {
            echo "Enter both old and new passwords.";
        }
    }
    elseif ($_GET['a'] == "editprofile") {
        include_once 'c.php';
        $contact = mysqli_real_escape_string($c, trim($_POST['contact']));
        $about = mysqli_real_escape_string($c, trim($_POST['about']));
        $hobbies = mysqli_real_escape_string($c, trim($_POST['hobbies']));
        $clubs = mysqli_real_escape_string($c, trim($_POST['clubs']));
        $courses = mysqli_real_escape_string($c, trim($_POST['courses']));
        $projects = mysqli_real_escape_string($c, trim($_POST['projects']));
        session_start();
        $id = $_SESSION['alphago_id'];
        //echo "$contact $about $hobbies $clubs $courses $projects";
        mysqli_query($c, "UPDATE members_details SET contact = '".$contact."' , about = '".$about."' , hobbies = '".$hobbies."' , clubs = '".$clubs."' , courses = '".$courses."' , projects = '".$projects."' WHERE id = ".$id);
        header("location: ../settings.php");
    }
    else {
       header("location: ../");
    }
    
?>