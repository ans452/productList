<?php


class ViewingController extends Controller{

	
	// public function __construct($product_file = "data/products.json", $category_file = "data/categories.json"){
	// 	$this->request = $_GET;
	// 	$this->category_list = new JsonCategoryList($category_file);
	// 	$this->product_list = new JsonProductList($product_file);
	
	// }

	
	public function get_product_list(){
		if($this->category_id != null){
			return $this->product_list->get_by_category_id($this->category_id);
		}
		return $this->product_list->get_list();
	}

	public function get_category_list(){
		return $this->category_list->get_list();
	}

	public function is_error(){
		return $this->get_status_by_category_id_request() == NOT_FOUND;
	}

	public function get_heading(){
		if($this->get_status_by_category_id_request() == NO_REQUESTS) return "All Categories";
		else { 
			$category = $this->category_list->get_element_by_id($this->category_id);
			return $category->name;
		}
	}

	public function is_current_category($id){
		return $id == $this->category_id;
	}

	public function get_category_by_category_id($category_id){
		return $this->category_list->get_element_by_id($category_id);
	}

	public function get_requested_category_id(){
		if(!empty($this->category_id))
			return $this->category_id;
	}

}

?>