<?php
/* create a new file product Script product_scr.php */
require_once('Database.php');

class landlord
{

	//Add User into tblUser onto UDM Databse
	public function addLandlord($username,$type,$email,$phone,$mobile)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('INSERT INTO tbllandlord (username,type,email,phone,mobile) VALUES(:username,:type ,:email , :phone , :mobile)');

		//call bind method in database class
		$database->bind(':username', $username );
		$database->bind(':type', $type );
		$database->bind(':email', $email );
		$database->bind(':phone', $phone );
		$database->bind(':mobile', $mobile );
		
		
		//execute prepared statement
		$database->execute();
	}


	//add code below in class Student
	public function modifyTenant($username,$gender,$email,$mobile,$country,$nationality,$passportNo,$address,$course,$dateOfEnrolment,$remarks)
	{
		$database = new DBHandler();
		$database->query('UPDATE tblTenant SET username=:username ,gender=:gender, email=:email, mobile =:mobile, country =:country , nationality =:nationality , passportNo =:passportNo , address=:address , course=:course , dateOfEnrolment=:dateOfEnrolment , remarks=:remarks  WHERE username= :username');


		
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
	public function retrieveLandlord($username){
		$database = new DBHandler();
		$database->query('SELECT * FROM tbllandlord WHERE username = :username');
		$database->bind(':username', $_SESSION['username']);
		return $row = $database->resultset();
	}

//Function to get Tenant Details from Databas and same post to PHP
	public function getDetailsLandlord($landlordID){
		$database = new DBHandler();
		$database->query('SELECT * FROM tbllandlord WHERE userID = :userID');
		$database->bind(':userID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	//Function to get Booking
	public function getLandlord($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tbllandlord.userID , tblusers.name , tblusers.surname , tbllandlord.type , tbllandlord.email , tbllandlord.mobile  FROM tbllandlord INNER JOIN tblusers  ON tbllandlord.username=tblusers.username ');
		return $row = $database->resultset();
	}

	//Add User into tblUser onto UDM Databse
	public function updateProfile($userID,$mobile,$phone)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('UPDATE tbllandlord SET mobile=:mobile , phone=:phone   WHERE userID=:userID');

		//call bind method in database class
		$database->bind(':userID', $_SESSION['userID'] );
		$database->bind(':mobile', $mobile );
		$database->bind(':phone', $phone );
		//execute prepared statement
		$database->execute();
	}

	



	


}
?>