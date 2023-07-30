<?php
error_reporting(0);
include('include/dbConnect.php');
session_start();
if (empty($_SESSION['loginUser'])) {
    header("location: login.php");
    exit();
}

$sql = "SELECT * FROM `logindetails` WHERE userEmail = '".$_SESSION['loginUser']."'";

$result = $conn->query($sql);
if($result) {
    $rows= mysqli_num_rows($result);
    if($rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $userName = $row['userName'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome</title>
	<link href="Public/css/style.css" rel="stylesheet" media="all">
</head>

<body>
	<div class="container-welcome">
		<h1>Welcome!</h1>
		<p>Hello, <span><?php echo $userName ?></span>! Welcome to
			our website.</p>
		<a href="logout.php">Logout</a>
	</div>
</body>

</html>