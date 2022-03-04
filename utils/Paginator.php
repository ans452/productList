<?php


// get count of pages
// cut the array according to the page

class Paginator {


	private $page;
	private $elements_per_page;
	private $amount_of_elements;


	// 9
	// 3
	// 10
	public function __construct($page, $elements_per_page, $amount_of_elements){
		if(is_numeric($page)){
		if(($page-1) * $elements_per_page < $amount_of_elements) $this->page = $page;
		else $this->page = 1;
		if($page <= 0) $this->page = 1;
		}
		else $this->page = 1;
		$this->elements_per_page = $elements_per_page;
		$this->amount_of_elements = $amount_of_elements;
	}

	public function __destruct(){}
	public function get_total_number_of_pages(){
		$coefficient = (int)($this->amount_of_elements / $this->elements_per_page);
		if($this->amount_of_elements % $this->elements_per_page == 0)
			return $coefficient;
		return $coefficient + 1;
	}

	public function get_page(){
		return $this->page;	
	}

	public function cut_array($array){
		if(!is_array($array)) return null;
		$start_point = ($this->page-1) * $this->elements_per_page;
		if(($covered_elements = $this->page * $this->elements_per_page) > $this->amount_of_elements){
			$ending_point = $start_point + $this->elements_per_page - ($covered_elements - $this->amount_of_elements);
		}
		else $ending_point = $start_point + $this->elements_per_page;

		$result = array();
		for($i = $start_point; $i < $ending_point; $i++){
			$result[$i] = $array[$i];
		}
		return $result;
	}

	public static function get_number_of_pages($amount_of_elements, $elements_per_page){
		$coefficient = (int)($amount_of_elements / $elements_per_page);
		if($amount_of_elements % $elements_per_page == 0)
			return $coefficient;
		return $coefficient + 1;
	}

}

// $array = [1,2,3,4,5,6,7,8,9,10,1];
// $page = 4;
// $elements_per_page = 5;
// $amount_of_elements = sizeof($array);

// $paginator = new Paginator(null, $elements_per_page, 10);

// echo "Total NUmber of pages:".$paginator->get_total_number_of_pages()."\n";
// echo "Current Page: ".$paginator->get_page()."\n";
// echo "Cut of array:\n";
// print_r($paginator->cut_array($array));
?>