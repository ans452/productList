<?php

class JsonList{

	protected $list = array();
	protected String $filename;

	public function __construct(String $filename){
		if(file_exists($filename) && ($json = file_get_contents($filename)) != null){
			$this->list = json_decode($json);
		}
		$this->filename = $filename;
	}

	protected function get_id(){
		if(!empty($this->list))
			$result = $this->list[count($this->list)-1]->id + 1;
		else $result = 1;
		while($this->id_exists($result)) $result++;
		return $result;
	}

	public function id_exists($id){
		foreach($this->list as $element){
			if($element->id == $id) return true;
		}
		return false;
	}
	protected function name_exists($name){
		foreach($this->list as $element){
			if($element->name == $name) return true;
		}
		return false;
	}

	public function get_element_by_id($id){
		for($i = 0; $i < sizeof($this->list); $i++){
			if($this->list[$i]->id == $id){
				return $this->list[$i];
			}
		}
		return false;
	}

	public function get_list(){
		return $this->list;
	}
}

include 'JsonProductList.php';
include 'JsonCategoryList.php';

?>