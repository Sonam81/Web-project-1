<?php
//connect to database named csy2028-assignment
$pdo = new PDO('mysql:dbname=csy2028-assignment;host=localhost', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	//if delete_id is set using GET method then
	if(isset($_GET['delete_id'])){
		//prepare the query to delete review
		$deletestmt = $pdo->prepare('DELETE FROM tbl_review WHERE review_id = :review_id');
		$deleteCriteria = [
			//here review_id is set using GET method
			'review_id' => $_GET['delete_id']
		];
		//execute the prepared query
		if($deletestmt->execute($deleteCriteria)){
			//display link to go back to verifyReview page
			echo '<a href = '.$_GET['redirect'].'>Click to go back</a>';
		}
	}	

	//if verify id is set using GET method
	if(isset($_GET['verify_id'])){
		//prepare update query that sets value of verified to YES
		$verifystmt = $pdo->prepare("UPDATE tbl_review SET verified = 'YES' WHERE review_id = :review_id");
		$verifyCriteria = [
			//here review_id is set using GET method
			'review_id' => $_GET['verify_id']
		];
		//execute the update query
		if($verifystmt->execute($verifyCriteria)){
			//display link to go back to verifyReview page
			echo '<a href = '.$_GET['redirect'].'>Click to go back</a>';
		}
		else{
			echo '<a href = '.$_GET['redirect'].'>Click to go back failed</a>';
 
		}
	}
?>