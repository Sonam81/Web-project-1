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
$sql = "SELECT * FROM product_details";
	$details = $pdo->prepare($sql);
	$details->execute();

	//if delId is set then
	if(isset($_GET['delId'])){
		//prepare delete query
		$stmt = $pdo->prepare("DELETE FROM product_details WHERE product_code = :id");
		$criteria = [
			'id' => $_GET['delId']
		];
		//execute the prepared statement
		if($stmt->execute($criteria)) echo '<h5>Product Deleted</h5>';
	}
	if(isset($_GET['details'])){
		echo $_GET['details'];
	}

	//add tableGenerator file
	require 'tableGenerator.php';

	//create object named tg
	$tg = new tableGenerator();
	//call setHeadings function and add parameters
	$tg->setHeadings(['Product Code','Categorie Id','Product Image','Product Name','Product Description','Cost After','Cost Before','Featured','Action']);
	foreach($details as $row){
		//call setRows functions and add parameters
		$tg->setRows($row);
	}
	//call getHtmlProduct
	echo $tg->getHtmlProduct();
}
else{
	//redirect to login.php
	header('Location:login.php?redirect='.$redirect);
}
?>

