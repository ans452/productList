<?php


// per page: 5
// amount of elements 8
define("PRODUCTS_PER_PAGE", 5);


class ViewingController extends Controller{

	public function get_product_list(){
		$list = $this->get_product_list_by_category_id();
		$paginator = new Paginator((!empty($_GET['page']) ? $_GET['page'] : 1), PRODUCTS_PER_PAGE, sizeof($list));
		return $paginator->cut_array($list);
	}

	public function get_number_of_pages(){
		$paginator = $this->get_paginator();
		return $paginator->get_total_number_of_pages();
	}

	private function get_paginator(){
		$list = $this->get_product_list_by_category_id();
		$paginator = new Paginator((!empty($_GET['page']) ? $_GET['page'] : 1), PRODUCTS_PER_PAGE, sizeof($list));
		return $paginator;
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

	private function get_product_list_by_category_id(){
		if($this->category_id != null){
			return $this->product_list->get_by_category_id($this->category_id);
		}
		return $this->product_list->get_list();
	}

}

?>