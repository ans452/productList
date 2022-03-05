<?php

include 'controllers/Controller.php';


$viewingController = new ViewingController();
$categories = $viewingController->get_category_list();

if(!$categories) header("Location: index.php");
else { 
	$errors;
	if($_POST){
		$inserter = new InsertingController();
		$inserter->create_product();
		$errors = $inserter->errors;
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css">
	<title>Create Product</title>
</head>
<body>
<?php if(!empty($errors) && $_POST){ ?>
	<div id= "message">
		<?php foreach($errors as $error){
		echo "<p>".$error."</p>"; } ?>
	</div>
	<?php } elseif($_POST) {?>
		<div id = "message"><p>Successful</p></div>
		
		<?php } ?>
	<form id = "create"action="create_product.php" method="POST" enctype="multipart/form-data">
		<h1>Create Product</h1>
		<label for="name">Name of product: </label>
		<input name="product_name" id="name" type="text"><br>
		<label for="image">Select image to upload: </label>
		<input type="file" name= "image" id="image"><br>
		<label for="categories">Choose category: </label>
		<select name="category_id" id="categories">
			<?php foreach($categories as $category){ ?>
			<option value="<?php echo $category->id; ?>">
					<?php echo $category->name; ?>			
			</option>
			<?php } ?>
		</select>
		<br>
		<input type="submit" value="Submit" name="submit">
	</form>
		<a href="index.php">To the main page...</a>
</body>
</html>

<?php } ?>