<?php

class JsonList{

	protected $list = array();


	public function get_list(){
		return $this->list;
	}

	protected function get_id(){
		if(!empty($this->list))
			$result = $this->list[count($this->list)-1]->id + 1;
		else $result = 1;
		while($this->id_exists($result)) $result++;
		return $result;
	}

	protected function id_exists($id){
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


}

?>