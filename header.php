<!doctype html>
<html>
	<head>
		<title>Ed's Electronics</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="electronics.css" />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 	
	</head>
		<header>
			<h1 class="ed_electronics_title"><a href="index.php">Ed's Electronics</a></h1>
			<?php

			//search product
				if(isset($_POST['submit'])){
					header('Location:index.php?searchTerm='.$_POST['searchTerm']);
				}
			?>
			<form class="search" method="POST">
  				<input class="searchInput" type="text" name="searchTerm" placeholder="Search..">
				<input class="searchSubmit" type="submit" name="submit" value="SEARCH">	
				
		</form>

			<ul class="navRow">
				<li class="home"><a href="index.php">Home</a></li>
				<li class="categories">Products
					<ul>
					<?php 
					require 'categorieslist.php'; 
					?>
					</ul>
				</li>
				<li></li>
				<li class="contact">
			<?php
			//if user is logged in display logout else display login/register
			if(isset($_SESSION['loggeduser']) == 1){
			?>
			<p><a href="logout_user.php">Logout</a></p>

			<?php }
				else{
			?>
<!-- 			register user
 -->			<p><a href="login_user.php">Login</a>||<a href="createAccount.php">Register</a></p>
			<?php
		}
		?>	</li>
			</ul>


		</header>