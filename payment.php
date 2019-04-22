
<?php
//connect to database named csy2028-assignment
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//if submit button is pressed	
if(isset($_POST['submit'])){
	//prepare the insert query
	$insertQuery = "INSERT INTO tbl_orders(user_id,order_date,first_name,last_name,phone,email,cost,shipping_cost,cost_tax,cost_total,shipping_address,shipping_city,shipping_state,shipping_zip_code) VALUES(:user_id,:order_date,:first_name,:last_name,:phone,:email,:cost,:shipping_cost,:cost_tax,:cost_total,:shipping_address,:shipping_city, :shipping_state, :shipping_zip_code)";
		//set the value of the elements
		$totalAmt = $_GET['cost'];
		$_POST['order_date'] = date('Y/m/d');
	  	$_POST['costShipping'] = ((10/100) * $totalAmt);
		$_POST['costTax'] = ((13/100) * $totalAmt);
		$insetCriteria = [
			'user_id' => $_GET['user_id'],
			'order_date' => $_POST['order_date'],
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'phone' => $_POST['phone'],
			'email' => $_POST['email'],
			'cost' => $_GET['cost'],
			'shipping_cost' => $_POST['costShipping'],
			'cost_tax' => $_POST['costTax'],
			'cost_total' => $_GET['grandTotal'],
			'shipping_address' => $_POST['shipping_address'],
			'shipping_city' => $_POST['shipping_city'],
			'shipping_state' => $_POST['shipping_state'],
			'shipping_zip_code' => $_POST['shipping_zip_code']
		];
	unset($_POST['submit']); 
	//prepare the query and execute it
	$insertStatement = $pdo->prepare($insertQuery);
	if($insertStatement->execute($insetCriteria)){
		//delete query to delete products from cart
		$removeStmt = $pdo->prepare("DELETE FROM tbl_temporary_cart WHERE user_id =:user_id");
		$removeCriteria = [
			'user_id' => $_GET['user_id'],
		];
		//execute the prepared query
		$removeStmt->execute($removeCriteria);
		header('Location:paypal.php');	


}
}
else{
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="original.css">
</head>
<body>
	<?php
	//adding header file
	 require 'header.php'?>

	<main class="payment_main">
	<form action="" method="POST">
		<label class="labelpay">First Name:</label>
		<input class="inputpay" type="text" name="first_name"><br>
	
		<label class="labelpay">Last Name:</label>
		<input class="inputpay" type="text" name="last_name"><br>
	
		<label class="labelpay">Phone No:</label>
		<input class="inputpay"  type="text" name="phone"><br>
	
		<label class="labelpay">City:</label>
		<input class="inputpay" type="text" name="city"><br>

		<label class="labelpay">State:</label>
		<input class="inputpay" type="text" name="state"><br>

		<label class="labelpay">Email Address:</label>
		<input class="inputpay" type="text" name="email"><br>
	
		<label class="labelpay">Shipping Address:</label>
		<input class="inputpay" type="text" name="shipping_address"><br>
	
		<label class="labelpay">Shipping City:</label>
		<input class="inputpay" type="text" name="shipping_city"><br>
		
		<label class="labelpay">Shipping State:</label>
		<input class="inputpay" type="text" name="shipping_state"><br>
	
		<label class="labelpay">Shipping Zip Code:</label>
		<input class="inputpay" type="text" name="shipping_zip_code">
		<input type="checkbox" name="checkbox1"> I have provided the valid information and will be responsible for 	any miskate informations.<br>
  		<label>Pay With:</label>
  		<input class="paypal" type="submit" name="submit" value="Paypal">
<!-- 	<input class="submitpay" type="submit" name="submit" value="Proceed to Payment"> -->
</form>

<!-- <div class="buttonsPaypal"><p>Pay Using:</p>
	<button onclick=" location.href='https://www.sandbox.paypal.com/cgi-bin/webscr'" class="paypal"><i class="fab fa-paypal">Paypal</i></button>
</div> --> 
</main>
<?php 
	require 'footer.php';
?>
</body>
</html>
<?php } ?>
