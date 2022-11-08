<?php

	//AUTHOR: Gitendrajeet RAMLOCHUND
	//DATE: 
	//SCOPE: Creating a Class DBHandler for connection(PDO) with Database and PHP

	//Creating the Class DBHandler
	class DBHandler{
	//define the properties
	
	private $host   = 'localhost'; //Private variable(will not be called outside this class) that will store the host name
	private $user   = 'root'; //Private variable(will not be called outside this class) that will store the username
	private $pass   = ''; //Private variable(will not be called outside this class) that will store the password
	private $dbname = 'udm'; //Private variable(will not be called outside this class) that will store the database name
	
	private $dbh;  //database handler
	private $error; //error in case connection is unsuccessful
	private $stmt; //prepared statement
	
	public function __construct(){
		// Set DSN(Data Source Name to describe the database connection)
		$dsn= 'mysql:host='. $this->host . ';dbname='. $this->dbname;
		
		// Set error options
		$options = array(
			PDO::ATTR_PERSISTENT=> true,
			PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION);
			
		// Create new PDO instance to connect to database
		try {
			$this->dbh= new PDO($dsn, $this->user, $this->pass, $options);} 
			
		//an exception is raised if there is an error
		catch(PDOException$e){
			$this->error = $e->getMessage();}
			}
			
	public function bind($param, $value, $type = null){
		if(is_null($type)){
			switch(true){
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:$type = PDO::PARAM_STR;}}
					
	$this->stmt->bindValue($param, $value, $type);}
			
	//use the PDO instance dbh to call the prepare method
	public function query($query){
		$this->stmt= $this->dbh->prepare($query);}
			
	//to execute prepared statements
	public function execute(){
		return $this->stmt->execute();}
		
	//to select records from database
	public function resultset(){
		$this->execute();
			
	// retrieve the result set in the form of an associative array
	return $this->stmt->fetchAll(PDO::FETCH_ASSOC);}}
?>