
<?php
//connect to database named csy2028-assignment
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


if(isset($_GET['username']))
	$username = $_GET['username'];
else
	$username = 'not-logged';
//select datas from the product_details
//order by the new product added
//execute the prepared statement

if(isset($_GET['searchTerm'])){
	$searchTerm = $_GET['searchTerm'];

$searchQuery = "SELECT * FROM product_details WHERE productName LIKE '%" . $searchTerm .  "%'";
$searchStatement = $pdo->prepare($searchQuery);
$searchStatement->execute();

}
else{
$searchQuery = "SELECT * FROM product_details ORDER BY product_code DESC";
	$searchStatement = $pdo->prepare($searchQuery);
	$searchStatement->execute();
}

//use for loop to limit the product to display
//fetch a set of data each loop
// for($i = 0;$i < 6;$i++){

// 	$details = $searchStatement->fetch();
foreach ($searchStatement as $details) {
	# code...

	$product_code = $details['product_code'];
	$categorie_id = $details['categorie_id'];
	
	?>
	
	<div class="similar">
				<div class="productImageDiv">
					<?php
					//display product's image
					 echo '<img class="productImages" src="'.$details['productImages'].'">';
					?>
				</div>
				<div class="buy-info">
					<a href="<?php echo 'clickProduct.php?product_code='.$product_code .'&categorie_id=' .$categorie_id.'&username='.$username?>"><p class="buy">View Details</p></a>
				</div>
				<div class="proOne">
					<div class="productName">
						<?php
						//display product's name
						 echo '<a href="#" title="'.$details['productName'].'">'.$details['productName'].'</a>';
						?>
					</div>
					<div class="costAfter">
						<?php
						//display product's cost
						 echo '<span>$'.$details['costAfter'].'</span>';
						?>
					</div>
				</div>
			</div>



		<?php
	} ?>
	
