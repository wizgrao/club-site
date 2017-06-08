<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 7/19/2015
 * Time: 9:32 PM
 */
require "utils.php";
session_start();
if (isset($_SESSION['usr'])) {
    if ($_SESSION['type'] == "officer" || $_SESSION['type'] == "admin" || $_SESSION['type'] == "sponsor" || $_SESSION['type'] == "president") {
        $connection = loginDB();
        $stmt = $connection->prepare("INSERT INTO event(points, name, dateOccured) VALUES (?, ? , ?)");
        $stmt->bind_param("dss",$_POST['points'],$_POST['name'], $_POST['date']);
        $stmt->execute();
        $table=$connection->prepare("select id from event order by id desc");
        $table->execute();
        $last = 0;
        $table->bind_result($last);
        $table->fetch();

        $LastAutoIncrement=$last;
        while($table->fetch()){}
        $memberArray = $_POST['members'];
        foreach($memberArray as $member){
            $insertstmt = $connection->prepare("INSERT INTO attendance(eventID, userid) VALUES (?, ?)");
            $insertstmt->bind_param("is",$LastAutoIncrement,$member);
            $insertstmt->execute();

        }
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <META http-equiv="refresh" content="0;URL=checkPoints.php">
            <title>Submitting...</title>
        </head>
        <body>
        Submitting...
        </body>
        </html>
        <?php
    } else {
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
        </head>
        <body>
        You are not allowed to be here.
        </body>
        </html>
        <?php
    }
} else {
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
    </head>
    <body>
    <a href ="Login.php">Please log in</a>
    </body>
    </html>
    <?php
}