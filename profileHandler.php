<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 8/4/2015
 * Time: 12:31 PM
 */
session_start();

require "utils.php";
$conn = loginDB();
$name = $_POST['name'];
$email = $_POST['email'];
$userid = $_SESSION['usr'];
$stmt = $conn->prepare("UPDATE users SET name = ?, email = ? where userid = ?");
$stmt->bind_param("sss",$name,$email,$userid);
$stmt->execute();
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
?>
<!DOCTYPE html>
<html>
<head>
    <META http-equiv="refresh" content="0;URL=profile.php">

</head>
<body>
Changing...
</body>
</html>
