<?php

//connect to database
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//prepare select query and execute it
$selectQuery = $pdo->prepare('SELECT * FROM tbl_categories');
$selectQuery->execute();
foreach ($selectQuery as $selected) {

	//send data to getCategories file
	echo '<li><a href="getcategories.php?categorie_id='.$selected['categorie_id'].'">'.$selected['categorie_name'].'</a></li>';
}
?>