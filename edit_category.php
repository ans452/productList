<?php

include 'controllers/Controller.php';


	if(empty($_GET['category_id'])) header("Location: index.php");
	else {
		$errors;
		$editor = new EditingController();
		if(!$editor->is_valid_category_id()) header("Location: index.php");
		if($_POST){
		
			$editor->edit_category();
			$errors = $editor->errors;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css">
	<title>Edit Category</title>
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
	
	<form id = "create" action="edit_category.php?category_id=<?php echo $_GET['category_id'] ?>" method="POST">
		<h1>Edit Category</h1>
		<label for="name">Name of Category: </label>
		<input name="category_name" id="name" type="text" value="<?php echo $editor->get_category_by_category_id($_GET['category_id'])->name; ?>"><br>
		<br>
		<input type="submit" value="Submit" name="submit">
	</form>
		<a href="index.php">To the main page...</a>
</body>
</html>

<?php } ?>