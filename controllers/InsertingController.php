<?php

class InsertingController extends Controller{

	private $category_name;
	private $product_name;
	public $errors = array();


	public function __construct($product_file = "data/products.json", $category_file = "data/categories.json"){
	$this->category_list = new JsonCategoryList($category_file);
	$this->product_list = new JsonProductList($product_file);
	if(!empty($_POST['category_id']) && is_numeric($_POST['category_id'])) $this->category_id = $_POST['category_id'];
	if(!empty($_POST['product_name'])) $this->product_name = $_POST['product_name'];
	if(!empty($_POST['category_name'])) $this->category_name = $_POST['category_name']; 
	
	}

	public function create_product(){
		if(empty($this->product_name))
			$this->errors[] = "Empty product name input";
		if(!$this->is_valid_category_id())
			$this->errors[] = "Do not try to hack me :(";
		if(!$this->errors) 
			$this->product_list->add_product($this->product_name, $this->category_id);
	}

	public function create_category(){
		if(empty($this->category_name))
			$this->errors[] = "Empty category name";
		if(!$this->is_unique_category_name())
			$this->errors[] = "This category already exists";
		if(empty($this->errors))	
				$this->category_list->add_category($this->category_name);
	}
	private function is_valid_category_id(){
		return $this->category_list->id_exists($this->category_id);
	}

	private function is_unique_category_name(){
		return !$this->category_list->name_exists($this->category_name);
	}
		

	
}


?>