<?php

include 'controllers/Controller.php';
	$errors;
	if($_POST){
		// echo "yes";
	
		$inserter = new InsertingController();
		$inserter->create_category();
		$errors = $inserter->errors;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css">
	<title>Create Category</title>
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
	
	<form id = "create" action="create_category.php" method="POST">
		<h1>Create Category</h1>
		<label for="name">Name of Category: </label>
		<input name="category_name" id="name" type="text"><br>
		<br>
		<input type="submit" value="Submit" name="submit">
	</form>
		<a href="index.php">To the main page...</a>
</body>
</html>