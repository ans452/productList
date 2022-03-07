<?php

// function for cleaning the input
function test_input($data) {
	// removes whitespace from both the left and right sides of a string
	$data = trim($data);
	// removes slashed
	$data = stripslashes($data);
	//  Convert special characters to HTML entities
	$data = htmlspecialchars($data);
	return $data;
  }



?>