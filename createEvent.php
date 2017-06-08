<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 7/19/2015
 * Time: 6:48 PM
 */
require "utils.php";
function generateList()
{
    $connection = loginDB();
    $stmt = $connection->prepare("select userid,name from users order by name");
    $stmt->execute();
    $row = array();
    $stmt->bind_result($row['userid'],$row['name']);

        while($stmt->fetch()) {

            $userid = $row['userid'];
            $name = $row['name'];
            echo "<input type = \"checkbox\" name = \"members[]\" value=\"$userid\" id=\"$userid\"><label for=\"$userid\">$name</label><br>";

        }


}

$nameError = $dateError = $pointsError = "";
session_start();
if(permissions(1)==1){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            if (isset($_POST['nameError'])) {
                $nameError = $_POST['usrError'];
            }

            if (isset($_POST['dateError'])) {
                $dateError = $_POST['dateError'];
            }

            if (isset($_POST['pointsError'])) {
                $pointsError = $_POST['pointsError'];
            }

        }


        ?>

        <html>
        <head>
            <title>Create an event</title>
            <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
            <link rel="stylesheet" type="text/css" href="theme.css">
            <style>
                #members {
                    height: 250px;
                    width: 300px;
                    overflow: auto;
                }
            </style>
        </head>
        <body>
        <?php navBar(); ?>
        <form action="eventHandler.php" method="post" id = "cont">
            Name: <input type="text" placeholder="Name" name="name"><span class="err"><? echo $nameError; ?></span><br>
            Date: <input type="date" placeholder="Date" name="date"><span class="err"><? echo $dateError; ?></span><br>
            Points: <input type="number" placeholder="Points" step=".1" name="points"><span
                class="err"><? echo $pointsError; ?></span><br>
            Select the members that attended this event: <br>

            <div id="members">
                <?php generateList(); ?>
            </div>
            <input type="submit" value="Submit">

        </form>
        </body>
        </html>
        <?php
    } else  if(permissions(1) == 0){
        ?>
        <html>
        <head>
            <title>Create an event</title>
            <style>
                #members {
                    height: 250px;
                    width: 300px;
                    overflow: auto;
                }
            </style>
            <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
            <link rel="stylesheet" type="text/css" href="theme.css">
        </head>
        <body>
        <?php navBar(); ?>
            You are not allowed to be here.
        </body>
        </html>
        <?php
    }
 else {
    ?>
    <html>
    <head>
        <title>Create an event</title>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" type="text/css" href="theme.css">
        <style>
            #members {
                height: 250px;
                width: 300px;
                overflow: auto;
            }
        </style>
    </head>
    <body>
    <?php navBar(); ?>
        <a href ="Login.php">Please log in</a>
    </body>
    </html>
    <?php
}