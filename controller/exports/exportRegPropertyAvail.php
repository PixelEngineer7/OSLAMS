<?php
//Name:RAMLOCHUND Gitendrajeet 
//Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
//Scope: Export to CSV Script | List of Registered and Available Property for Rent on the System
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
    $query = "SELECT propertyID,type,rating,capacity,address,status,approved FROM tblproperty WHERE status='Available' AND approved=1 AND landlordID='$landlordID'";
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
    header('Content-Disposition: attachment; filename=RegPropertyAvail.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('No', 'Type','Rating','Capacity','Address','Status','Approved By Udm'));
 
    if (count($users) > 0) {
        foreach ($users as $row) {
            fputcsv($output, $row);
        }
    }
?>