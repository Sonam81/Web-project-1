<?php 
//get directory of the file
$redirect = $_SERVER['PHP_SELF'];
//start session
session_start();

//check if user is logged in
if(isset($_SESSION['logged']) == 1){
//add header file
require 'adminheader.php';
	//connect to database
	$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

	//if submit is pressed
	if(isset($_POST['submit'])){
		//prepare insert statement and execute it
		$insertStatement = $pdo->prepare("INSERT INTO tbl_categories(categorie_name)
		 VALUES (:categorie_name)");
		$insertCriteria = [
			'categorie_name' => $_POST['categorie_name']
		];
		if($insertStatement->execute($insertCriteria))
			echo '<p>INSERTED</p>';
		else
			echo'<p>NOT INSERTED</p>';

	}
?>
<form method="POST" action="addcategorie.php">
	<label class="labelpay">Add Categorie:</label>
	<input class="inputpay" type="text" name="categorie_name">
	<input class="review" type="submit" name="submit" value="submit">
</form>
<?php
}
else{
	//redirect to login page
	header('Location:login.php?redirect='.$redirect);
}
?>
