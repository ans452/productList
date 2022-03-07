<?php


class JsonProductList extends JsonList{

	public function add_product($product_name, $category_id, $image_path, $description){
		$result = new stdClass();
		$result->id = $this->get_id();
		$result->category_id = $category_id;
		$result->name = test_input($product_name);
		$result->image_path = $image_path;
		$result->description = test_input($description);
		array_push($this->list, $result);
		return $this->save();
	}

	public function delete_product($product_id){
		if(is_array($this->list)){
		for($i = 0; $i < sizeof($this->list); $i++){
			if($this->list[$i]->id == $product_id){
				unlink($this->list[$i]->image_path);
				array_splice($this->list, $i, 1);
				return $this->save();
			}
		}
	}
		return false;
	}

	public function get_by_category_id($category_id){
		$result = array();
		for($i = 0; $i < sizeof($this->list); $i++){
			if($this->list[$i]->category_id == $category_id){
				$result[] = $this->list[$i];
			}
		}
		return $result;
	}


	public function update($product_id, $category_id, $new_name, $description, $image_path=null){
		if(is_array($this->list)){
			for($i = 0; $i < sizeof($this->list); $i++){
				if($this->list[$i]->id == $product_id){
					$this->list[$i]->name = test_input($new_name);
					$this->list[$i]->category_id = $category_id;
					$this->list[$i]->description = test_input($description);
					if($image_path != null){
						unlink($this->list[$i]->image_path);
						$this->list[$i]->image_path = $image_path;
					}
					return $this->save();
				}
			}
		}
		return false;
	}	

	private function save(){
		return file_put_contents($this->filename, json_encode($this->list));
	}
}

?>
