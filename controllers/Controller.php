<?php


include 'classes/JsonList.php';
include "utils/Paginator.php";
include "utils/ImgDownloader.php";

define("NOT_FOUND", -1);
define("NO_REQUESTS", 0);
define("REQUEST", 1);


class Controller{

	protected $product_id;
	protected $category_id;
	protected JsonCategoryList $category_list;
	protected JsonProductList $product_list;
	

	public function __construct($product_file = "data/products.json", $category_file = "data/categories.json"){
		$this->category_list = new JsonCategoryList($category_file);
		$this->product_list = new JsonProductList($product_file);
		if(!empty($_GET['category_id']) && is_numeric($_GET['category_id'])) $this->category_id = $_GET['category_id'];
		if(!empty($_GET['product_id']) && is_numeric($_GET['product_id'])) $this->product_id = $_GET['product_id'];

	}

	protected function get_status_by_category_id_request(){
		if(empty($this->category_id)) return NO_REQUESTS;
		if($this->category_list->id_exists($this->category_id)) return REQUEST;
		else return NOT_FOUND;
	}

	protected function get_status_by_product_id_request(){
		if(empty($this->product_id)) return NO_REQUESTS;
		if($this->product_list->id_exists($this->request['product_id'])) return REQUEST;
		else return NOT_FOUND;
	}

	public function get_category_by_category_id($category_id){
		return $this->category_list->get_element_by_id($category_id);
	}

	public function get_category_list(){
		return $this->category_list->get_list();
	}

	public function is_current_category($id){
		return $id == $this->category_id;
	}


	public function get_requested_category_id(){
		if(!empty($this->category_id))
			return $this->category_id;
	}

	public function get_product_by_id($id){
		
		return $this->product_list->get_element_by_id($id);
			
		
	}


	
}


include 'ViewingController.php';
include 'RemovingController.php';
include 'InsertingController.php';
include 'EditingController.php';
?>