<?php

include 'controllers/Controller.php';

session_start();



// $list = new JsonProductList('data/products.json');
// $catlist = new JsonCategoryList('data/categories.json');
// $catlist->add_category('Humans');
// $catlist->add_category('Oppa');
// $catlist->add_category('Privet');
// $catlist->add_category('Astalavista');
// $catlist->add_category('Animals');
// $catlist->add_category('Music');
// $catlist->add_category('HipHip');
// $catlist->add_category('Tarada');
// $catlist->add_category('Loool');


// $list->add_product("Andres", "2");
// $list->add_product("Andres", "2");

// $list->add_product("Andres", "2");
// $list->add_product("A", "2");
// $list->add_product("A", "3");

// $list->add_product("A", "2");

// $list->add_product("A", "3");

// $list->add_product("A", "1");
// $list->add_product("Andres", "2");
// $list->add_product("Andres", "2");

// $list->add_product("Andres", "2");
// $list->add_product("A", "2");
// $list->add_product("A", "3");

// $list->add_product("A", "2");

// $list->add_product("A", "3");

// $list->add_product("A", "1");
// $list->add_product("Andres", "2");
// $list->add_product("Andres", "2");

// $list->add_product("Andres", "2");
// $list->add_product("A", "2");
// $list->add_product("A", "3");

// $list->add_product("A", "2");

// $list->add_product("A", "3");

// $list->add_product("A", "1");
// $list->add_product("Andres", "2");
// $list->add_product("Andres", "2");

// $list->add_product("Andres", "2");
// $list->add_product("A", "2");
// $list->add_product("A", "3");

// $list->add_product("A", "2");

// $list->add_product("A", "3");

// $list->add_product("A", "1");
// $list->add_product("Andres", "2");
// $list->add_product("Andres", "2");

// $list->add_product("Andres", "2");
// $list->add_product("A", "2");
// $list->add_product("A", "3");

// $list->add_product("A", "2");

// $list->add_product("A", "3");

// $list->add_product("A", "1");


$viewingController = new ViewingController();
if($viewingController->is_error()) header("Location: notfound.php");
// var_dump($_GET);
$products = $viewingController->get_product_list();
$categories = $viewingController->get_category_list();
$_SESSION['category_id'] = $_GET['category_id'];



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
	<!-- For viewing categories -->
<nav class="category-menu">
	<a <?php if(empty($_GET['category_id'])) echo "class=\"current\""; ?> href="index.php">All Categories</a>
<?php foreach($categories as $category){  ?>
<a  class="<?php if($viewingController->is_current_category($category->id)) echo "current"; ?>" href="index.php?category_id=<?php echo $category->id; ?>"><?php echo $category->name ?></a>
  <?php } ?>
</nav>


<?php if(!empty($products)){ ?>
<a href="delete.php?category_id=<?php echo $_GET['category_id'];?>&products=true">Remove all products in <?php echo $viewingController->get_heading(); ?></a>
<?php }?>
<br>
<?php if(!empty($_GET['category_id'])){  ?>
<a href="delete.php?category_id=<?php echo $_GET['category_id']; ?>&categories=true">Delete <?php echo $viewingController->get_heading(); ?> category</a>
<?php } ?>
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

		<?php if(!empty($products)){foreach($products as $product){  ?>
			<td>
				<?php echo $viewingController->get_category_by_category_id($product->category_id)->name; ?>
			</td>
			<td>
				<?php echo $product->name; ?>
				<div class = "buttons">
					<a href="edit.php?category_id=<?php echo $product->category_id;?>&product_id=<?php echo $product->id;?>">Edit</a>
					<a href="delete.php?product_id=<?php echo $product->id;?>">Remove</a>
				</div>
			</td>
		</tr>
		<?php } }else echo "Empty :("?>
	</table>

	<div class="paginator">
		<nav>
			<a href="">1</a>
			<a href="">2</a>
			<a href="">3</a>
		</nav>
	</div>

</body>
</html>