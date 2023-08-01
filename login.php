<?php
session_start();
include("include/dbConnect.php");

if (isset($_POST['login'])) {
    $userName    = $_POST['userName'];
    $password = md5($_POST['password']);

    $sql= "SELECT * FROM loginDetails WHERE (loginDetails.userName='$userName' || loginDetails.userEmail ='$userName') and loginDetails.password='$password'";
    $result =$conn->query($sql);

    $user_matched = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($user_matched > 0) {

        $_SESSION['loginUser'] = $row['userEmail'];
        header("location: welcome.php");
    } else {
        echo "<script>alert('Invalid Details!')</script>";
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="Public/css/style.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="container">
        <form class="login-form" method="POST">
            <h1>Login</h1>
            <label>Username / email: </label>
            <input type="text" name="userName" placeholder="Enter your username or email" autocomplete="off" required />

            <label>Password:</label>
            <input type="password" name="password" placeholder="Type in your password" required />

            <button name="login">Login</button>
        </form>
        <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>

</html>