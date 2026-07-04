<?php
session_start();
include("db.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['reset']))
{
    $username = $_SESSION['username'];

    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $renew = $_POST['reenter_password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if(!password_verify($current, $user['password']))
    {
        $message = "Current password is not the same with the old password";
    }
    elseif($new != $renew)
    {
        $message = "New password and ReEnter new password should be the same";
    }
    else
    {
        $hashed = password_hash($new, PASSWORD_DEFAULT);

        $update = "UPDATE users
                   SET password='$hashed'
                   WHERE username='$username'";

        if($conn->query($update))
        {
            $message = "Password Updated Successfully";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>

<h2>Reset Password</h2>

<form method="POST">

    Current Password:<br>
    <input type="password" name="current_password" required>
    <br><br>

    New Password:<br>
    <input type="password" name="new_password" required>
    <br><br>

    Re-enter New Password:<br>
    <input type="password" name="reenter_password" required>
    <br><br>

    <input type="submit" name="reset" value="Reset Password">

</form>

<p><?php echo $message; ?></p>

home.php

</body>
</html>