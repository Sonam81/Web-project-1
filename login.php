<?php


//connecting to database named csy2028-assignment
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '');

//starting a new session
session_start();
// if($_SESSION['loggedin'] = $row['username']){
//     require 'welcome.php';
// }
//assigning incoming values as $redirect if available
if (isset($_GET['redirect'])) {
$redirect = $_GET['redirect'];
}

//if submit button is pressed
if (isset($_POST['submit'])) {
    //prepare a select query
    $stmt = $pdo->prepare('SELECT * FROM tbl_user WHERE username = :username');  

    $criteria = [
        'username' => $_POST['username']
    ];

    $stmt->execute($criteria);
    //fetch data from the table
    $row = $stmt->fetch();
    //verify password 
    if (password_verify($_POST['password'], $row['password'])) {
      //setvalues of loggedin and logged
        $_SESSION['loggedin'] = $row['username'];
        $_SESSION['logged'] = 1;

    //display message to redirect to previous page
   // if(isset($redirect)){
    header('Location:welcome.php?session='.$_SESSION['loggedin']);
    echo 'You are now logged in, <a href="'.$redirect.'">Go to'.$redirect.'</a>';
    //}
    //echo 'You are logged in as ' . $_SESSION['loggedin'] . '<a href="logout.php">Click here to log out</a>';
}
    //If they didn't, display an error message
    else {
            echo '<p>You did not enter the correct username and password</p>';
    }
}
else { //The submit button was not pressed, show the log-in form
?>
<form action="" method="POST">
        <label>UserName: </label>
        <input type="text" name="username" />
        <label>Password: </label>
        <input type="password" name="password" />
        <input type="submit" name="submit" value="Log In" />
</form>
<?php
}