<?php

session_start();

include 'controllers/Controller.php';
$remover = new RemovingController();

$page = !empty($_SESSION['page']) ? $_SESSION['page'] : "";
$category_id = !empty($_SESSION['category_id']) ? $_SESSION['category_id'] : "";


if(!empty($_GET['product_id'])){
	$remover->delete_product();
}
else if(!empty($_GET['products'])){
		if(empty($_GET['category_id'])){
			unset($_SESSION['category_id']);
			$category_id = "";
			}
		$remover->delete_products_by_category_id();
		
	}
else if(!empty($_GET['categories'])){
	$remover->delete_category_with_products();
	$category_id = "";
	unset($_SESSION['category_id']);
}

// echo "Location: index.php?category_id=".$category_id."&page=".$page;
// return;
header("Location: index.php?category_id=".$category_id."&page=".$page);


?>