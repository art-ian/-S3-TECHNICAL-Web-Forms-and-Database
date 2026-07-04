<?php
session_start();
include("db.php");

$message = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isset($_POST['remember']))
    {
        setcookie("username", $username, time()+86400, "/");
    }

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password']))
        {
            $_SESSION['username'] = $user['username'];

            header("Location: home.php");
            exit();
        }
        else
        {
            $message = "Invalid Password!";
        }
    }
    else
    {
        $message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>

<h2>Login Form</h2>

<form method="POST">

    Username:
    <input type="text"
           name="username"
           value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>"
           required>

    <br><br>

    Password:
    <input type="password"
           name="password"
           required>

    <br><br>

    <input type="checkbox" name="remember">
    Remember Me

    <br><br>

    <input type="submit" name="login" value="Login">

</form>

<p style="color:red;">
    <?php echo $message; ?>
</p>

</body>
</html>