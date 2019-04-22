
<?php
//start a new session
session_start();
//connect to the database named csy2038-assignment, username - root password - null
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//select all datas from product_details table to display related data only
$sql = "SELECT * FROM product_details WHERE product_code = :product_code";
	$criteria = [
		'product_code' => $_GET['product_code']
	];
	$stmt = $pdo->prepare($sql);
	$stmt->execute($criteria);
	//fetching data where productcode is same
	$details = $stmt->fetch();

	//assigning code and id to respective variable
	$product_code = $_GET['product_code'];
	$categorie_id = $_GET['categorie_id'];

//if submitreview is pressed
if(isset($_POST['submitreview'])){
	//if user has logged in 
	if($_SESSION['loggeduser'] == 1 && $_GET['username'] != 'not-logged'){
	//then insert all data into tbl_review
	//prepare the query first
	$stmt = $pdo->prepare('INSERT INTO tbl_review (product_code, review, review_date, reviewer)
				   VALUES (:product_code, :review, :review_date, :reviewer)');
	$_POST['review_date'] = date('Y/m/d');

	$insertCriteria = [
		'product_code' => $_GET['product_code'],		
		'review' => $_POST['review'],
		'review_date' => $_POST['review_date'],
		'reviewer' => $_GET['username']
	];
	unset($_POST['submitreview']);
	//execute the query
	$stmt->execute($insertCriteria);
}


else{
	//if user is not logged in send detail of product to login page
	header('Location:login_user.php?product_code='.$product_code.'&categorie_id='.$_GET['categorie_id']);}
}



?>

<!doctype html>
<html>
	<head>
		<title>Ed's Electronics</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="electronics.css" />
	</head>

	<body>
<?php
//add header.php file 
require 'header.php';
?>
<div class="div_of_clickProduct">
	<div class="ad">

	<form action="addingtoshoppingcart.php" method="POST">
	<div class="product_image_brief">
		<div class="product_image">
			<img src="<?php echo  $details['productImages'];?>">
		</div>
		<div class="buy-info">
					<a href=""><input class="buy" type="submit" name="cart" value="Add to cart"></a>
				</div>
		<div class="proOne">
			<div class="productName">
				<span>
					<h3>
					<?php
					//display the product name in frontend
						 echo '<a href="#" title="'.$details['productName'].'">'.$details['productName'].'</a>';?>
						 	
					</h3>
				</span>
			</div>
			<div class="costAfter">
				<span>
					<h2><?php
						//displat costAfter in frontend
						 echo '<span>$'.$details['costAfter'].'</span>';
						?>
					</h2>
				</span>
			</div>
			<div class="costBefore">
				<span>
					<del>
						<?php
						 //display costBefore in frontend
						 echo '<span>'.$details['costBefore'].'</span>';
						?>
					</del>
				</span>
			</div>
		</div>
	</div>
	<div class="quantity_cart">
<!-- 		get quantity of the product the user need -->
		<label>Quantity</label>
		<input style="height: 40px" type="number" name="quantity" value="2" min="1" max="5">
	</div>
	<input type="hidden" name="product_code" value="<?php echo  $product_code; ?>">
	<input type="hidden" name="session" value="<?php echo  $session; ?>">
</form>
	</div>

<main class="product_detail">
	<br>
		<?php
			//display product description in frontend
			echo '<p>'.$details['productDescription'].'</p>';
						?>


			<div class="product_review_title">Product Review</div>
			<ul class="reviews" style="list-style: none;">



<?php

//prepare query and execute it to display review of related product
//display the verified reviews only
$stmt = $pdo->prepare('SELECT * FROM tbl_review WHERE product_code = :product_code AND verified = "YES" ORDER BY review_id DESC');
	$criteria = [
		'product_code' => $_GET['product_code']
	];
	$stmt->execute($criteria);

	//using for loop to limit no. of review in frontend
	for($i = 0;$i <5 ;$i++){
		$review = $stmt->fetch();

?>
<!-- 				display the review, reviewer and review date in the product page  -->
				<li>
					<?php echo '<p>'.$review['review'].'</p>'?>

					<div class="details">
						<?php echo '<a href="allreview.php?reviewer='.$review['reviewer'].'"><strong>'.$review['reviewer'].'</strong></a>'?>
						<?php echo '<em>'.$review['review_date'].'</em>'?>
					</div>
				</li>
		
<?php

}

?>
</ul>


<form action="" method="POST" >
	<label class="social">Add Review:</label>
	<textarea name="review" style="width: 95%"></textarea>
<!-- if user if logged in then   -->

	<input class="review" type="submit" name="submitreview" value="Submit">
 </form>


</main>

<div class="similar_product">
	<div>
<!-- 		add categories.php to display similar product -->	
	<?php require 'categories.php';?>
	</div>	
</div>
</div>

<?php
// add footer.php section
require 'footer.php'; 
?>
	</body>

</html>
