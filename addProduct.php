<?php
//add header file
require 'adminheader.php';
//connect to database
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//start session
session_start();
//get file directory
$redirect = $_SERVER['PHP_SELF'];

//check if user is logged in
if(isset($_SESSION['logged']) == 1){

//if submit is pressed
if(isset($_POST['submit'])){
	//prepare select statement
	//execute the statement
	$users = $pdo ->prepare("SELECT id FROM tbl_user");
	$users ->execute();

	//get datas from POST form
	extract($_POST);

	//INSERTING product details into table named product_details
	//prepare the statement and execute it
	$sql = "INSERT INTO product_details(categorie_id,productImages, productName,productDescription, costAfter,costBefore) VALUES (:categorie_id, :productImages, :productName, :productDescription, :costAfter, :costBefore)";
	$stmt = $pdo->prepare($sql);
	//unset submit
	unset($_POST['submit']);

	if($stmt->execute($_POST))
		 echo '<p>Inserted Successfully</p>';
	else echo '<h5>Not Inserted</h5>';

}

?>

<form style="padding-top: 5%" action="addProduct.php" method="POST">
	<label class="labelpay">Select Product Images:</label>
	<input class="inputpay" type="file" name="productImages"><br>
	<label class="labelpay">Enter product name: </label>
	<input class="inputpay" type="text" name="productName"><br>
	<label class="labelpay">Product Details:</label>
	<textarea class="inputpay" name="productDescription"> </textarea><br>
 	<label class="labelpay">Category_id:</label> 
 	<select name="categorie_id" class="inputpay">
 		<?php
		$selectQuery = $pdo->prepare('SELECT * FROM tbl_categories');
		$selectQuery->execute();
		foreach ($selectQuery as $selected) {
			//append datas from database to html element
			echo '<option>'.$selected['categorie_id'].'-'.$selected['categorie_name'].'</option>';
		}
		?>


	echo '<li><a href="getcategories.php?categorie_id='.$selected['categorie_id'].'">'.$selected['categorie_name'].'</a></li>';
}
	</select><br>
 	<label class="labelpay">Cost After Discount:</label>
 	<input class="inputpay" type="text" name="costAfter"><br>
	<label class="labelpay">Cost Before:</label>
	<input class="inputpay" type="text" name="costBefore"><br><br>
	<input class="review" type="submit" name="submit" value="Add Product">
</form>
<?php
 echo 'You are logged in as ' . $_SESSION['loggedin'] ;?>

<?php
}
else{
	//redirect to login
	header('Location:login.php?redirect='.$redirect);
}

?>