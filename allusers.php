<?php
//add header file
require 'adminheader.php';

//connect database
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//start session and get file directory
session_start();
$redirect = $_SERVER['PHP_SELF'];

//check if user is logged in
if(isset($_SESSION['logged']) == 1){

//prepare select query and execute it
$sql = "SELECT * FROM table_users";
	$details = $pdo->prepare($sql);
	$details->execute();

//if delId is set delete related items from table
	if(isset($_GET['delId'])){
		$stmt = $pdo->prepare("DELETE FROM table_users WHERE user_id = :id");
		$criteria = [
			'id' => $_GET['delId']
		];
		if($stmt->execute($criteria)) echo '<h5>User Deleted</h5>';
	}

//get tableGenerator file and 
//create new object and access is methods
	require 'tableGenerator.php';

	$tg = new tableGenerator();
	$tg->setHeadings(['User Id','Username','Password','Action']);
	foreach($details as $row){
		$tg->setRows($row);
	}
	echo $tg->getHtmlUser();
}
else{
	//redirect to login page
	header('Location:login.php?redirect='.$redirect);
}
?>

