<?php
//get directory of the file
$redirect = $_SERVER['PHP_SELF'];

//add header file
require 'adminheader.php';

//start session and check if user is logged in
session_start();
if(isset($_SESSION['logged']) == 1){
if (isset($_POST['submit'])) {
	//connect to db
	$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '');

	//insert statement
	$stmt = $pdo->prepare('INSERT INTO tbl_user (firstname, surname, username, password)
				   VALUES (:firstname, :surname, :username, :password)');


	$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$criteria = [
		'firstname' => $_POST['firstname'],
		'surname' => $_POST['surname'],
		'username' => $_POST['username'],
		'password' => $hash
	];

	$stmt->execute($criteria);

	echo 'Registration successful';
}
else {
	
?>
<form style="padding-top: 5%" action="register.php" method="POST">
	<label class="labelpay">First Name:</label> <input class="inputpay" type="text" name="firstname" />
	<label class="labelpay">Surname:</label> <input class="inputpay" type="text" name="surname" />
	<label class="labelpay">UserName:</label> <input class="inputpay" type="text" name="username" />
	<label class="labelpay">Password:</label> <input class="inputpay" type="password" name="password" />

	<input class="review" type="submit" name="submit" value="Submit" />
</form>
<?php
}
}
else{
	header('Location:login.php?redirect='.$redirect);
}
?>