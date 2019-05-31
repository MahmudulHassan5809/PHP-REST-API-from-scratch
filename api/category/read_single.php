<?php
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Category.php';

	// Instantiate DB & connect
	$databse = new Database();
	$db = $databse->connect();

	//Instantiate blog category object
	$category = new Category($db);

	// Get ID
	$category->id = isset($_GET['id']) ? $_GET['id'] : die();

	// Get Post
	$category->read_single();

	// create array
	$category_arr = array(
		'id' => $category->id,
		'name' => $category->name,
	);

	// Make json
	print_r(json_encode($category_arr));
