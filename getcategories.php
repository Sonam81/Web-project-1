<?php

$categorie_id = $_GET['categorie_id'];
require 'header.php';
//connect to db
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//select data desc
$sql = "SELECT * FROM product_details WHERE categorie_id = $categorie_id ORDER BY product_code DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
echo '<div class="div_of_homepage">';
echo '<main class="main_homepage">';
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
					<a href="<?php echo 'clickProduct.php?product_code='.$product_code .'&categorie_id=' .$categorie_id?>"><p class="buy">View Details</p></a>
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

				</div>
			</div>



		<?php
	}
	echo '	</main>';
?>
		<aside>
				<span class="hot_deals">HOT DEALS</span>
			<?php 
			//get hotdeals file
			require 'hotdeals.php';?>

		</aside>
	</div>
<?php

		require 'footer.php';
	 ?>
