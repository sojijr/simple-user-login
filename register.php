<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="Public/css/style.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="container">
        <form class="login-form" method="POST">
            <h1>Register</h1>
            <label>Username: </label>
            <input type="text" name="userName" placeholder="Enter a username" required />

            <label>Email: </label>
            <input type="email" name="userEmail" placeholder="Enter your email" required />

            <label>Password: </label>
            <input type="password" name="password" placeholder="Enter a password" required />

            <label>Confirm Password: </label>
            <input type="password" name="confirmPassword" placeholder="Re-enter password" required />

            <button name="register">Register</button>
        </form>
        <p class="register-link">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>

</html>

<?php
include('include/dbConnect.php');
if(isset($_POST['register'])) {
    $userName = filter_input(INPUT_POST, 'userName');
    $userEmail = filter_input(INPUT_POST, 'userEmail');
    $password = filter_input(INPUT_POST, 'password');
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
    } else {
        $sqlcheck= "SELECT * FROM loginDetails WHERE (userName ='$userName' || userEmail = '$userEmail')";
        $dsqlcheck= $conn->query($sqlcheck);
        if (mysqli_num_rows($dsqlcheck) > 0) {
            echo "<script>alert('Username / email already exist!');</script>";
        } else {
            if($password !== $confirmPassword) {
                echo "<script>alert('Password is not thesame as confirm password!');</script>";
            } else {
                $encryptPassword = md5($password);

                $sql = "INSERT INTO loginDetails (userName, userEmail, password)
                            values ('$userName', '$userEmail', '$encryptPassword')";

                if ($conn->query($sql)) {
                    echo "<script>alert('You have been registered!');</script>";
                    echo "<script type='text/javascript'>window.location.href='login.php'</script>";
                } else {
                    echo "<script>alert('Unsuccessful registration!');</script>";
                }
            }
        }
    }
}
$conn->close();
?>