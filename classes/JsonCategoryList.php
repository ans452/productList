<?php

class JsonCategoryList extends JsonList{

	public function add_category($category_name){
		if(!$this->name_exists($category_name)){
		$result = new stdClass();
		$result->id = $this->get_id();
		$result->name = test_input($category_name);
		array_push($this->list, $result);
		return $this->save();
		}
		return false;
	}

	public function delete_category($category_id){
		if(is_array($this->list)){
		for($i = 0; $i < sizeof($this->list); $i++){
			if($this->list[$i]->id == $category_id){
				array_splice($this->list, $i, 1);
				return $this->save();
			}
		}
	}
		return false;
	}
	public function update_name($category_id, $new_name){
		if(is_array($this->list)){
			for($i = 0; $i < sizeof($this->list); $i++){
				if($this->list[$i]->id == $category_id){
					$this->list[$i]->name = test_input($new_name);
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