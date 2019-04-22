<?php
//add header file
require 'adminheader.php';

//connect to db
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//select the datas
$stmt = $pdo->prepare("SELECT product_code,productImages,productName,categorie_id,productDescription,costAfter,costBefore FROM product_details WHERE product_code = :id");

	$criteria = [ 'id' => $_GET['editId'] ];
	$stmt->execute($criteria);
	$details = $stmt->fetch();
	if(isset($_POST['update'])){
		//update the datas
		$update = $pdo->prepare("UPDATE product_details 
								SET 
									productImages = :productImages,
									productName = :productName,
									categorie_id = :categorie_id,
									productDescription = :productDescription,
									costAfter = :costAfter,
									costBefore = :costBefore
								WHERE 
									product_code = :id");
		unset($_POST['update']);
		if($update->execute($_POST)){
			echo "stmt executed";
		}
	}
	



?>

<form style="padding-top: 5%" action="" method="POST">
	<input type="hidden" name="id" value="<?php echo $_GET['editId'];?>">
	<label class="labelpay">Select Product Images:</label>
	<input class="inputpay" type="text" name="productImages" value="<?php echo $details['productImages']?>"><br>
	<label class="labelpay">Enter product name: </label>
	<input class="inputpay" type="text" name="productName" value="<?php echo $details['productName']?>"><br>
	<label class="labelpay">Product Details:</label>
	<textarea class="inputpay" name="productDescription"><?php echo $details['productDescription']?> </textarea><br>
 	<label class="labelpay">Category_id:</label> 
 	<select name="categorie_id" class="inputpay">
 		<?php
		$selectQuery = $pdo->prepare('SELECT * FROM tbl_categories');
		$selectQuery->execute();
		foreach ($selectQuery as $selected) {
			echo '<option>'.$selected['categorie_id'].'-'.$selected['categorie_name'].'</option>';
		}
		?>
	</select>
 	<label class="labelpay">Cost After Discount:</label>
 	<input class="inputpay" type="text" name="costAfter" value="<?php echo $details['costAfter']?>"><br>
	<label class="labelpay">Cost Before:</label>
	<input class="inputpay" type="text" name="costBefore" value="<?php echo $details['costBefore']?>"><br><br>
	<input class="review" type="submit" name="update" value="Update">
</form>

