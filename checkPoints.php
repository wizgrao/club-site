<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 7/21/2015
 * Time: 10:46 AM
 */
session_start();
require "Table.php";
require "utils.php";

class pointsTable{
    public $arr = array();
    public $peeps = array();
    public function entry($event, $name, $points){
        if(!isset($this->arr[$event])){
            $this->arr[$event] = array();
        }
        $this->arr[$event][$name] = $points;
        if(!isset($this->peeps[$name])){
            $this->peeps[$name] = $points;

        }else{
            $this->peeps[$name]+=$points;
        }
    }
    public function display(){
        $t = new Table();
        $t->firstRowTr = true;
        $t->set(0,0,"Name");
        $t->set(0,1,"Total");
        for($i = 0; $i < count(array_keys($this->arr)); $i++){
            $t->set(0,$i +2,array_keys($this->arr)[$i]);
        }
        for($i =0;$i < count($this->peeps); $i++){
            $t->set($i+1,0,array_keys($this->peeps)[$i]);
            $pk = array_keys($this->peeps)[$i];
            $t->set($i+1,1,$this->peeps[$pk]);
            for($j = 0; $j < count(array_keys($this->arr)); $j++){
                $key = array_keys($this->arr)[$j];
                $pts = 0;
                if(isset($this->arr[$key][$pk])){
                    $pts = $this->arr[$key][$pk];
                }
                $t->set($i+1,$j+2,$pts);
            }
        }
        $t->display();

    }
}

    $connection = loginDB();


    $stmt = $connection->prepare("SELECT month(event.dateOccured) as mon, day(event.dateOccured) as da,year(event.dateOccured) as ye, event.id as eventid, users.name as personname, event.name as event, event.points  as points from users join attendance  on users.userid = attendance.userid join event on attendance.eventID = event.id order by event, users.name");
    $stmt->execute();
    $row = array();
    $stmt->bind_result($row['mon'],$row['da'],$row['ye'],$row['eventid'],$row['personname'],$row['event'],$row['points']);
    $table = new pointsTable();
    while ($stmt->fetch()) {
        $table->entry($row["mon"]."/".$row["da"]."/".$row['ye']." ".$row['event'],$row['personname'],$row['points']);

    }

    ?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" type="text/css" href="theme.css">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />



        <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">

        <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('table').dataTable();
            } );
        </script>
        <title>Check Points</title>
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
        <table><?php $table->display(); ?></table>
    </body>
    </html>


