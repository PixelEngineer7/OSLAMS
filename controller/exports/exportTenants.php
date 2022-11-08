<?php
//Name:RAMLOCHUND Gitendrajeet 
//Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
//Scope: Export to CSV Script | List of all Registered Tenant on the System
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "udm";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }

    // get users list
    $query = "SELECT tbltenant.userID , tblusers.name , tblusers.surname , tbltenant.gender , tbltenant.address , tbltenant.mobile , tbltenant.country,tbltenant.course FROM tbltenant INNER JOIN tblusers  ON tbltenant.username=tblusers.username ";
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
    header('Content-Disposition: attachment; filename=RegisteredTenant.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('No', 'Name', 'Surname', 'Gender','Address','Mobile','Country','Course Registered'));
 
    if (count($users) > 0) {
        foreach ($users as $row) {
            fputcsv($output, $row);
        }
    }
?>