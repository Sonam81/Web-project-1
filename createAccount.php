<?php

//if createAccount is pressed
if (isset($_POST['createAccount'])) {
	
	//connect to db
	$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '');

	//prepare insert statement
	$stmt = $pdo->prepare('INSERT INTO table_users (username, password)
				   VALUES (:username, :password)');

	//hash password to store
	$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$criteria = [
		'username' => $_POST['username'],
		'password' => $hash
	];
	//execute the dquery
	$stmt->execute($criteria);

	echo 'Registration successful';
}
else{
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="original.css">
</head>
<body>
	<main class="createAccount">
		<div class="title">Create Account</div>
		<form action="createAccount.php" method="POST">
			<input class="input" placeholder="UserName" type="text" name="username">
			<input class="input" placeholder="Password" type="password" name="password">
			<input class="input" type="submit" name="createAccount" value="Create Account">
		</form>
		<span class="social">Already have an Account?<a href="login_user.html"> Sign In</a></span>




	</main>

</body>
</html>
<?php }?>