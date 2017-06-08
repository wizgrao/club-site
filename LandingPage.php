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
$usrerror = $passerror = "";

if(isset($_POST['pass']) && $_POST['pass']!=""){
    if(isset($_POST['usr']) && $_POST['usr']!=""){
        if(!$stmt = $connection->prepare("SELECT email, userid, passhash, type, class, name, division FROM users WHERE userid = ?")){
            echo "wtf";
        }
        $stmt->bind_param("s",$_POST['usr']);
        $stmt->execute();
        $stmt->bind_result($email, $userid, $passhash, $type, $class, $name, $division);

         if(!$stmt->fetch()){
            $error = true;
            $err = "Username and/or Password incorrect";

        }else{

            $hash =$passhash;
            $good = password_verify($_POST['pass'],$hash);
            if($good){
                session_start();
                $_SESSION['usr'] = $_POST['usr'];
                $_SESSION['name'] = $name;
                $_SESSION['division'] = $division;
                $_SESSION['class'] = $class;
                $_SESSION['type'] = $type;
                $_SESSION['email'] = $email;
            }else{
                $error = true;
                $err = "Username and/or Password incorrect";
            }

        }
    }else{
        $error = true;
        $err = "Username and/or Password incorrect";
    }
}else{
    $error = true;
    $err = "Password required";
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
    Logging in...
    <form action="Login.php" method="post">
        <input type ="hidden" name = "err" value = "<?php echo $err?>">

    </form>
    </body>
    </html>
<?php }else{?>
<!DOCTYPE html>
<html>
<head>
    <META http-equiv="refresh" content="0;URL=posts.php">

</head>
<body>
Logging in...
</body>
</html>
<?php }?>
