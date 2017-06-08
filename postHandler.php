<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 8/2/2015
 * Time: 2:21 AM
 */

$level = 1;

require "utils.php";
$perm = permissions($level);
if($perm == 1){
    $connection = loginDB();
    $statement = $connection->prepare("INSERT INTO blog (author, created, post, title, division) values (?,?,?,?, ?)");

    $author = $_SESSION['usr'];
    date_default_timezone_set ( "America/New_York" );
    $created = date("Y-m-d H:i:s") ;
    $post = $_POST['txt'];
    $title = $_POST['title'];
    $div = $_POST['division'];
    $statement->bind_param("sssss",$author, $created, $post, $title, $_POST['division']);
    $statement->execute();
    if($div == "none")
        $stmt = $connection->prepare("SELECT email FROM users");
    else{
        $stmt = $connection->prepare("SELECT email FROM users where division = ?");
        $stmt->bind_param("s",$div);
    }
    $stmt->execute();
    $name = $_SESSION['name'];
    $stmt->bind_result($email);
    while($stmt->fetch()) {
        mail($email, "Post from $name: $title", "$title\n$post", "From: hhsmao@gauravity.com");
    }
    ?>

    <html>
    <head>
        <title>Redirecting to posts</title>
        <META http-equiv="refresh" content="0;URL=posts.php?division=<?php echo $div; ?>">
    </head>
    <body bgcolor="#ffffff">
        Redirecting you to the posts...
    </body>
    </html>

    <?php


}else if (permissions(1) == -1){ ?>
    <html>
    <head>
        <title>
            Create a post
        </title>
    </head>
    <body>
    You are not logged in
    </body>
    </html>
<?php }else if (permissions(1) == 0){ ?>
    <html>
    <head>
        <title>
            Create a post
        </title>
    </head>
    <body>

    You do not have permissions to do this.
    </body>
    </html>
<?php } ?>


