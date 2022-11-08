<?php
	//AUTHOR: Gitendrajeet RAMLOCHUND
	//DATE: 
	//SCOPE: Creating a Class user which will be used to create object user

//Importing the file Database which will be used to interconnect class user and the database in phpmyadmin
require_once('Database.php');

class booking
{

	//Add Booking to tblbooking in UDM database
	public function addBooking($userID,$propertyID,$landlordID,$bookingDate,$startDate,$duration,$status,$remarks)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('INSERT INTO tblbooking (userID,propertyID,landlordID,bookingDate,startDate,duration,status,remarks) VALUES(:userID , :propertyID , :landlordID, :bookingDate , :startDate , :duration , :status , :remarks)');

		//call bind method in database class
		$database->bind(':userID', $userID );
		$database->bind(':propertyID', $propertyID );
		$database->bind(':landlordID', $landlordID );
		$database->bind(':bookingDate', $bookingDate );
		$database->bind(':startDate', $startDate );
		$database->bind(':duration', $duration );
		$database->bind(':status', $status );
		$database->bind(':remarks', $remarks );

		//execute prepared statement
		$database->execute();
		
	}

	//Function to get Tenant Details from Databas and same post to PHP
	public function getUserBooking($userID)
	{
		$database = new DBHandler();
		$database->query('SELECT tblbooking.bookingID , tblproperty.type , tblproperty.depositFee, tblproperty.address , tblbooking.bookingDate, tblbooking.startDate,tblbooking.duration, tblbooking.status,tblbooking.remarks FROM tblbooking INNER JOIN tblproperty ON tblbooking.propertyID=tblproperty.propertyID WHERE userID = :userID');
		$database->bind(':userID', $userID);
		return $row = $database->resultset();
	}

	//Function to get Booking
	public function getBooking($bookingID)
	{
		$database = new DBHandler();
		$database->query('SELECT * FROM tblbooking WHERE bookingID = :bookingID');
		$database->bind(':bookingID', $bookingID);
		return $row = $database->resultset();
	}



	//Function to get Tenant Details from Databas and same post to PHP
	public function delBooking($bookingID)
	{
		$database = new DBHandler();
		$database->query('DELETE FROM tblbooking WHERE bookingID = :bookingID');
		$database->bind(':bookingID', $bookingID);
		$database->execute();
	}
	public function getLandlordBooking($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT * FROM tblbooking WHERE landlordID = :landlordID');
		$database->bind(':landlordID', $landlordID);
		return $row = $database->resultset();
	}

	public function approveBooking($bookingID,$status)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('UPDATE tblbooking SET status=:status  WHERE bookingID=:bookingID');

		//call bind method in database class
		$database->bind(':bookingID', $bookingID );
		$database->bind(':status', $status );

		//execute prepared statement
		$database->execute();
	}

	public function getConfirmedBooking($landlordID){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblbooking WHERE status="Confirmed" AND landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function getPropertyID($bookingID){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblbooking WHERE bookingID=:bookingID');
		$database->bind(':bookingID', $_SESSION['bookingID']);
		return $row = $database->resultset();
	}
	//Function to get Booking
	public function getAll($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tblbooking.bookingID , tblbooking.landlordID , tblbooking.userID , tblproperty.type , tblproperty.address , tblbooking.bookingDate , tblbooking.duration,tblbooking.status FROM tblbooking INNER JOIN tblproperty ON tblbooking.propertyID=tblproperty.propertyID');
		return $row = $database->resultset();
	}
	public function getReportBookingConfirmed($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tblbooking.bookingID , tblusers.name , tblusers.surname , tblbooking.bookingDate , tblbooking.duration ,tblbooking.status tblbooking FROM tblbooking INNER JOIN tblusers ON tblbooking.userID=tblusers.userID where tblbooking.status="Confirmed"');
		
		return $row = $database->resultset();
	}

	public function getReportBookingConfirmedLandlord($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT tblbooking.bookingID , tblusers.name , tblusers.surname , tblbooking.bookingDate , tblbooking.duration ,tblbooking.status tblbooking FROM tblbooking INNER JOIN tblusers ON tblbooking.userID=tblusers.userID where tblbooking.status="Confirmed" AND landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function getReportBookingCancelledLandlord($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT tblbooking.bookingID , tblusers.name , tblusers.surname , tblbooking.bookingDate , tblbooking.duration ,tblbooking.status tblbooking FROM tblbooking INNER JOIN tblusers ON tblbooking.userID=tblusers.userID where tblbooking.status="Cancelled" AND landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function getReportBookingAllLandlord($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT tblbooking.bookingID , tblusers.name , tblusers.surname , tblbooking.bookingDate , tblbooking.duration ,tblbooking.status tblbooking FROM tblbooking INNER JOIN tblusers ON tblbooking.userID=tblusers.userID  AND landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function getReportBookingAll($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tblbooking.bookingID , tblusers.name , tblusers.surname , tblbooking.bookingDate , tblbooking.duration ,tblbooking.status tblbooking FROM tblbooking INNER JOIN tblusers ON tblbooking.userID=tblusers.userID');
		return $row = $database->resultset();
	}
	public function getReportBookingCancelled($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tblbooking.bookingID , tblusers.name , tblusers.surname , tblbooking.bookingDate , tblbooking.duration ,tblbooking.status tblbooking FROM tblbooking INNER JOIN tblusers ON tblbooking.userID=tblusers.userID where tblbooking.status="Cancelled"');
		return $row = $database->resultset();
	}

	public function countConfirmedBooking($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblbooking WHERE status = "Confirmed"');
		return $row = $database->resultset();

	}

	public function countCancelledBooking($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblbooking WHERE status = "Pending"');
		return $row = $database->resultset();
	}

	public function countPendingBooking($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS totalPending FROM tblbooking WHERE status = "Pending" AND landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function countConfirmLandlordBooking($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblbooking WHERE status="Confirmed" AND landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

}
