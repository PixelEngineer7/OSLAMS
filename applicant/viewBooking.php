<?php
  //Name:RAMLOCHUND Gitendrajeet 
  //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
  //Scope: Applicant Dashboard | View Booking
session_start();
require '../controller/Database.php';
require '../controller/tenant.php';
require '../controller/user.php';
require '../controller/booking.php';

$database=new DBHandler();
$verify= new user();
$security=$verify->securityCheck($_SESSION['username']);

if($security[0]['category'] =='Student')
{
      //...Fer Kitchoz
}
else if ($security[0]['category'] !='Student')
{
  header("location:../controller/logout.php");
}


if (isset($_GET['QStrbookingID']))
{
  $bookingID=$_SESSION['bookingID']=(int)($_GET["QStrbookingID"]);
  $cancelBooking = new booking();
  $cancelBooking->delBooking($bookingID);
}


$user = new user();
$test = $user->getUserID($_SESSION['username']);
foreach ($test as $row) 
{
  $_SESSION['userID']=$row['userID'];
}

$userID=(int)$_SESSION['userID'];
$_SESSION['tenantID']=(int)$_SESSION['userID'];

$database = new DBHandler();
$viewBooking = new booking();
$listBooking= $viewBooking->getUserBooking($userID);



?>
<!DOCTYPE html>
<title>UDM OSLAMS Applicant | View Booking | Dashboard </title>
<meta charset="UTF-8">
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="icon" type="image/x-icon" href="../images/favicon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<style>

  html,body,h1,h2,h3,h4,h5,p {font-size: 14px;, font-family: "Arial", sans-serif}
</style>


<body class="w3-light-grey">

  <!-- Top container -->
  <div class="w3-bar w3-top w3-white w3-large" style="z-index:3">
   <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-blue" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
   <span class="w3-bar-item w3-right"><img src="../images/minLogo.png"   alt="" >&nbsp; &nbsp;<h3 style="display: inline-block">Online Student Lodging Accomodation Management System</h3></span>
 </div>

 <!-- Sidebar/menu -->
 <nav class="w3-sidebar w3-collapse w3-light w3-animate-left" style="z-index:4;width:300px;" id="mySidebar">
  <div class="w3-container">
    <center><img src="../images/studentpros.png" class="img-responsive" alt="" style="width:80px;"></center>
    <br>
    <span>Welcome, <strong><?php echo $_SESSION['username'];?></strong></span><br>
    <a href="../controller/logout.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>
    <a href="viewProfile.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
  </div>
</div>
<hr>
<div class="w3-container">
  <h5>UDM OSLAMS | Dashboard</h5>
</div>
<div class="w3-bar-block">
  <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
  <a href="applicantDashboard.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Overview</a>
  <a href="viewTenant.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-user-circle-o"></i>  User Details</a>
  <a href="viewBooking.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-calendar-plus-o"></i>  View Booking</a>
  <a href="../landlord/propertyOnRentsB.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Property on Rent</a>
  <a href="contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope"></i>  Contact Us</a> 
</div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:33px">
   <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> View Booking</b></strong></h4>
 </header>

 <!-- START of Container to have Form for Tenant -->
 <div class="w3-container">
  <div class="panel panel-primary shadow">
    <div class="panel-heading"><h4><center>List of Property Bookings Made by Student</center></h4>
    </div>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead >
          <tr>
            <th scope="col">Booking ID</th>
            <th scope="col">Property Type</th>
            <th scope="col">Deposit Fee</th>
            <th scope="col">Location</th>
            <th scope="col">Booking Date</th>
            <th scope="col">Start Date</th>
            <th scope="col">Booking Duration</th>
            <th scope="col">Booking Status</th>
            <th scope="col">Remarks</th>
            <th scope="col">Cancel Booking</th>
          </tr>
        </thead>
        <?php foreach($listBooking as $row) { ?>
          <tbody>
            <tr>
              <td><?php echo $row['bookingID']; ?></td>
              <td><?php echo $row['type']; ?></td>
              <td>Rs <?php echo $row['depositFee']; ?></td>
              <td><?php echo $row['address']; ?></td>
              <td><?php echo $row['bookingDate']; ?></td>
              <td><?php echo $row['startDate']; ?></td>
              <td><?php echo $row['duration']; ?> Month(s)</td>
              <td><?php echo $row['status']; ?></td>
              <td><?php echo $row['remarks']; ?></td>
              <td> 
                  <?php if($row['status']!="Approved")
                echo "<a  onclick='update()' class='btn btn-danger' href='viewBooking.php?action=delete&QStrbookingID=".$row['bookingID']."'>Cancel</a>"; ?></td>
            </tr>
          </tbody>
        <?php } ?>
      </table>
    </div>
  </div>
</div>


<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-light-grey">
  <center><h5>&copy; 2021 UDM OSLAMS | By Gitendra</h5></center>
</footer>

<!-- End page content -->


<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
</body>
</html>