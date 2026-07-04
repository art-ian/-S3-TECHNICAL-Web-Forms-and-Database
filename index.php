<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db.php");

$message = "";

if(isset($_POST['register']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password)
    {
        $message = "Password and Confirm Password are not the same!";
    }
    else
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(firstname, lastname, email, username, password)
                VALUES('$firstname','$lastname','$email','$username','$hashedPassword')";

        if($conn->query($sql))
        {
            $message = "Registration Successful!";
        }
        else
        {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SA3 Registration Form</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f4f4;
        }

        .container{
            width:500px;
            margin:50px auto;
            background:#fff;
            padding:20px;
            border-radius:10px;
            box-shadow:0px 0px 10px gray;
        }

        h2{
            text-align:center;
        }

        input{
            width:100%;
            padding:10px;
            margin:8px 0;
            box-sizing:border-box;
        }

        button{
            width:100%;
            padding:10px;
            background:green;
            color:white;
            border:none;
            cursor:pointer;
        }

        .message{
            text-align:center;
            margin-top:15px;
            font-weight:bold;
            color:blue;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Registration Form</h2>

    <form method="POST">

        <input type="text"
               name="firstname"
               placeholder="First Name"
               required>

        <input type="text"
               name="lastname"
               placeholder="Last Name"
               required>

        <input type="email"
               name="email"
               placeholder="Email"
               required>

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <input type="password"
               name="confirm_password"
               placeholder="Confirm Password"
               required>

        <button type="submit" name="register">
            Register
        </button>

    </form>

    <div class="message">
        <?php echo $message; ?>
    </div>

</div>

</body>
</html>