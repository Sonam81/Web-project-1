<?php
//connect to database named csy2028-assignment
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//prepare query to get data from tbl_review table
//display only verified reviews
$stmt = $pdo->prepare('SELECT * FROM tbl_review WHERE verified = "YES" ORDER BY review_id DESC');
$stmt->execute();

//use for loop to display limited reviews
//fetch a set of datas in each loop
for($i = 0;$i <5 ;$i++){
		$review = $stmt->fetch();

?>
<!-- 			display all the selected datas in the product page -->
				<li>
					<?php echo '<p>'.$review['review'].'</p>'?>
					<div class="details">
						<?php echo '<strong>'.$review['reviewer'].'</strong>'?>
						<?php echo '<em>'.$review['review_date'].'</em>'?>
					</div>
				</li>
		
<?php

}

?>