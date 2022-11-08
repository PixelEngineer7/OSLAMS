<?php
//Name:RAMLOCHUND Gitendrajeet 
//Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
//Scope: Export to CSV Script | List of all Confirmed Booking on the System
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "udm";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }

    // get users list
    $query = 'SELECT tblbooking.bookingID , tblusers.name , tblusers.surname , tblbooking.bookingDate , tblbooking.duration ,tblbooking.status tblbooking FROM tblbooking INNER JOIN tblusers ON tblbooking.userID=tblusers.userID where tblbooking.status="Confirmed"';
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
    header('Content-Disposition: attachment; filename=ConfirmedBooking.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('No', 'Name','Surname','Booking Date','Duration','status'));
 
    if (count($users) > 0) {
        foreach ($users as $row) {
            fputcsv($output, $row);
        }
    }
?>