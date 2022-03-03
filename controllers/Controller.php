<?php


include 'classes/JsonList.php';

define("NOT_FOUND", -1);
define("NO_REQUESTS", 0);
define("REQUEST", 1);


class Controller{

	protected $request;
	protected JsonCategoryList $category_list;
	protected JsonProductList $product_list;
	

	public function __construct($product_file = "data/products.json", $category_file = "data/categories.json"){
		$this->categories = new JsonCategoryList($category_file);
		$this->product_list = new JsonProductList($product_file);
	}

	protected function get_status_by_category_id_request(){
		if(empty($this->request['category_id'])) return NO_REQUESTS;
		if($this->category_list->id_exists($this->request['category_id'])) return REQUEST;
		else return NOT_FOUND;
	}

	protected function get_status_by_product_id_request(){
		var_dump($this->request['product_id']);
		if(empty($this->request['product_id'])) return NO_REQUESTS;
		if($this->product_list->id_exists($this->request['product_id'])) return REQUEST;
		else return NOT_FOUND;
	}
}


include 'ViewingController.php';

?>