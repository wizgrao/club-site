<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 7/17/2015
 * Time: 9:40 PM
 */

require "utils.php";
$connection = loginDB();
$error = false;
$usrerror = $passerror = $passConfirmError = $nameError = $typeError = $classError = $divisionError =$emailError= "";
session_start();
if($_SESSION['type'] == "sponsor"|| $_SESSION['type'] == "president" || $_SESSION['type'] == "admin") {
if(isset($_POST['usr']) && $_POST['usr']!=""){
    if(!$stmt = $connection->prepare("SELECT userid, passhash, type, class, name, division FROM users WHERE userid = ?")){
        echo "wtf";
    }
    $stmt->bind_param("s",$_POST['usr']);
    $stmt->execute();
    $stmt->bind_result($userid, $passhash, $type, $class, $name, $division);
    if($stmt->fetch()){
        $error = true;
        $usrerror = $_POST['usr']." is already taken. Please choose again.";

    }
}else{
    $error = true;
    $usrerror = "Username required";
}
if(isset($_POST['pass']) && $_POST['pass']!=""){

}else{
    $error = true;
    $passerror = "Password required";
}
    if(isset($_POST['passConfirm']) && $_POST['passConfirm']!=""){
        if(isset($_POST['pass']) && $_POST['pass']!="" && $_POST['passConfirm'] != $_POST['pass']){
            $error = true;
            $passConfirmError = "Passwords do not match";
        }
    }else{
        $error = true;
        $passConfirmError = "Password  Confirm required";
    }

    if(isset($_POST['email']) && $_POST['email']!=""){

    }else{
        $error = true;
        $emailError = "email required";
    }
    if(isset($_POST['name']) && $_POST['name']!=""){

    }else{
        $error = true;
        $nameError = "Name required";
    }


if($error){?>
    <!DOCTYPE html>
    <html>
        <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("form").submit();
                });
            </script>
        </head>
        <body>
            <form action="CreateAccount.php" method="post">
                <input type ="hidden" name = "usrError" value = "<?php echo $usrerror?>">
                <input type ="hidden" name = "passError" value = "<?php echo $passerror?>">
                <input type ="hidden" name = "passConfirmError" value = "<?php echo $passConfirmError?>">
                <input type ="hidden" name = "nameError" value = "<?php echo $nameError?>">
                <input type ="hidden" name = "emailError" value = "<?php echo $emailError?>">
            </form>
        </body>
    </html>
<?php }else{

    $stmt = $connection->prepare("INSERT INTO users(userid, passhash, type, class, name, division, email) values (?, ?,?,?,?,?,?)");
    $stmt->bind_param("sssisss",$_POST['usr'],password_hash($_POST['pass'],PASSWORD_DEFAULT),$_POST['type'],$_POST['class'],$_POST['name'],$_POST['division'],$_POST['email']);
    $stmt->execute();
    ?><!DOCTYPE html>
<html>
<head>
    <META http-equiv="refresh" content="0;URL=posts.php">

</head>
<body>

</body>
</html><?php

}
}else
    echo "You do not have permission to do this."?>