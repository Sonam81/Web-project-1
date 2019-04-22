<?php
//adding header file
require 'adminheader.php';
//connecting to database named csy2028-assignment
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//start new session
session_start();
//get file directory
$redirect = $_SERVER['PHP_SELF'];

//check if user is logged in
if(isset($_SESSION['logged']) == 1){

//select query 
//prepare and execute select query
$sql = "SELECT * FROM tbl_categories";
	$details = $pdo->prepare($sql);
	$details->execute();

	//if delId is set then
	if(isset($_GET['delId'])){
		//prepare delete query
		$stmt = $pdo->prepare("DELETE FROM tbl_categories WHERE categorie_id = :id");
		$criteria = [
			'id' => $_GET['delId']
		];
		//execute the prepared statement
		if($stmt->execute($criteria)) echo '<h5>Category Deleted</h5>';
	}
	//add tableGenerator file
	require 'tableGenerator.php';
	//create object named tg
	$tg = new tableGenerator();
	$tg->setHeadings(['Category Id','Category Name','Action']);
	foreach($details as $row){
		//call setRows functions and add parameters
		$tg->setRows($row);
	}
	//call getHtmlCategory
	echo $tg->getHtmlCategory();
}
else{
	//redirect to login.php	
	header('Location:login.php?redirect='.$redirect);
}
?>

