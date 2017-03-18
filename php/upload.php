<?php
session_start();
if(isset($_SESSION['alphago_em'])) {
    $id = $_SESSION['alphago_id'];
    $fn = $_SESSION['alphago_fn'];
   $location = "../profiles/" . $id . "/";
    if($_GET['a'] == "profilepic"){
        if (!empty($_FILES['ppic']['name'])) {
            $file = $location . "profile.png";

            if($_FILES["ppic"]["size"] < 8000000){
                $ext = pathinfo($_FILES["ppic"]["name"], PATHINFO_EXTENSION);
                if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "bmp" || $ext == "PNG" || $ext == "JPG" || $ext == "JPEG" || $ext == "BMP"){
                    if (move_uploaded_file($_FILES["ppic"]["tmp_name"], $file)){
                        header("location: ../profile.php");
                    }
                    else{
                        echo "<script>
                        window.alert('File cannot be uploaded. Please try again. Sorry for inconvenience')
                        window.location.href='../settings.php?a=ppic' </script>";
                    }
                }
                else{
                    echo "<script>
                        window.alert('".$ext." file not supported! Please select a .jpg, .jpeg, .bmp or .png file');
                        window.location.href='../settings.php?a=ppic' </script>";
                }
            }
            else{
                echo "<script>
                        window.alert('Exceed filesize limit.');
                        window.location.href='../settings.php?a=ppic' </script>";
            }
        }   
        else {
            header("location: ../");
        }
    }
    if($_GET['a'] == "backpic"){
            if(!empty($_FILES['bpic']['name']) && $_FILES['bpic']['name'] != ""){
                echo 123;
                $file = $location . "back.png";

                if($_FILES["bpic"]["size"] < 2000000){
                    $ext = pathinfo($_FILES['bpic']['name'], PATHINFO_EXTENSION);
                    if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "bmp" || $ext == "PNG" || $ext == "JPG" || $ext == "JPEG" || $ext == "BMP"){
                        if (move_uploaded_file($_FILES['bpic']['tmp_name'], $file)) {
                            
                    echo 1;
                        } 
                        else {
                            echo "<script>
                            window.alert('File cannot be uploaded. Please try again. Sorry for inconvenience')
                            window.location.href='../settings.php?a=bpic' </script>";
                        }
                    }
                    else{
                        echo "<script>
                            window.alert('".$ext." file not supported! Please select a .jpg, .jpeg, .bmp or .png file');
                            window.location.href='../settings.php?a=bpic' </script>";
                    }
                }
                else{
                    echo "<script>
                        window.alert('Exceed filesize limit.');
                        window.location.href='../settings.php?a=bpic' </script>";
                }
            }
            
            if(isset($_POST['opacity'])){
                $opa = fopen($location . "opa.dat", "w");
                fwrite($opa, $_POST['opacity']/100);
                fclose($opa);
            }
            header("location: ../profile.php");
               
        
    }
    
    if($_GET['a'] == "removeppic"){
        if(copy("../img/person.jpg", "../profiles/".$id."/profile.png"))
                header("location: ../profile.php");
    }
    
    if($_GET['a'] == "removebpic"){
        if(file_exists($location . "back.png")){
            unlink($location . "back.png");
        }
        if(file_exists($location . "opa.dat")){
            unlink($location . "opa.dat");
        }
        
        header("location: ../profile.php");
    }
    
}
else {
    header("location: ../");
}
?>