<?php 

class RemovingController extends Controller{

	

	public function delete_product(){
			if($this->product_id != null)
				return $this->product_list->delete_product($this->product_id);
			return false;
	}

	public function delete_products_by_category_id(){
		$list_to_delete =($this->category_id != null ? $this->product_list->get_by_category_id($this->category_id) : $this->product_list->get_list());
		foreach($list_to_delete as $product){
			$this->product_list->delete_product($product->id);
		}
	}
	
	public function delete_category_with_products(){
		$this-> delete_products_by_category_id();
		$this->category_list->delete_category($this->category_id);	}
}



?>