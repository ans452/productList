<?php

session_start();

include 'controllers/Controller.php';


if(!empty($_GET)){
	$remover = new RemovingController();
	$remover->delete_product();
	header("Location:index.php?category_id=".$_SESSION['category_id']);


}
else{
	header("Location: index.php");
} 




?>