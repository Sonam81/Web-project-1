<?php

//connect to db
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//select datas
$sql = "SELECT * FROM product_details WHERE featured = 'YES'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

//check if username is set
if(isset($_GET['username']))
	$username = $_GET['username'];
else
	$username = 'not-logged';

foreach ($stmt as $details) {

	$product_code = $details['product_code'];
	$categorie_id = $details['categorie_id'];
	?>

<!-- 	append datas to frontend
 -->	<div class="similar">
				<div class="productImageDiv">
					<?php
					 echo '<img class="productImages" src="'.$details['productImages'].'">';
					?>
				</div>
				<div class="buy-info">
					<a href="<?php echo 'clickProduct.php?product_code='.$product_code .'&categorie_id=' .$categorie_id.'&username='.$username?>"><p class="buy">View Details</p></a>
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
						 echo'<del>$'.$details['costBefore'].'</del>';
						?>
						</span>
					</div> 	
					</div>
			</div>



		<?php
	} ?>
	
