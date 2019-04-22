<?php
//get directory of the file
$redirect = $_SERVER['PHP_SELF'];

//add adminheader.php file
require 'adminheader.php';
session_start();
if(isset($_SESSION['logged']) == 1){

//connect to the database named csy2038-assignment, username - root password - null
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//prepare the query to select all reviews that are not verified
//and execute the statement
$stmt = $pdo->prepare('SELECT * FROM tbl_review WHERE verified != "YES"');
$stmt->execute();

//prepare form to display the reviews
//using POST method
echo '<div>';
echo '<form action="verifyReview.php?" method="POST">';

//foreach loop to display datas
foreach ($stmt as $review){
	//prepare query to get details of products
	//and execute them
	$stmtProductDetails = $pdo->prepare('SELECT * FROM product_details WHERE product_code = :product_code');
		$criteria = [
			'product_code' => $review['product_code']
		];
	$stmtProductDetails->execute($criteria);
	$verify_id = $review['review_id'];
	$delete_id = $review['review_id'];

//foreach loop to display the datas
foreach ($stmtProductDetails as $data){

?>
			<ul style="padding: 0 0 2% 5%; list-style: none;width: 50%;  margin-left: 25%;border: 1px solid">
<!-- 				displaying all data of product in the form  -->
				<li>
					<div class="details">
						<?php echo '<p>Product Id :'.$review['product_code'].'</p>';?>
						<?php echo '<p>Product Name :'.$data['productName'].'</p>';?>
						<?php echo '<img style= "height:500px;width:500px;" src='.$data['productImages'].'>';?>
						<?php echo '<p>Review:'.$review['review'].'</p>'?>
						<?php echo '<strong>Review By: '.$review['reviewer'].'</strong>'?>
						<?php echo '<p> Date of Review: '.$review['review_date'].'</p>'?>
					</div>
				</li>
<!-- 				if verify review is pressed redirect to verify_delete_review.php with verify_id -->						<li style="width: 80%"><a href="<?php echo 'verify_delete_review.php?verify_id='.$verify_id.'				&redirect='.$redirect?>"><p class="buy">VERIFY REVIEW</p></a></li>				
<!-- 				if verify review is pressed redirect to verify_delete_review.php with verify_id -->
				<li style="width: 80%"><a href="<?php echo 'verify_delete_review.php?delete_id='.$delete_id.'&redirect='.$redirect?>"><p class="buy">DELETE REVIEW</p></a></li>
			</ul>

<?php
}

}

	
?>
<?php
//add footer.php file
require 'footer.php';
}
else{
	header('Location:login.php?redirect='.$redirect);
}
?>
