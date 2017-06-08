<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 8/4/2015
 * Time: 12:17 PM
 */
require_once "utils.php";//
require_once 'Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("twigs");
$environ = new Twig_Environment($loader,array());

session_start();
if(permissions(0)==1) {
    $usr = $_SESSION['usr'];
    $name = $_SESSION['name'];
    $division = $_SESSION['division'];
    $class = $_SESSION['class'];
    $type = $_SESSION['type'];
    $email = $_SESSION['email'];

    echo $environ->render("profile.twig",array("elements"=>navBarTwig(),"usr"=>$usr,"name"=>$name,"division"=>$division,"class"=>$class,"type"=>$type,"email"=>$email));
}else{
    echo $environ->render("notsigned.twig",array("elements"=>navBarTwig()));
}////