<?php 

class EditingController extends Controller {

	private $product_name;
	private $post_category_id;
	private $category_name;
	private $description;
	public $errors = array();


	public function __construct($product_file = "data/products.json", $category_file = "data/categories.json"){
		$this->category_list = new JsonCategoryList($category_file);
		$this->product_list = new JsonProductList($product_file);
		if(!empty($_GET['category_id']) && is_numeric($_GET['category_id'])) $this->category_id = $_GET['category_id'];
		if(!empty($_GET['product_id']) && is_numeric($_GET['product_id'])) $this->product_id = $_GET['product_id'];
		if(!empty($_POST['product_name'])) $this->product_name = $_POST['product_name'];
		if(!empty($_POST['category_name'])) $this->category_name = $_POST['category_name']; 
		if(!empty($_POST['category_id']) && is_numeric($_POST['category_id'])) $this->post_category_id = $_POST['category_id']; 
		if(!empty($_POST['description'])) $this->description = $_POST['description']; 

		}

		public function edit_category(){
			// empty
			// same name
			if(empty($this->category_name))
				$this->errors[] = "Empty category name";
			if($this->category_list->get_element_by_id($this->category_id)->name != $this->category_name && !$this->is_unique_category_name()){
				$this->errors[] = "These category name exists";
			}
			if(!$errors) $this->category_list->update_name($this->category_id, $this->category_name);
		}

		public function edit_product(){
			$image_path;
			if(empty($this->post_category_id)) $this->errors[] = "Category is not specified";
			if(!$this->category_list->id_exists($this->post_category_id)) $this->errors[] = "There is no such category";
			if(empty($this->product_name)) $this->errors[] = "Empty product name";
			if(!$this->is_valid_product_id()) $this->errors[] = "There is no such product";
			if(!empty($_FILES['image']['name'])){
				if(!($image_path = ImgDownloader::upload_img($_FILES['image']))){ 
					$this->errors[] = "Couldn't upload the image. Use appropriate img formats or leave the image input empty"; 
					return;
					}
				}
				else $image_path = null;
				// echo var_dump($image_path);
			if(!$this->errors) $this->product_list->update($this->product_id, $this->post_category_id, $this->product_name, $this->description, $image_path);
		}



		public function is_valid_category_id(){
			return $this->category_list->id_exists($this->category_id);
		}


		public function is_valid_product_id(){
		
			return $this->product_list->id_exists($this->product_id);
		}
	
		
		private function is_unique_category_name(){
			return !$this->category_list->name_exists($this->category_name);
		}

		

} 


?>