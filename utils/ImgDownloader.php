<?php

define("TARGET_DIR", "uploads/");


class ImgDownloader{

	// uploads file and rerurn the path to it
	public static function upload_img($file_info){
		$target_file = self::get_target_file($file_info["name"]);
		$image_file_type = self::get_image_file_type($target_file);
		if(self::is_actual_file($file_info["tmp_name"]) && self::check_for_formats($image_file_type) && self::is_unique($target_file &&
		self::check_file_size($file_info['size']))){
			if(move_uploaded_file($file_info['tmp_name'], $target_file))
				return $target_file;
			return null;
		}
		return null;
	}


	private static function is_actual_file($tmp_name){
		$check = getimagesize($tmp_name);
		return $check !== false;
	}

	private static function get_target_file($file_name){
		return TARGET_DIR . basename($file_name);
	}

	private static function get_image_file_type($target_file){
		return strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	}
	// return true if there is no such file
	// return false when file already exists
	private static function is_unique($target_file){
		return !file_exists($target_file);
	}

	// if bigger than 500000 ===> is not suitable
	private static function check_file_size($file_size){
		return $file_size <= 500000;
	}

	private static function check_for_formats($image_file_type){
		if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif")
			return false;
		return true;
	}

}

?>