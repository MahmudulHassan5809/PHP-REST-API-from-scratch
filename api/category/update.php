<?php
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
	 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../models/Category.php';

	// Instantiate DB & connect
	$databse = new Database();
	$db = $databse->connect();

	//Instantiate blog Category object
	$category = new Category($db);

	// get raw  data
	$data = json_decode(file_get_contents("php://input"));

	// Set ID to Update
	$category->id = $data->id;

	$category->name = $data->name;


	// Create Post
	if($category->update()){
		echo json_encode(
			array('message' => "Category updated")
		);
	}else{
		echo json_encode(
			array('message' => "Category Not Updated")
		);
	}
