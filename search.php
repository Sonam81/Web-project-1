<?php
//connect to db
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$searchTerm = $_GET['searchTerm'];

//search query
$searchQuery = "SELECT * FROM product_details WHERE productName LIKE '%" . $searchTerm .  "%'";
$searchStatement = $pdo->prepare($searchQuery);
$searchStatement->execute();

//append datas on frontend
while ($data = $searchStatement->fetch()){
	echo '<p>'.$data['productName'].'</p>';
	echo '<img src="'.$data['productImages'].'"></p>';
	echo '<p>'.$data['costBefore'].'</p>';
}

?>