<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 7/18/2015
 * Time: 10:59 AM
 */
session_start();
session_unset();
session_destroy();
require "utils.php";
$err = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['err'])) {
        $err = $_POST['err'];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log in</title>
    </head>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" type="text/css" href="theme.css">
    <body>
    <?php navBar(); ?>
        <?php echo $err ?><br>
        <form action="LandingPage.php" method="post">
            <input type ="text" name = "usr" placeholder = "User ID"><br>
            <input type = "password" name = "pass" placeholder="Password"><br>
            <input type="submit" value = "Submit">
        </form>
    </body>
</html>
