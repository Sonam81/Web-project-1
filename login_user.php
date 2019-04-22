<?php


//connecting to database named csy2028-assignment
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '');


//starting a new session
session_start();
//check if product_code is set
if(isset($_GET['product_code'])){
    $product_code = $_GET['product_code'];
}
//check if quantity is set
if(isset($_GET['quantity'])){
    $quantity = $_GET['quantity'];
}
//check if categorie_id is set
if(isset($_GET['categorie_id'])){
    $categorie_id = $_GET['categorie_id'];
}

//if submit button is pressed
if (isset($_POST['login'])) {
    //prepare a select query
    $stmt = $pdo->prepare('SELECT * FROM table_users WHERE username = :username');  
    $criteria = [
        'username' => $_POST['username']
    ];
    //execute the prepared statement
    $stmt->execute($criteria);
    //fetch data from the table
    $row = $stmt->fetch();
    //verify password 
    if (password_verify($_POST['password'], $row['password'])) {
      //setvalues of loggedin and logged
        $_SESSION['loggedinuser'] = $row['username'];
        $_SESSION['loggeduser'] = 1;

    //iif product_code and categorie_id is set, allow to move to  clickProduct.php page
    if(isset($_GET['product_code'])){
        if(isset($categorie_id)){
        //display message to redirect to clickProduct.php
            echo '<a style="color: black" href="clickProduct.php?product_code='.$_GET['product_code'].'&categorie_id='.$_GET['categorie_id'].'&username='.$row['username'].'">Click me to go to product page</a>';
        }
    //else if product_code and quantity is set, allow to move to shoppingcart
    elseif(isset($quantity)){ 
        //display message to redirect to shoppingcart.php
            echo '<a style="color: black" href="shoppingcart.php?product_code='.$_GET['product_code'].'&quantity='.$_GET['quantity'].'">Click me to go to shopping cart</a>';
        }
    }
    else{
    //else just display welcome message and name of user, allow to move to homepage
    echo 'You are logged in as ' . $_SESSION['loggedinuser'] .'click to redirect to HOME<a href="original.php?username='.$row['username'].'">CLICK ME!!</a>';

    }
}
    //if password is not verified
    else {
            echo '<p>You did not enter the correct username and password</p>';
    }
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
	<link rel="stylesheet" type="text/css" href="original.css">
</head>
<body>
	<main class="createAccount">
		<div class="title">Log In</div>
          <!-- login form -->
		<form method="POST" action="">
			<input class="input" placeholder="UserName" type="text" name="username">
			<input class="input" placeholder="Password" type="password" name="password">
			<input class="input" type="submit" name="login" value="Log In">
            <input type="hidden" name="product_code" value="<?echo $_GET['product_code']?>">
            <input type="hidden" name="quantity" value="<?echo $_GET['quantity']?>">
            </form>
		<span class="social">Don't have an Account?<a href="createAccount.php"> Sign Up</a></span>




	</main>

</body>
</html>