<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Category.php';

	// Instantiate DB & connect
	$databse = new Database();
	$db = $databse->connect();

	//Instantiate blog post object
	$category = new Category($db);

	// Blog Category Query
	$result =$category->read();
	// Get Row Count
	$num = $result->rowCount();

	// Check if any Category
	if($num > 0){
		// Category array
		$categories_arr = array();
		$categories_arr['data'] = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$category_item = array(
				'id' => $id,
				'name' => $name,
			);
		// Push To 'data';
		array_push($categories_arr['data'],$category_item);
		}
	// Turn to JSON
	echo json_encode($categories_arr);
	}else{
		// No Category
		echo json_encode(
			array('message' => 'No Categories Found')
		);
	}

?>
