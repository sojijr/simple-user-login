<?php
session_start();
unset($_SESSION['loginUser']);
session_destroy();
header("Location: login.php");
?>