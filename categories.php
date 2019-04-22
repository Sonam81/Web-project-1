<?php

//connect to database
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//prepare select query
//execute the query
$sql = "SELECT * FROM product_details WHERE categorie_id = :categorie_id";
	$criteria = [
		'categorie_id' => $_GET['categorie_id']
	];
	$stmt = $pdo->prepare($sql);
	$stmt->execute($criteria);

//use for loop to access
for($i = 0;$i < 3;$i++){
		$details = $stmt->fetch();
	$product_code = $details['product_code'];
	$categorie_id = $details['categorie_id'];
	?>
	<div class="similar">
				<div class="productImageDiv">
					<?php
					 echo '<img class="productImages" src="'.$details['productImages'].'">';
					?>
				</div>
				<div class="buy-info">
					<a href="<?php echo 'clickProduct.php?product_code='.$product_code .'&categorie_id=' .$categorie_id.'&username='.$_GET['username']?>"><p class="buy">View Details</p></a>
				</div>
				<div class="proOne">
					<div class="productName">
						<?php
						 echo '<a href="#" title="'.$details['productName'].'">'.$details['productName'].'</a>';
						?>
					</div>
					<div class="costAfter">
						<?php
						 echo '<span>$'.$details['costAfter'].'</span>';
						?>
					</div>
					<div class="costBefore">
						<span>
						<?php 
						 echo'<del>'.$details['costBefore'].'</del>';
						?>
						</span>
					</div>
				</div>
			</div>



		<?php
	} ?>
	
