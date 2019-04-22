<?php

require 'header.php';
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//prepare query and execute it to display review of related users
//display the verified reviews only
$stmt = $pdo->prepare('SELECT * FROM tbl_review WHERE reviewer = :reviewer ORDER BY review_id DESC');
$selectCriteria = [
	'reviewer' => $_GET['reviewer']
];

$stmt->execute($selectCriteria);

echo '<div>';
echo '<form action="" method="POST">';

//foreach loop to display datas
foreach ($stmt as $review){
	//prepare query to get details of products
	//and execute them
	$stmtProductDetails = $pdo->prepare('SELECT * FROM product_details WHERE product_code = :product_code');
		$criteria = [
			'product_code' => $review['product_code']
		];
	$stmtProductDetails->execute($criteria);
//foreach loop to display the datas
foreach ($stmtProductDetails as $data){

?>
			<ul style="padding: 0 0 2% 5%; list-style: none;width: 50%;  margin-left: 25%;border: 1px solid">
<!-- 				displaying all data of product in the form  -->
				<li>
					<div class="details">
						<?php echo '<p>Product Name :'.$data['productName'].'</p>';?>
						<?php echo '<img style= "height:500px;width:500px;" src='.$data['productImages'].'>';?>
						<?php echo '<p>Review:'.$review['review'].'</p>'?>
						<?php echo '<strong>Review By: '.$review['reviewer'].'</strong>'?>
						<?php echo '<p> Date of Review: '.$review['review_date'].'</p>'?>
					</div>
				</li>
			</ul>

<?php
}

}

	
?>
<?php
//add footer.php file
require 'footer.php';
?>


