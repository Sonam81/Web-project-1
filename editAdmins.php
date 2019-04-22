<?php

//get header file
require 'adminheader.php';

//connect to db
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//prepare select query and execute it to get data
$stmt = $pdo->prepare("SELECT * FROM tbl_user WHERE id = :id");

	$criteria = [ 'id' => $_GET['editId'] ];
	$stmt->execute($criteria);
	$details = $stmt->fetch();

	//if update is set then prepare the update statement
	if(isset($_POST['update'])){
		$update = $pdo->prepare("UPDATE tbl_user 
								SET 
									firstname = :firstname,
									surname = :surname,
									username = :username,
									password = :password
								WHERE 
									id = :id");
		//hash updated password
		$hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
		unset($_POST['update']);
		$criteria = [
			'password' => $hashed,
			'username' => $_POST['username'],
			'firstname' => $_POST['firstname'],
			'surname' => $_POST['surname'],
			'id' => $_POST['id']
		];
		unset($_POST['update']);
		//update product
		if($update->execute($criteria)){
			echo "stmt executed";
		}
	}
	



?>

<form style="padding-top: 5%" action="" method="POST">
	<input type="hidden" name="id" value="<?php echo $_GET['editId'];?>">
	<label class="labelpay">Enter First Name:</label>
	<input class="inputpay" type="text" name="firstname" value="<?php echo $details['firstname']?>"><br>
	<label class="labelpay">Enter Surname: </label>
	<input class="inputpay" type="text" name="surname" value="<?php echo $details['surname']?>"><br>
	<label class="labelpay">Username:</label>
	<input class="inputpay" name="username" value="<?php echo $details['username']?>"><br>
 	<label class="labelpay">Password</label>
 	<input class="inputpay" type="password" name="password"><br>

	<input class="review" type="submit" name="update" value="Update">
</form>

