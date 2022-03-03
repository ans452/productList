<?php 

class RemovingController extends Controller{

	

	public function delete_product(){
			if($this->product_id != null)
				return $this->product_list->delete_product($this->product_id);
			return false;
	}


	
}

?>