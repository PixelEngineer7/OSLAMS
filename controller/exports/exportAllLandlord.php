<?php
//Name:RAMLOCHUND Gitendrajeet 
//Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
//Scope: Export to CSV Script | List of All Rental of Landlord Property on the System
session_start();
    
    $landlordID=$_SESSION['landlordID'];

    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "udm";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }

    // get users list
    $query = "SELECT tblrental.rentalID , tblproperty.type , tblproperty.address , tblrental.startDate , tblrental.endDate ,tblrental.status FROM tblrental INNER JOIN tblproperty ON tblrental.propertyID=tblproperty.propertyID WHERE tblrental.landlordID=$landlordID";
    if (!$result = mysqli_query($conn, $query)) {
        exit(mysqli_error($con));
    }
 
    $users = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
 
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=AllLandlordRental.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('No', 'Property Type','Address','Start Date','End Date','Rental Status'));
 
    if (count($users) > 0) {
        foreach ($users as $row) {
            fputcsv($output, $row);
        }
    }
?>