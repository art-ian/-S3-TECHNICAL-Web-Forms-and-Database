<?php
session_start();
include("db.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>

<h2>Welcome <?php echo $user['username']; ?></h2>

<h3>User Information</h3>

<p>First Name: <?php echo $user['firstname']; ?></p>
<p>Last Name: <?php echo $user['lastname']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>
<p>Username: <?php echo $user['username']; ?></p>

">Reset Password</a>

<br><br>

logout.php

</body>
</html>