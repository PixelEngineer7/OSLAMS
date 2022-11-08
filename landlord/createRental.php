
<?php
  //Name:RAMLOCHUND Gitendrajeet 
  //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
  //Scope: Landlord Dashboard / Create New Rental for Tenant.
session_start();
require '../controller/Database.php';
require '../controller/landlord.php';
require '../controller/user.php';
require '../controller/property.php';
require '../controller/booking.php';
require '../controller/rental.php';
$database=new DBHandler();
$verify= new user();

$security=$verify->securityCheck($_SESSION['username']);
if($security[0]['category'] =='Landlord')
{

}
else if ($security[0]['category'] !='Landlord')
{
  header("location:../controller/logout.php");
}


if (isset($_GET['QStrbookingID'] , $_GET['QStrlandlordID'] , $_GET['QStruserID'] , $_GET['QStrpropertyID']))
{
  $_SESSION['bookingID']=(int)($_GET["QStrbookingID"]);
  $_SESSION['landlordID']=(int)($_GET["QStrlandlordID"]);
  $_SESSION['userID']=(int)($_GET["QStruserID"]);
  $_SESSION['propertyID']=(int)($_GET["QStrpropertyID"]);

  $database=new DBHandler();
  $user=new user();
  $getuser=$user->getUserInfo($_SESSION['userID']);


  $database=new DBHandler();
  $getDetails=new property();
  $get=$getDetails->getPropertyInfo($_SESSION['propertyID']);


  $database = new DBHandler();
  $viewBooking = new booking();


  $database = new DBHandler();
  $viewBooking = new booking();
  $booking=$viewBooking->getBooking($_SESSION['bookingID']);



  $userID=$booking[0]['userID'];  

  $user =new user();
  $rows=$user->getUserDetail($userID);
  $username=$rows[0]['username'];

  $tenant=new tenant();
  $email=$tenant->getEmail($username);
}
$to = $email[0]['email'];
$subject = 'UDM OSLAMS Notification';
$message = 'Hi User , The UDM Online Student Lodging Accomodation Management System (OSLAMS) Landlord has just created a rental of the booked property.Kindly login account to verify';
$headers = 'From: noreply@oslams.udm.ac.mu';

if (isset($_POST['btnSubmit']))
{
  $startDate=$_POST['startDate'];
  $endDate=$_POST['endDate'];
  $status=$_POST['status'];
  $remarks=$_POST['remarks'];
  $bscAddress=$_POST['bscAddress'];
  $rental = new rental();
  $rental->addrental($_SESSION['userID'],$_SESSION['propertyID'],$_SESSION['landlordID'],$_SESSION['bookingID'],$startDate,$endDate,$status);
  mail($to,$subject,$message,$headers);
  header('location:manageRental.php');
}
?>
<!DOCTYPE html>
<html>
<title>UDM OSLAMS Landlord | Booking Management Dashboard </title>
<meta charset="UTF-8">
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
  <div class="w3-bar w3-top w3-white w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-blue" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
    <span class="w3-bar-item w3-right"><img src="../images/minLogo.png"   alt="" >&nbsp; &nbsp;<h3 style="display: inline-block">Online Student Lodging Accomodation Management System</h3></span>
  </div>
  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-light w3-animate-left" style="z-index:4;width:300px;" id="mySidebar">
    <div class="w3-container">
      <center><img src="../images/landlord.jpg" class="img-responsive" alt="" style="width:80px;"></center>
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
    <a href="landlordDashboard.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="viewLandlord.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o"></i>  User Details</a>
    <a href="bookingManagement.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-calendar-plus-o"></i>  Booking | Rental Management</a>
    <a href="propertyManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Property Management</a>
     <a href="reports.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file-text-o"></i>  Reports</a>
    <a href="contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope"></i>  Contact Us</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
  <!-- Header -->
  <header class="w3-container" style="padding-top:33px">
   <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> | Rental Management Dashboard</b></h4>
 </header>

 <!-- START of Container for Welcome messages and Contents -->
 <div class="w3-container">
  <div class="panel panel-info shadow">
    <div class="panel-heading"><h3><center>Rental Agreement Between Landlord and Tenant</center></h3></div>
    <div class="panel-body">
      <form method="post" enctype="multipart/form-data">
        <p>This Rent Agreement Witness As Under: That the Tenant/Lessee will have to pay Rs. <b><?php echo $get[0]['rentalFee'] ?> </b> as monthly rent, which does not include electricity and water charges. That the Tenant/Lessee shall not lease the property to a subtenant under any circumstances without the consent of the owner/landlord.</p>

        <p><b>NAME OF TENANT : </b>&nbsp;<b><?php echo $getuser[0]['name'] ?>&nbsp; </b><b><?php echo $getuser[0]['surname'] ?> </b>
          <p><b>PROPERTY TYPE : </b>&nbsp;<?php echo $get[0]['type'] ?></p>
          <p><b>PROPERTY ADDRESS : </b>&nbsp;<?php echo $get[0]['address'] ?></p>
          <p><b>PROPERTY DEPOSIT FEE (Rs) : </b>&nbsp;<?php echo $get[0]['depositFee'] ?></p>
          <p><b>RENTAL DURATION :</b>&nbsp;<?php echo $booking[0]['duration'] ?> Months</p>

          <p>The Tenant has an obligation to inform the Landlord for any extension of lease within 2 Months prior to expiry of Lease.</p>

          <div class="form-group">
            <label for="">Start Date</label>
            <input  class="form-control" type="date"  id="start" name="startDate"   max="2022-12-31" required>
          </div>

          <div class="form-group">
            <label for="">End Date</label>
            <input  class="form-control" type="date" id="end"  name="endDate"  max="2022-12-31" required>
          </div>

        </div>
          <div class="form-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="hidden" name="status" id="inlineRadio1" value="Pending" checked>
              
            </div>  
          </div>
          </div>
          <button type="submit" id="submit-button" class="btn btn-info" name="btnSubmit" onclick="update()">Rent Property</button>&nbsp;
          <a href="manageRental.php" class="btn btn-warning">Cancel</a> 
        </div>
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