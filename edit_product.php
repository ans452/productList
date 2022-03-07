<?php

include 'controllers/Controller.php';



	$viewingController = new ViewingController();
	$categories = $viewingController->get_category_list();
	if(empty($_GET['product_id']) || !$categories || empty($_GET['category_id'])) header("Location: index.php");
	else {
		$errors;
		$editor = new EditingController();
		if(!$editor->is_valid_category_id() || !$editor->is_valid_product_id()) header("Location: index.php");
		if($_POST){
			// var_dump($_POST);
			$editor->edit_product();
			$errors = $editor->errors;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css">
	<title>Edit Product</title>
</head>
<body>
<?php if(!empty($errors)){ ?>
	<div id= "message">
		<?php foreach($errors as $error){
		echo "<p>".$error."</p>"; } ?>
	</div>
	<?php } elseif($_POST) {?>
		<div id = "message"><p>Successful</p></div>
		
		<?php } ?>
	
	<form id = "create" action="edit_product.php?category_id=<?php echo $_GET['category_id']?>&product_id=<?php echo $_GET['product_id']; ?>" method="POST"  enctype="multipart/form-data">
		<h1>Edit Product</h1>
		<label for="name">Name of product*: </label>
		<input name="product_name" id="name" type="text" value="<?php echo $editor->get_product_by_id($_GET['product_id'])->name; ?>"><br>
		<br>
		<label for="image">Select image to upload: </label>
		<input type="file" name= "image" id="image">
		<br>
		<label for="categories">Choose category*: </label>
		<select name="category_id" id="categories">
			<?php foreach($categories as $category){ ?>
			<option <?php if($_GET['category_id'] == $category->id) echo "selected"; ?> value="<?php echo $category->id; ?>">
				<?php echo $category->name; ?>			
			</option>
			<?php } ?>
		</select>
		<br>
		<label for="description">Description:</label>
		<textarea name="description" id="description" cols="50" rows="5"><?php echo $editor->get_product_by_id($_GET['product_id'])-> description;?></textarea>
		<br>
		<input type="submit" value="Submit" name="submit">
	</form>
		<a href="index.php">To the main page...</a>
</body>
</html>

<?php } ?>