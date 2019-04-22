<?php
session_start();
//unset sessions
unset($_SESSION['loggedin']);
unset($_SESSION['logged']);
// header('location:login.php');

echo 'You are now logged out
<a href="index.php">Go to
Home Page</a>';
