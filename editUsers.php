<?php
require 'adminheader.php';
//connect to db
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//select the datas
$stmt = $pdo->prepare("SELECT * FROM table_users WHERE user_id = :id");

	$criteria = [ 'id' => $_GET['editId'] ];
	$stmt->execute($criteria);
	$details = $stmt->fetch();
	if(isset($_POST['update'])){
		//update the datas
		$update = $pdo->prepare("UPDATE table_users 
								SET 
									username = :username,
									password = :password
								WHERE 
									user_id = :id");
		$hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
		unset($_POST['update']);
		$criteria = [
			'password' => $hashed,
			'username' => $_POST['username'],
			'id' => $_POST['id']
		];
		  print_r($_POST);
		if($update->execute($criteria)){
			echo "stmt executed";
		}
	}
	



?>

<form style="padding-top: 5%" action="" method="POST">
	<input type="hidden" name="id" value="<?php echo $_GET['editId'];?>">
 	<label class="labelpay">UserName:</label>
	<input class="inputpay" name="username" value="<?php echo $details['username']?>"><br>
 	<label class="labelpay">Password</label>
 	<input class="inputpay" type="password" name="password"><br>

	<input class="review" type="submit" name="update" value="Update">
</form>

