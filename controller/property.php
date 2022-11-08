<?php
 //Name:RAMLOCHUND Gitendrajeet 
 //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
 //Scope: Class property with functions
require_once('Database.php');

class property
{

	//Add Users into tbluser onto UDM Databse
	public function addProperty($landlordID,$type,$rating,$capacity,$rentalFee,$depositFee,$status,$area,$address,$distance,$wifi,$bathroom,$kitchen,$pictures,$otherFacilities,$approved,$bscAddress)
	{
		$database = new DBHandler();
		//prepared statement
		$database->query('INSERT INTO tblproperty (landlordID,type,rating,capacity,rentalFee,depositFee,status,area,address,distance,wifi,bathroom,kitchen,pictures,otherFacilities,approved,bscAddress) VALUES(:landlordID , :type , :rating , :capacity , :rentalFee , :depositFee , :status , :area , :address , :distance , :wifi , :bathroom , 
				  :kitchen , :pictures , :otherFacilities , :approved,:bscAddress)');

		//call bind method in database class
		$database->bind(':landlordID', $landlordID );
		$database->bind(':type', $type );
		$database->bind(':rating', $rating );
		$database->bind(':capacity', $capacity );
		$database->bind(':rentalFee', $rentalFee );
		$database->bind(':depositFee', $depositFee );
		$database->bind(':status', $status );
		$database->bind(':area', $area );
		$database->bind(':address', $address );
		$database->bind(':distance', $distance );
		$database->bind(':wifi', $wifi );
		$database->bind(':bathroom', $bathroom );
		$database->bind(':kitchen', $kitchen );
		$database->bind(':pictures', $pictures );
		$database->bind(':otherFacilities', $otherFacilities );
		$database->bind(':approved', $approved );
		$database->bind(':bscAddress', $bscAddress );

		//execute prepared statement
		$database->execute();
	}

	//Function to get landlord Details from Database and return as row
	public function retrieveProperty($landlordID){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblproperty WHERE landlordID = :landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	//Function retun Property on Rent Where Status is AVAILABLE and APPROVED By UDM Administrator
	public function propertyOnRentA($database){
		$database = new DBHandler();
		$database->query('SELECT tblproperty.propertyID , tblproperty.type ,tblproperty.pictures, tblproperty.rating,tblproperty.address,tblproperty.rentalFee,tblproperty.status FROM tblproperty LEFT JOIN tblbooking ON tblproperty.propertyID=tblbooking.propertyID WHERE tblproperty.status="Available" AND tblproperty.approved=1 AND tblbooking.status IS NULL');
		return $row = $database->resultset();
	}

	//Function retun Property on Rent Where Status is AVAILABLE and APPROVED By UDM Administrator
	public function propertyOnRent($database){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblproperty WHERE status="Available" AND approved=1');
		return $row = $database->resultset();
	}

	//Function retun Property on Rent Where Status is AVAILABLE and APPROVED By UDM Administrator
	public function propertyLandlordOnRent($landlordID){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblproperty WHERE status="Available" AND approved=1 AND landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	//Function to get pending properties where approved=0
	public function pendingProperty($landlordID){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblproperty WHERE approved=0');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	//Function to get all Property on the UDM OSLAMS by Administrator
	public function getAllProperty($database)
	{
			$database->query('SELECT * FROM tblproperty');
			$dbRows= $database->resultset();
			return $dbRows;
	}

	//Function to get all Property on the UDM OSLAMS by Administrator
	public function getAllLandlordProperty($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT * FROM tblproperty WHERE landlordID=:landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	//Function to approve Property on the UDM OSLAMS by Administrator
	public function approvedProperty($propertyID,$approved)
	{
			$database = new DBHandler();
			$database->query('UPDATE tblproperty SET approved=:approved WHERE propertyID=:propertyID');
			$database->bind(':propertyID', $propertyID );
			$database->bind(':approved', $approved );
			$database->execute();
	}

	//Function to get Property Details using the PropertyID
	public function getPropertyInfo($propertyID){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblproperty WHERE propertyID=:propertyID');
		$database->bind(':propertyID', $_SESSION['propertyID']);
		return $row = $database->resultset();
	}
	//Function to update property Status 
	public function propertyStatus($propertyID,$status)
	{
			$database = new DBHandler();
			$database->query('UPDATE tblproperty SET status=:status WHERE propertyID=:propertyID');
			$database->bind(':propertyID', $propertyID );
			$database->bind(':status', $status );
			$database->execute();
	}

	//Function modify Property by Landlord
	public function modifyProperty($propertyID,$rating,$capacity,$rentalFee,$depositFee,$wifi,$bathroom,$kitchen,$otherFacilities)
	{
			$database = new DBHandler();
			$database->query('UPDATE tblproperty SET  propertyID=:propertyID ,rating=:rating , capacity=:capacity , rentalFee=:rentalFee , depositFee:=depositFee , wifi=:wifi , bathroom=:bathroom  , kitchen=:kitchen , otherFacilities=:otherFacilities WHERE propertyID=:propertyID');
			$database->bind(':propertyID', $propertyID );
			$database->bind(':rating', $rating );
			$database->bind(':capacity', $capacity );
			$database->bind(':rentalFee', $rentalFee );
			$database->bind(':depositFee', $depositFee );
			$database->bind(':wifi', $wifi );
			$database->bind(':bathroom', $bathroom );
			$database->bind(':kitchen', $kitchen );
			$database->bind(':otherFacilities', $otherFacilities );
			$database->execute();
	}

	//Function to return landlordID using PropertyID
	public function getlandlordID($propertyID){
		$database = new DBHandler();
		$database->query('SELECT landlordID FROM tblproperty WHERE propertyID = :propertyID');
		$database->bind(':propertyID', $_SESSION['propertyID']);
		return $row = $database->resultset();
	}	

	//Function retun Property on Rent Where Status is AVAILABLE and APPROVED By UDM Administrator
	public function search($address){
		$database = new DBHandler();
		$database->query('SELECT * FROM tblproperty WHERE address=:address AND status="Available" AND approved=1');
		$database->bind(':address', $address);
		return $row = $database->resultset();
	}

	public function countPropertyM($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS totalUnavailable FROM tblproperty WHERE status = "Maintenance"');
		return $row = $database->resultset();

	}

	public function countPropertyA($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS totalAvailable FROM tblproperty WHERE status = "Available"');
		return $row = $database->resultset();

	}

	public function countPropertyApproval($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblproperty WHERE approved = 0');
		return $row = $database->resultset();

	}
	public function countAll($database)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS total FROM tblproperty');
		return $row = $database->resultset();

	}

	public function countPM($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS totalUnavailable FROM tblproperty WHERE status = "Maintenance" AND landlordID = :landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function countPLAavailable($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS totalAvailable FROM tblproperty WHERE status = "Available" AND approved=1 AND landlordID = :landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function countPLApproval($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS totalApproved FROM tblproperty WHERE approved = 0 AND landlordID = :landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}

	public function countAllLandlord($landlordID)
	{
		$database = new DBHandler();
		$database->query('SELECT count(*) AS totalLandlord FROM tblproperty WHERE landlordID = :landlordID');
		$database->bind(':landlordID', $_SESSION['landlordID']);
		return $row = $database->resultset();
	}
}
?>