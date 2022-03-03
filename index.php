<?php

include 'controllers/Controller.php';

session_start();

$viewingController = new ViewingController();
$products = $viewingController->get_product_list();
$categories = $viewingController->get_category_list();
if($viewingController->is_error()) header("Location: notfound.php");

$_SESSION['category_id'] = $viewingController->get_requested_category_id();

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css">
	<title>Main page</title>
</head>
<body>


	<h1><?php echo $viewingController->get_heading();?></h1>
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

		<?php foreach($products as $product){  ?>
			<td>
				<?php echo $viewingController->get_category_by_category_id($product->category_id)->name; ?>
			</td>
			<td>
				<?php echo $product->name; ?>
				<div class = "buttons">
					<a href="edit.php?category_id=<?php echo $product->category_id;?>&product_id=<?php echo $product->id;?>">Edit</a>
					<a href="delete.php?category_id=<?php echo $product->category_id;?>&product_id=<?php echo $product->id;?>">Remove</a>
				</div>
			</td>
		</tr>
		<?php } ?>
	</table>

<!-- For viewing categories -->
<div class="right">
<ul class="category-menu">
<?php foreach($categories as $category){  ?>
  <li><a <?php if($viewingController->is_current_category($category->id)) echo "class=\"current\""; ?> href="index.php?category_id=<?php echo $category->id; ?>"><?php echo $category->name ?></a></li>
  <?php } ?>
</ul>
</div>

</body>
</html>