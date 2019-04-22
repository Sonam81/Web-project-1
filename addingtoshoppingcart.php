
<?php
//start a new session
session_start();
//connect to the database named csy2038-assignment, username - root password - null
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//if product_code is set using GET method assign it to a new variable
if(isset($_GET['product_code']))
	$pcode = $_GET['product_code'];
//else if  product_code is set using POST method assign it to a new variable
else if(isset($_POST['product_code']))
	$pcode = $_POST['product_code'];

//if quantity is set using GET method assign it to a new variable
if(isset($_GET['quantity']))
	$qty = $_GET['quantity'];
//else if quantity is set using POST method assign it to a new variable
else if(isset($_POST['quantity']))
	$qty = $_POST['quantity'];

//check to see if the user is logged in 
//if user is logged in then
if(isset($_SESSION['loggeduser']) == 1){
	//write query to select datas
	$userSelect = "SELECT user_id FROM table_users";
	//prepare the query 
	$userSelectStatement = $pdo->prepare($userSelect);
	//execute the prepare statement
	$userSelectStatement->execute($_POST);
	//fetch a set of data
	$userSelectDetails = $userSelectStatement->fetch(); 

	//query to select the user_id from table_users
	$fetchId = $pdo->prepare("SELECT user_id FROM table_users 
		WHERE username = :username");
	$criteria = [
		'username' => $_SESSION['loggedinuser']
	];
	//execute the prepared query
	$fetchId->execute($criteria);
	//fetch a set of data
	$fetchIdDetail = $fetchId->fetch();

	//query to insert data into tbl_temporary_cart
	$sql = "INSERT INTO tbl_temporary_cart(user_id,product_code, quantity) VALUES (:user_id, :product_code, :quantity)";
	//setting value of left side element to values of right side element
	$sqlcriteria = [
		'user_id' => $fetchIdDetail['user_id'],
		'product_code' => $pcode,
		'quantity' => $qty
	];
	//prepare the insert query and execute it
	$stmt = $pdo->prepare($sql);
	$stmt->execute($sqlcriteria);

	//redirect to shoppincart.php
	header('Location:shoppingcart.php');

}
//if user is not logged in, redirect to login page
else{
	echo '<p>Your shopping cart is empty.Log in to add product to shoping cart.<a href="login_user.php?product_code='.$_POST['product_code'].'&quantity='.$_POST['quantity'].'">Login</a></p>';}
?>
<form method="POST">
<input type="hidden" name="user_id">
</form>

