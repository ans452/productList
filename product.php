<?php 

include 'controllers/Controller.php';


$viewer = new ViewingController();
$product = $viewer->get_product_by_id($_GET['product_id']);
if(empty($_GET['product_id']) || !$product) header("Location: index.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<a href="index.php">Main page...</a>
	<center>
		<h1><?php echo $product->name ?></h1>
		<h3><?php  echo $viewer->get_category_by_category_id($product->category_id)->name; ?></h3>
		<img src="<?php echo $product->image_path; ?>" alt="">
		<p style="width: 90%; text-align:left; font-size:2rem;"><?php echo $product->description; ?></p>
</center>	
</body>
</html>