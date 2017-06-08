<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 8/2/2015
 * Time: 2:21 AM
 */

function permissions($type)
{//type is 0 for signed in members, 1 is for officers, 2 is for sponsor, admin, president returns 1 for success, -1 for not logged in, 0 for access not allowed.
    session_start();
    if (!isset($_SESSION['usr'])) {
        return -1;
    }
    switch ($type) {
        case 0:
            return 1;
            break;
        case 1:
            if ($_SESSION['type'] == 'officer' || $_SESSION['type'] == 'president' || $_SESSION['type'] == 'sponsor') {
                return 1;

            }
            return 0;
            break;
        case 2:
            if ($_SESSION['type'] == 'president' || $_SESSION['type'] == 'sponsor') {
                return 1;

            }
            return 0;
            break;
    }
    return -2;

}

function loginDB()
{
    $file = fopen("private/cred.txt", "r");
    $user = trim(fgets($file));
     $pass = trim(fgets($file));
    $db = trim(fgets($file));

    $connection = mysqli_connect("localhost", $user, $pass, $db);
    return $connection;
}
//
function navBar()
{
    session_start();
    ?>
    <ul class="header">

    <?php
    if (permissions(0) == 1) { ?>


        <li>
            Hello <?php echo $_SESSION['name'] . "! "; ?>
        </li>


        <li>
            <a href="message.php">Messages</a>
        </li>

    <?php } ?>
    <li>
        <a href="checkPoints.php">Points</a>
    </li>
    <li>
        <a href="posts.php">Posts</a>
    </li>

    <?php
    if (permissions(1) == 1) { ?>
        <li>
            <a href="createEvent.php">Create Event</a>
        </li>
        <li>
            <a href="results.php">Submit Results</a>
        </li>

    <?php } ?>
    <?php if (permissions(2) == 1) { ?>
    <li>
        <a href="CreateAccount.php">Add Member</a>
    </li>

    <li>
        <a href="log.php">Log</a>
    </li>
<?php }
    if (permissions(0) == 1) { ?>
        <li>
            <a href="logout.php">logout</a>
        </li><?php
    } else { ?>
        <li>
            <a href="Login.php">Log in</a>
        </li>
    <?php } ?></ul><?php
}
function navBarTwig(){
    $nav = array();
    if(permissions(0)==1) {
        $nav[] = array("url" => "profile.php", "text" => "Hello " . $_SESSION["name"]."!");
        $nav[] = array("url" => "message.php", "text" => "Messages");
    }
    $nav[] = array("url" => "checkPoints.php", "text" => "Points");
    $nav[] = array("url" => "posts.php", "text" => "Posts");
    if (permissions(1) == 1) {
        $nav[] = array("url" => "crateEvent.php", "text" => "Create an event" );
        $nav[] = array("url" => "results.php", "text" => "Submit Results");
    }
    if (permissions(2) == 1) {
        $nav[] = array("url" => "CreateAccount.php", "text" => "Add a member" );
        $nav[] = array("url" => "log.php", "text" => "Log");
    }
    if(permissions(0)==1){
        $nav[] = array("url" => "logout.php", "text" => "Log Out");
    }else{
        $nav[] = array("url"=>"Login.php", "text"=>"Log In");
    }
    return $nav;



}