<?php
	//AUTHOR: Gitendrajeet RAMLOCHUND
	//DATE: 
	//SCOPE: Creating a Class user which will be used to create object user

//Importing the file Database which will be used to interconnect class user and the database in phpmyadmin
require_once('Database.php');

class rental
{

	//Add Booking to tblbooking in UDM database
	public function addRental($tenantID,$propertyID,$landlordID,$bookingID,$startDate,$endDate,$status)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('INSERT INTO tblrental (tenantID,propertyID,landlordID,bookingID,startDate,endDate,status) VALUES(:tenantID , :propertyID ,:landlordID, :bookingID,:startDate , :endDate , :status)');

		//call bind method in database class
		$database->bind(':tenantID', $tenantID );
		$database->bind(':propertyID', $propertyID );
		$database->bind(':landlordID', $landlordID );
		$database->bind(':bookingID', $bookingID );
		$database->bind(':startDate', $startDate );
		$database->bind(':endDate', $endDate );
		$database->bind(':status', $status );
		//execute prepared statement
		$database->execute();
		
	}

	//Function to get Tenant Details from Databas and same post to PHP
	public function getAllRental($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT * FROM tblrental WHERE landlordID = :landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	//Function to get Tenant Details from Databas and same post to PHP
	public function getUserRental($rentalID)
	{
		$database = new DBHandler();
		$database->query('SELECT * FROM tblrental WHERE rentalID = :rentalID');
		$database->bind(':rentalID', $rentalID);
		return $row = $database->resultset();
	}

	public function getTenantRental($tenantID)
	{
		$database = new DBHandler();
		$database->query('SELECT tblrental.rentalID , tblproperty.type, tblproperty.address, tblproperty.depositFee,tblrental.startDate,tblrental.endDate,tblrental.status,tblrental.remarks ,tblrental.bookingID,tblrental.tenantID,tblproperty.bscAddress,tblrental.cryptoPayment,tblproperty.propertyID FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID WHERE tenantID = :tenantID');
		$database->bind(':tenantID', $tenantID);
		return $row = $database->resultset();
	}

	public function agreeRental($rentalID,$remarks,$bscAddress)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('UPDATE tblrental SET remarks=:remarks  , bscAddress=:bscAddress WHERE rentalID=:rentalID');

		//call bind method in database class
		$database->bind(':rentalID', $rentalID );
		$database->bind(':remarks', $remarks );
		$database->bind(':bscAddress', $bscAddress );

		//execute prepared statement
		$database->execute();
	}
		public function updatePayment($rentalID,$cryptoPayment)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('UPDATE tblrental SET cryptoPayment=:cryptoPayment WHERE rentalID=:rentalID');

		//call bind method in database class
		$database->bind(':rentalID', $rentalID );
		$database->bind(':cryptoPayment', $cryptoPayment );

		//execute prepared statement
		$database->execute();
	}


	public function updateRental($rentalID,$status)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('UPDATE tblrental SET status=:status  WHERE rentalID=:rentalID');

		//call bind method in database class
		$database->bind(':rentalID', $rentalID );
		$database->bind(':status', $status );

		//execute prepared statement
		$database->execute();
	}

	//Function to get Booking
	public function getAll($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tblrental.rentalID , tblrental.tenantID , tblrental.propertyID , tblproperty.type , tblrental.startDate , tblrental.endDate, tblrental.status FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID');
		return $row = $database->resultset();
	}

	//Function to get Booking
	public function getAgreement($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tblrental.rentalID , tblrental.tenantID , tblrental.propertyID , tblproperty.type , tblusers.name , tblusers.surname , tblrental.startDate , tblrental.endDate, tblrental.status FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID INNER JOIN tblusers ON tblrental.tenantID=tblusers.userID' );
		return $row = $database->resultset();
	}

	public function getReportRentalConfirmed($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tblrental.rentalID , tblproperty.type , tblproperty.address , tblrental.startDate , tblrental.endDate ,tblrental.status FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID where tblrental.status="Current"');
		return $row = $database->resultset();
	}

	public function getReportRentalTerminated($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tblrental.rentalID , tblproperty.type , tblproperty.address , tblrental.startDate , tblrental.endDate ,tblrental.status FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID where tblrental.status="Terminated"');
		return $row = $database->resultset();
	}

	public function getReportRentalAll($database)
	{
		$database = new DBHandler();
		$database->query('SELECT tblrental.rentalID , tblproperty.type , tblproperty.address , tblrental.startDate , tblrental.endDate ,tblrental.status FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID');
		return $row = $database->resultset();
	}

	public function countConfirmedRental($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblrental WHERE status = "Current"');
		return $row = $database->resultset();

	}

	public function countAllRental($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblrental');
		return $row = $database->resultset();

	}

	public function countConfirmedRentalLandlord($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblrental WHERE status="Current" AND landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function countAllRentalLandlord($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblrental WHERE landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();

	}

	public function getReportRentalConfirmedLandlord($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT tblrental.rentalID , tblproperty.type , tblproperty.address , tblrental.startDate , tblrental.endDate ,tblrental.status FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID WHERE tblrental.status="Current" AND tblrental.landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();

	}

	public function getReportRentalTerminatedLandlord($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT tblrental.rentalID , tblproperty.type , tblproperty.address , tblrental.startDate , tblrental.endDate ,tblrental.status FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID WHERE tblrental.status="Terminated" AND tblrental.landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function getReportRentalAllLandlord($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT tblrental.rentalID , tblproperty.type , tblproperty.address , tblrental.startDate , tblrental.endDate ,tblrental.status FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID WHERE tblrental.landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}






















































}
	