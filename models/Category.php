<?php

/**
 * Category Class
 */
class Category
{

	// Db Stuff
	private $conn;
	private $table = 'categories';

	// Category Properties
	public $id;
	public $name;
	public $created_at;

	// Constructor with DB
	public function __construct($db){
		$this->conn = $db;
	}

	// read Categories
	public function read(){
		$query = 'SELECT
			id,
			name,
			created_at
		FROM '
			. $this->table.'
		ORDER BY
			created_at DESC';

		// Prepare Statement
		$stmt = $this->conn->prepare($query);

		// Execute
		$stmt->execute();

		return $stmt;
	}

	// read single category
	public function read_single(){
		// create query
		$query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';

		// Prepare Statement
		$stmt = $this->conn->prepare($query);

		// Bind ID
		$stmt->bindParam(1,$this->id);

		// Execute
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Set Properties
		$this->name = $row['name'];
		$this->id = $row['id'];
	}

	// Create Post
	public function create(){
		// Create Query
		$query = 'INSERT INTO ' .
			$this->table . '
			SET
				name = :name ';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean Data
		$this->name = htmlspecialchars(strip_tags($this->name));


		// Bind Data
		$stmt->bindParam(':name',$this->name);


		// Execute Query
		if($stmt->execute()){
			return true;
		}else{
			printf('Error: %s.\n',$stmt->error);
			return false;
		}
	}

	// Update Post
	public function update(){
		// Create Query
		$query = 'UPDATE ' .
			$this->table . '
			SET
				name = :name
			WHERE
				id = :id';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean Data
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->id = htmlspecialchars(strip_tags($this->id));

		// Bind Data
		$stmt->bindParam(':name',$this->name);
		$stmt->bindParam(':id',$this->id);

		// Execute Query
		if($stmt->execute()){
			return true;
		}else{
			printf('Error: %s.\n',$stmt->error);
			return false;
		}
	}

	// Delete Category
	public function delete(){
		// Create query
		$query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean Data
		$this->id = htmlspecialchars(strip_tags($this->id));

		// Bind Data
		$stmt->bindParam(':id',$this->id);

		// Execute Query
		if($stmt->execute()){
			return true;
		}else{
			printf('Error: %s.\n',$stmt->error);
			return false;
		}
	}
}

?>
