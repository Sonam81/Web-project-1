<?php
session_start();
$redirect = $_SERVER['PHP_SELF'];
//csy2028-assignment is name of database
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);



if(isset($_SESSION['loggeduser']) == 1){
//prepare the query statement
	//fetch a set of data
	$fetchId = $pdo->prepare("SELECT user_id FROM table_users 
		WHERE username = :username");
	$criteria = [
		'username' => $_SESSION['loggedinuser']
	];
	$fetchId->execute($criteria);
	$fetchIdDetail = $fetchId->fetch();

	 $displayQuery = "SELECT productImages,productName,costAfter,quantity,user_id
	 		FROM product_details JOIN tbl_temporary_cart 
	 		ON product_details.product_code = tbl_temporary_cart.product_code
	 		WHERE tbl_temporary_cart.user_id = :user_id";
	 $displayCriteria = [
		'user_id' => $fetchIdDetail['user_id']
	 ]; 
	 $stmt = $pdo->prepare($displayQuery);
	 $stmt->execute($displayCriteria);
	 // $details = $stmt->fetch(); 

	 if(isset($_GET['delId'])){
		$del = $pdo->prepare("DELETE FROM tbl_temporary_cart WHERE product_code=:id");
		$criteria = [
			'id' => $_GET['delId']
		];
		if($del->execute($criteria)) echo '<h5>Product Deleted</h5>';
	 }

?>

	<body>
		<?php 
			require 'header.php';
		?>
		<div class="div_of_shoppingcart">
			<div class="shoppingcart_title">
				<label>Image</label>
    			<label>Product</label>
    			<label>Price</label>
    			<label>Quantity</label>
    			<label>Remove</label>
    			<label>Total</label>
			</div>

		<?php 
				$totalAmt = 0;

			foreach ($stmt as $row ) {
		?>
  		<div class="shoppingcart_product_details">
    		<div class="product-image">
					<?php
					 echo '<img class="productImages" src="'.$row['productImages'].'">';
					?>    		
			</div>
    		<div>
				<?php
					 echo '<a href="#" title="'.$row['productName'].'">'.$row['productName'].'</a>';?>
    		</div>
    		<div><?php
						 echo '<span>$'.$row['costAfter'].'</span>';
						?></div>
    		<div>
      			<?php
						 echo '<span>'.$row['quantity'].'</span>';
						?>
    		</div>
    		<div>
				<a href="shoppingcart.php?delId=<?php echo $row['product_code']?>;">
					Delete
				</a> 
    		</div>
    		<div><?php
						 echo '<span>$'.$row['costAfter'] * $row['quantity'] .'</span>';
			 			$totalAmt += ($row['costAfter'] * $row['quantity']);

						?></div>
  		</div>
  		<?php
  		}
  		echo '<div style="padding-left:47%">';
	  	echo '<p> Total Amount: $'.$totalAmt.'</p>';
	  	echo '<p> Shipping(10%): $'.(10/100) * $totalAmt.'</p>';
	  	$costAfterShipping = (10/100) * $totalAmt + $totalAmt;
	  	echo '<p> Tax.(13%): $'.(13/100) * $totalAmt.'</p>';
		$costAfterTax = (13/100) * $totalAmt + $costAfterShipping;
	  	echo '<p> Grand Total: $'.$costAfterTax.'</p>';
	  	echo '<a href="payment.php?user_id='.$fetchIdDetail['user_id'].'&cost='.$totalAmt.'&grandTotal='.$costAfterTax.'">Proceed to payment</a>';
		echo '</div>';
  		?>
		<?php 
			require 'footer.php';
		?>

	</body>
</html>
<?php
}
else{
	echo '<p>Your shopping cart is empty.Log in to add product to shoping cart.<a href="login_user.php?redirect='.$redirect.'&product_code='.$_POST['product_code'].'&quantity='.$_POST['quantity'].'">Login</a></p>';
}
?>