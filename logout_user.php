<?php
session_start();
//unset sessions
unset($_SESSION['loggedinuser']);
unset($_SESSION['loggeduser']);
// header('location:login.php');

echo 'You are now logged out
<a href="logincheck.php">Go to
logincheck.php</a>';
