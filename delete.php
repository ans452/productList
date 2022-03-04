<?php

session_start();

include 'controllers/Controller.php';
$remover = new RemovingController();


if(!empty($_GET['product_id'])){
	$remover->delete_product();
}
else if(!empty($_GET['products'])){
		$remover->delete_products_by_category_id();
}
else if(!empty($_GET['categories'])){
	$remover->delete_category_with_products();
	unset($_SESSION['category_id']);
}

header("Location:index.php?category_id=".(!empty($_SESSION['category_id'])? $_SESSION['category_id'] : ""));


?>