<?php

   //Name:RAMLOCHUND Gitendrajeet 
   //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
   //Scope: Landlord Dashboard / Creation of Booking
session_start();
require_once(__DIR__.'/../controller/property.php');
require_once(__DIR__.'/../controller/user.php');
require_once(__DIR__.'/../controller/booking.php');
require_once(__DIR__.'/../controller/landlord.php');

$database=new DBHandler();
$verify= new user();

$security=$verify->securityCheck($_SESSION['username']);
if($security[0]['category'] =='Tenant')
{
 
}
else if ($security[0]['category'] !='Tenant')
{
  header("location:../controller/logout.php");
}

if (isset($_GET['QStrpropertyID']))
{
  $_SESSION['propertyID']=(int)($_GET["QStrpropertyID"]);


  $property=new property();
  $getlandlordID=$property->getlandlordID($_SESSION['propertyID']);
  foreach ($getlandlordID as $row) 
  {
    $_SESSION['landlordID']=(int)$row['landlordID'];

  }

  $user = new user();
  $test = $user->getUserID($_SESSION['username']);
  foreach ($test as $row) 
  {
    $_SESSION['userID']=$row['userID'];

  }
}

if (isset($_POST['btnSubmit']))
{
  
  $userID=$_SESSION['userID'];
  $propertyID=$_SESSION['propertyID'];
  $landlordID=$_SESSION['landlordID'];
  $bookingDate=$_POST['bookingDate'];
  $startDate=$_POST['startDate'];
  $duration=$_POST['duration'];
  $status=$_POST['status'];
  $remarks=$_POST['remarks'];

  $booking = new booking();
  $booking->addBooking($userID,$propertyID,$landlordID,$bookingDate,$startDate,$duration,$status,$remarks);
  header('location:propertyOnRent.php');
  
}
?>
<!DOCTYPE html>
<html lang="en-US">
<title>UDM OSLAMS Tenant | Property Booking</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="icon" type="image/x-icon" href="../images/favicon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

<style>

  html,body,h1,h2,h3,h4,h5,p {font-size: 14px;, font-family: "Arial", sans-serif}
</style>


<body class="w3-light-grey">

  <!-- Top container -->
  <div class="w3-bar w3-top w3-white w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-blue" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
    <span class="w3-bar-item w3-right"><img src="../images/minLogo.png"   alt="" >&nbsp; &nbsp;<h3 style="display: inline-block">Online Student Lodging Accomodation Management System</h3></span>
  </div>

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-light w3-animate-left" style="z-index:4;width:300px;" id="mySidebar">
    
    <div class="w3-container">
      <center><img src="../images/minUserTenant.png" class="img-responsive" alt="Tenant Logo" style="width:80px;"></center>
      <br>
      <span>Welcome, <strong><?php echo $_SESSION['username'];?></strong></span><br>
      <a href="../controller/logout.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>
      <a href="../tenant/viewProfile.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>UDM OSLAMS | Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="../tenant/tenantDashboard,php" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="../tenant/viewTenant.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="../tenant/viewTenant.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o"></i>  User Details</a>
    <a href="../tenant/viewBooking.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  View Booking | Rental</a>
    <a href="../landlord/propertyOnRent.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-home"></i>  Property on Rent</a>
    <a href="../tenant/contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope"></i>  Contact Us</a>

    
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:33px">
   <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> | Tenant Dashboard</b></h4>
 </header>


 

 <!-- START of Container for Welcome messages and Contents -->

 <div class="w3-container">
  <div class="form">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h2 style="font-size:20px;" class="text-center">Booking of Property</h2>
      </div>
      <div class="panel-body">
        <form method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label for="">Booking Date</label>
            <input class="form-control" type="date" id="start" name="bookingDate"  min="2021-01-01" max="2023-12-31" required>
          </div>

          <div class="form-group">
            <label for="">Start Date</label>
            <input  class="form-control" type="date" id="end" name="startDate"  min="2021-01-01" max="2023-12-31" required>
          </div>

          <div class="form-group">
            <label for="">Booking Duration</label>
            <input  class="form-control" type="number" id="duration" name="duration" min="1" max="12" required>
          </div>

          <div class="form-group">
            <label for="">Remarks </label>
            <input class="form-control" type="text" id="remarks" name="remarks">
          </div>

          <div class="form-group">
            <div class="form-check form-check-inline">
              <input type="hidden" class="form-check-input" type="radio" name="status" id="inlineRadio2" value="Pending">
              
            </div>      
          </div>

          <button type="submit" id="submit-button" class="btn btn-info" name="btnSubmit">Book Property</button>&nbsp;
          <a href="propertyOnRent.php" class="btn btn-warning">Cancel</a>   
        </form>
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
<script>
  function update()
  {
   alert("UDM OSLAMS: Booking of Property Sucessfull!!!");
 }
</script>
<script>
  var start = document.getElementById('start');
  var end = document.getElementById('end');

  start.addEventListener('change', function() {
    if (start.value)
      end.min = start.value;
  }, false);
  end.addEventLiseter('change', function() {
    if (end.value)
      start.max = end.value;
  }, false);
</script>

</body>
</html>