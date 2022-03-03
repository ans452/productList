<?php

require 'JsonList.php';
define("CATEGORY_LIST", "categories.json");

class JsonCategoryList extends JsonList{

	public function __construct(){
		if(file_exists(CATEGORY_LIST) && ($json = file_get_contents(CATEGORY_LIST)) != null){
			$this->list = json_decode($json);
		}
	}

	public function add_category($category_name){
		if(!$this->name_exists($category_name)){
		$result = new stdClass();
		$result->id = $this->get_id();
		$result->name = $category_name;
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
					$this->list[$i]->name = $new_name;
					return $this->save();
				}
			}
		}
		return false;
	}	

	public function get_list(){
		return $this->list;
	}

	private function save(){
		return file_put_contents(CATEGORY_LIST, json_encode($this->list));
	}
}

// $cars = new Category("Cats");
// // print_r($cars);
// $drinks = new Category("Drinks");
// $animals = new Category("Animals");
// $journey = new Category("Journey");
// $nature = new Category("Nature");
// $list = new JsonCategoryList();
// $list->add_category("Naruson");

?>