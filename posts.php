<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 8/3/2015
 * Time: 11:05 PM
 */

require_once 'Twig/lib/Twig/Autoloader.php';
require_once "utils.php";
$division = "none";
if(isset($_GET["division"])){
    $division = $_GET["division"];
}
$query = "SELECT blog.id as id, blog.author as userid, month(blog.created) as month, year(blog.created) as year, day(blog.created) as day, blog.post as text, blog.title as title,  users.type as type, users.name as name FROM blog join users on blog.author = users.userid WHERE blog.division = ? ORDER BY  created desc";

$connection =loginDB();
$stmt = $connection->prepare($query);
$stmt->bind_param("s",$division);
$stmt->execute();
$stmt->bind_result($id,$userid,$month,$year, $day,$text,$title, $type, $name);

$posts = array();
while( $stmt->fetch()){
    $date = $month."/".$day."/".$year;

    $posts[] = array("title"=>$title,"date"=>$date, "author"=>$name,"type"=>$type,"text"=>$text);
}

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("twigs");
$environ = new Twig_Environment($loader,array());
echo $environ->render("poststest.twig",array("division"=>$division, "elements"=>navBarTwig(),"posts"=>$posts,"permission"=>permissions(1)));// ayy lmao
