<?php

if(!empty($_GET) && isset($_GET['category_id'])){
	
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css">
	<title>Main page</title>
</head>
<body>

	<h1>All products</h1>
	<table id="productTable">
		<tr>
			<th>
				Category name
			</th>
			<th>
				Product name
			</th>
		</tr>
		<tr>
			<td>
				Category name
			</td>
			<td>
				Product name
				<div class = "buttons">
					<a href="#">Edit</a>
					<a href="#">Remove</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				Category name
			</td>
			<td>
				Product name
				<div class = "buttons">
					<a href="#">Edit</a>
					<a href="#">Remove</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				Category name
			</td>
			<td>
				Product name
				<div class = "buttons">
					<a href="#">Edit</a>
					<a href="#">Remove</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				Category name
			</td>
			<td>
				Product name
				<div class = "buttons">
					<a href="#">Edit</a>
					<a href="#">Remove</a>
				</div>
			</td>
		</tr>
	</table>

<!-- For viewing categories -->
<div class="right">
<ul class="category-menu">
  <li><a href="#home">Home</a></li>
  <li><a  class= "current" href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>
</div>

</body>
</html>