<?php
/* create a new file product Script product_scr.php */
require_once('Database.php');

class tenant
{

	//Add User into tblUser onto UDM Databse
	public function addTenant($username,$gender,$email,$mobile,$country,$nationality,$passportNo,$address,$course,$dateOfEnrolment,$remarks)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('INSERT INTO tbltenant (username,gender,email,mobile,country,nationality,passportNo,address,course,dateOfEnrolment,remarks) VALUES(:username,:gender ,:email , :mobile , :country , :nationality , :passportNo , :address , :course , :dateOfEnrolment , :remarks )');

		//call bind method in database class
		$database->bind(':username', $username );
		$database->bind(':gender', $gender );
		$database->bind(':email', $email );
		$database->bind(':mobile', $mobile );
		$database->bind(':country', $country );
		$database->bind(':nationality', $nationality );
		$database->bind(':passportNo', $passportNo );
		$database->bind(':address', $address );
		$database->bind(':course', $course );
		$database->bind(':dateOfEnrolment', $dateOfEnrolment );
		$database->bind(':remarks', $remarks );
		
		//execute prepared statement
		$database->execute();
	}


	//add code below in class Student
	public function modifyTenant($username,$gender,$email,$mobile,$country,$nationality,$passportNo,$address,$course,$dateOfEnrolment,$remarks)
	{
		$database = new DBHandler();
		$database->query('UPDATE tbltenant SET username=:username ,gender=:gender, email=:email, mobile =:mobile, country =:country , nationality =:nationality , passportNo =:passportNo , address=:address , course=:course , dateOfEnrolment=:dateOfEnrolment , remarks=:remarks  WHERE username= :username');
		
		$database->bind(':username', $username);
		$database->bind(':gender', $gender);
		$database->bind(':email', $email);
		$database->bind(':mobile',$mobile);
		$database->bind(':country',$country);
		$database->bind(':nationality',$nationality);
		$database->bind(':passportNo',$passportNo);
		$database->bind(':address',$address);
		$database->bind(':course',$course);
		$database->bind(':dateOfEnrolment',$dateOfEnrolment);
		$database->bind(':remarks',$remarks);
		$database->execute();
	}

	//Function to get Tenant Details from Databas and same post to PHP
	public function retrieveTenant($username){
		$database = new DBHandler();
		$database->query('SELECT * FROM tbltenant WHERE username = :username');
		$database->bind(':username', $_SESSION['username']);
		return $row = $database->resultset();
	}

	//Add User into tblUser onto UDM Databse
	public function updateProfile($userID,$mobile,$address,$remarks)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('UPDATE tbltenant SET mobile=:mobile , address=:address , remarks=:remarks  WHERE userID=:userID');

		//call bind method in database class
		$database->bind(':userID', $_SESSION['userID'] );
		$database->bind(':mobile', $mobile );
		$database->bind(':address', $address );
		$database->bind(':remarks', $remarks );
		//execute prepared statement
		$database->execute();
	}

	//Function to get Booking
	public function getTenant($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tbltenant.userID , tblusers.name , tblusers.surname , tbltenant.gender , tbltenant.address , tbltenant.mobile , tbltenant.country,tbltenant.course FROM tbltenant INNER JOIN tblusers  ON tbltenant.username=tblusers.username ');
		return $row = $database->resultset();
	}
	
	//Get User details from Database
	public function getEmail($username)
	{
		$database = new DBHandler();
		$database->query('SELECT email FROM tbltenant WHERE username= :username');
		$database->bind(':username', $username);
		return $row = $database->resultset();
	}



	

}
?>