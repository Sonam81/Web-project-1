
	<body>
		<?php 
		//get header
			require 'header.php';
		?>
<div class="div_of_homepage">

<div class="bannerFirst">
	<!-- <div class="bannerOne"><img class="img1" src="images/samsungbanner.jpg">
	</div> -->
</div>


<main class="main_homepage">
<?php
//get main_product file
		require 'main_product.php';

?>

</main>
		<aside>
				<span class="hot_deals">HOT DEALS</span>
			<?php
			//get hotdeal file
			 require 'hotdeals.php';?>

		</aside>


</div>
<?php 
//get footer
	require 'footer.php';
?>

	</body>

</html>
