<?php
	//AUTHOR: Gitendrajeet RAMLOCHUND
	//DATE: 
	//SCOPE: Creating a Class user which will be used to create object user

//Importing the file Database which will be used to interconnect class user and the database in phpmyadmin
require_once('Database.php');
require_once('tenant.php');
class user extends tenant
{
	//Add User into tblUser onto UDM Databse
	public function registerUser($surname,$name,$category,$username,$password)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('INSERT INTO tblusers (surname,name,category,username,password) VALUES(:surname , :name , :category , :username , :password)');
		//call bind method in database class
		$database->bind(':surname', $surname );
		$database->bind(':name', $name );
		$database->bind(':category', $category );
		$database->bind(':username', $username );
		$database->bind(':password', $password );
		//execute prepared statement
		$database->execute();
	}

	//Function to view all users in User Table
	public function viewUsers($database)
		{
			$database->query('SELECT * FROM tblusers');
			$dbRows= $database->resultset();
			return $dbRows;
		}
	//Add User into tblUser onto UDM Databse
	public function updateUser($userID,$name,$surname,$category)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('UPDATE tblusers SET name=:name , surname=:surname, category=:category WHERE userID=:userID');
		//call bind method in database class
		$database->bind(':userID', $userID );
		$database->bind(':surname', $surname );
		$database->bind(':name', $name );
		$database->bind(':category', $category );
		//execute prepared statement
		$database->execute();
	}

	//Function to get UserDetails from Databas and same post to PHP
	public function retrieveUser($username){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblusers WHERE username = :username');
		$database->bind(':username', $_SESSION['username']);
		return $row = $database->resultset();
	}

	//Function to get UserDetails from Databas and same post to PHP
	public function getUserID($username){
		$database = new DBHandler();
		$database->query('SELECT userID FROM tblusers WHERE username = :username');
		$database->bind(':username', $_SESSION['username']);
		return $row = $database->resultset();
	}

	//Function to get UserDetails from Databas and same post to PHP
	public function getUserInfo($userID){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblusers WHERE userID = :userID');
		$database->bind(':userID',$userID);
		return $row = $database->resultset();
	}
	//Admin with elevated priveledge change Password
	public function changePassword($userID,$password)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('UPDATE tblusers SET password=:password  WHERE userID=:userID');
		//call bind method in database class
		$database->bind(':userID', $userID );
		$database->bind(':password', $password );
		//execute prepared statement
		$database->execute();
	}
	//User Password Change
		public function passwordchange($username,$password)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('UPDATE tblusers SET password=:password  WHERE username=:username');
		//call bind method in database class
		$database->bind(':username', $username );
		$database->bind(':password', $password );
		//execute prepared statement
		$database->execute();
	}

	//Function to get Tenant Details from Databas and same post to PHP
	public function retrieveUID($userID){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblusers WHERE userID = :userID');
		$database->bind(':userID', $userID );
		return $row = $database->resultset();
	}

//Function to get Booking
	public function getUserDetail($userID)
	{
		$database = new DBHandler();
		$database->query('SELECT * FROM tblusers WHERE userID = :userID');
		$database->bind(':userID', $userID);
		return $row = $database->resultset();
	}
	//Function to get Booking
	public function getDetail($database)
	{
		$database = new DBHandler();
		$database->query('SELECT * FROM tblusers WHERE category = "Student"');
		return $row = $database->resultset();
	}
	//Function that verifies if User Role is matching the category it returns the category and same is ued with a switch case to proceed
	public function getRole($username, $password)
	{
		$database = new DBHandler();
		$database->query('SELECT category FROM tblusers WHERE username=:username AND password=:password');
		$database->bind(':username', $username );
		$database->bind(':password', $password );
		$row = $database->resultset();
		$count = count($row);

		if ($count==1)
		{
		 
		   $role=$row[0]['category'];
		}
		else
		{
			$role="unidentifiedrole";
		}

		return $role; 
	}
//Automated Function acts like an AI for verification if user is supposed to be logged , if NO, it immediately logs user out.
	public function securityCheck($username)
	{
		$database = new DBHandler();
		$database->query('SELECT category FROM tblusers WHERE username=:username');
		$database->bind(':username', $username );
		return $row = $database->resultset();

	}

	public function countLandlord($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblusers WHERE category = "Landlord"');
		return $row = $database->resultset();

	}
	public function countStudent($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblusers WHERE category = "Student"');
		return $row = $database->resultset();

	}
	public function countAll($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblusers');
		return $row = $database->resultset();

	}
	public function countTenant($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblusers WHERE category = "Tenant"');
		return $row = $database->resultset();

	}


	
}
?>