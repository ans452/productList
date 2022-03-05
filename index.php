<?php

include 'controllers/Controller.php';

session_start();



// $list = new JsonProductList('data/products.json');
// $catlist = new JsonCategoryList('data/categories.json');
// $catlist->add_category('Technology');
// $catlist->add_category('Clothes');
// $catlist->add_category('Games');


// $list->add_product("1", "1");
// $list->add_product("2", "1");

// $list->add_product("3", "2");
// $list->add_product("4", "2");
// $list->add_product("5", "3");

// $list->add_product("6", "3");

// $list->add_product("7", "3");

$viewingController = new ViewingController();
if($viewingController->is_error()) header("Location: notfound.php");
// var_dump($_GET);
$products = $viewingController->get_product_list();
$categories = $viewingController->get_category_list();

$category_id = !empty($_GET['category_id']) ? $_GET['category_id'] : "";
$page = !empty($_GET['page']) ? $_GET['page'] : "";

if(!empty($_GET['category_id']))
	$_SESSION['category_id'] = $_GET['category_id'];
if(!empty($_GET['category_id'])) 
	$_SESSION['page'] = $_GET['page'];
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
	<a <?php if(!$category_id) echo "class=\"current\""; ?> href="index.php">All Categories</a>
<?php foreach($categories as $category){  ?>
<a  class="<?php if($category_id == $category->id) echo "current"; ?>" href="index.php?category_id=<?php echo $category->id; ?>"><?php echo $category->name ?></a>
  <?php } ?>
</nav>
<?php if(!$products){}else{ ?>
	<table id="productTable">
		<tr>
			<th>
				Category name
			</th>
			<th>
				Image
			</th>
			<th>
				Description
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
			<td class="img">
				<img src="<?php echo $product->image_path;?>" alt="No image">
			</td>
			<td>
				<p>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, se</p>
			</td>
			<td>
				<?php echo $product->name; ?>
				<div class = "buttons">
					<a href="edit_product.php?category_id=<?php echo $product->category_id;?>&product_id=<?php echo $product->id;?>">Edit</a>
					<a href="delete.php?product_id=<?php echo $product->id;?>">Remove</a>
				</div>
			</td>
		</tr>
		<?php }?>
	</table>
	<?php  } }?>

	<nav class="removingSection">
	<?php if(!empty($products)){ ?>
	
		<a href="delete.php?category_id=<?php echo $category_id;?>&products=true">Delete all products in <?php echo $viewingController->get_heading(); ?></a>
		<?php }?>
	
		<?php if($category_id){  ?>
		<a href="delete.php?category_id=<?php echo $category_id; ?>&categories=true">Delete <?php echo $viewingController->get_heading(); ?> category</a>
<?php } ?>
	</nav>


	<nav class = "edit">
		<?php if($categories){ ?>
		<a href="create_product.php">Create new product</a>
		<?php } ?>
		<a href="create_category.php">Create new category</a>
		<?php if($category_id){ ?>
		<a href="edit_category.php?category_id=<?php echo $category_id; ?>">Edit category</a>
		<?php } ?>
	</nav>

	<?php if(!empty($products)){ ?>

	<div class="paginator">
		<nav>
			<?php $counter = $viewingController->get_number_of_pages();
			for($i = 0; $i < $counter; $i++){
			?>
			<a href="index.php?category_id=<?php echo $category_id; ?>&page=<?php echo $i+1; ?>"><?php echo $i+1; ?></a>
			<?php } ?>
		</nav>
	</div>
	<?php } ?> 


</body>
</html>