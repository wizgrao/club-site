<?php
session_start();
require "utils.php";
if(permissions(2)) {
    $usrerror = $passerror = $emailError = $passConfirmError = $nameError = $typeError = $classError = $divisionError = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        if (isset($_POST['usrError'])) {
            $usrerror = $_POST['usrError'];

        }
        if (isset($_POST['passError'])) {
            $passerror = $_POST['passError'];

        }

         if (isset($_POST['passConfirmError'])) {
            $passConfirmError = $_POST['passConfirmError'];

        }

         if (isset($_POST['nameError'])) {
            $nameError = $_POST['nameError'];

        }

         if (isset($_POST['typeError'])) {
            $typeError = $_POST['typeError'];

        }

         if (isset($_POST['classError'])) {
            $classError = $_POST['classError'];

        }

         if (isset($_POST['divisionError'])) {
            $divisionError = $_POST['divisionError'];

        }
        if (isset($_POST['emailError'])) {
            $emailError = $_POST['emailError'];

        }
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Create Account</title>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" type="text/css" href="theme.css">
    </head>
    <body>
    <?php navBar(); ?>
    <form action="AccountLandingPage.php" method="post" id="cont">
        <input type="text" name="usr" placeholder="User Name"><span class="err"> <?php echo $usrerror ?></span><br>
        <input type="password" name="pass" placeholder="Password"><span class="err"> <?php echo $passerror ?></span><br>
        <input type="password" name="passConfirm" placeholder="Confirm Password"><span class="err"> <?php echo $passConfirmError ?></span><br>
        <input type="text" name="name" placeholder="Name"><span class="err"> <?php echo $nameError ?></span><br>
         <input type="text" name="email" placeholder="Email"><span class="err"> <?php echo $emailError ?></span><br>
        <select name = "type">
            <option value = "member">Member</option>
            <option value = "officer">Officer</option>
            <option value = "president">President</option>
            <option value = "admin">Admin</option>
            <option value = "sponsor">Sponsor</option>
        </select><span class="err"> <?php echo $typeError ?></span><br>
        <select name = "class">
            <option value = "2019">2019</option>
            <option value = "2018">2018</option>
            <option value = "2017">2017</option>
            <option value = "2016">2016</option>
            <option value = "n/a">n/a</option>
        </select><span class="err"> <?php echo $classError ?></span><br>
        <select name = "division">
            <option value = "geometry">Geometry</option>
            <option value = "algebra">Algebra 2</option>
            <option value = "precalc">Precalculus</option>
            <option value = "calculus">Calculus</option>
            <option value = "statistics">Statistics</option>
            <option value = "n/a">n/a</option>
        </select><span class="err"> <?php echo $divisionError ?></span><br>


        <input type="submit" value="Submit">

    </form>
    </body>
    </html>
    <?php
}else if(permissions(1) == 0){

       ?><!DOCTYPE html>
    <html>
    <head>
        <title>Create Account</title>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
            <link rel="stylesheet" type="text/css" href="theme.css">
    </head>
    <body>
    <?php navBar(); ?>

        You are not allowed to be here.


    </body>
    </html><?php
    }else{
        ?>
        <!DOCTYPE html>
    <html>
    <head>
        <title>Create Account</title>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
            <link rel="stylesheet" type="text/css" href="theme.css">
    </head>
    <body>
    <?php navBar(); ?>

        <a href="Login.php">Please log in.</a>


    </body>
    </html>
        <?php
    }


?>