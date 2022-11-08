<?php
 //Name:RAMLOCHUND Gitendrajeet 
 //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
 //Scope: Reports | Report Management Dashboard
session_start();

require '../controller/Database.php';
require '../controller/landlord.php';
require '../controller/user.php';
require '../controller/property.php';

$database=new DBHandler();
$verify= new user();

$security=$verify->securityCheck($_SESSION['username']);
if($security[0]['category'] =='Administrator')
{

}
else if ($security[0]['category'] !='Administrator')
{
  header("location:../controller/logout.php");
}

$database = new DBHandler();
$viewProperty = new property();
$propertyview=$viewProperty->getAllProperty($database);
?>
<!DOCTYPE html>
<html lang="en">
<title>UDM OSLAMS Administrator | Reports Dashboard </title>
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
<style> 
  .card{
    transition: border-color 1s, box-shadow 0.5s;
  }
  .card:hover {
    border-color: rgba(13, 110, 253, 0.7);
    box-shadow: 0px 0px 10px 2px rgba(13, 110, 253, 0.6);
  }

</style>

<body class="w3-light-grey">

  <!-- Top container -->
  <div class="w3-bar w3-top w3-white w3-large" style="z-index:3">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-Black" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
    <span class="w3-bar-item w3-right"><img src="../images/minLogo.png"   alt="" >&nbsp; &nbsp;<h3 style="display: inline-block">Online Student Lodging Accomodation Management System</h3></span>
  </div>
  
  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-light w3-animate-left" style="z-index:4;width:300px;" id="mySidebar">
    <div class="w3-container">
      <center><img src="../images/adminIco.gif" class="img-responsive" alt="" style="width:80px;"></center>
      <br>
      <span>Welcome, <strong><?php echo $_SESSION['username'];?></strong></span><br>
      <a href="../controller/logout.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>UDM OSLAMS | Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-grey" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="administratorDashboard.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="userManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o"></i>  User Registration</a>
    <a href="propertyManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Property Management</a>
    <a href="bookingManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  Booking | Rental Management</a>
    <a href="reports.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-file-text-o"></i>  Reports</a>
    <a href="backup.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-database"></i>  Backup | Restore Database</a>
    <a href="contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Contact Us</a>

    
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
	<header class="w3-container" style="padding-top:33px">
    <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> Report Management Dashboard</b></h4>
    
  </header>
  <div class="w3-container">
    <h3><center><u>Users Reports</u></center></h3>
    <div class="m-4">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card">
            <center><img src="../images/tenant.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
            <div class="card-body">
              <center><h5 class="card-title">Tenant Registered on the system</h5></center>
              <center><p class="card-text">List all tenant registered on the system</p></center>
            </div>
            <div class="card-footer">
              <center><button type="cancel" class="btn btn-success" onclick="javascript:window.location='reportsTenant.php';">Generate Report</button></center>
            </div>
            
          </div>

        </div>
        <div class="col">
          <div class="card">
           <center><img src="../images/landlord.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
           <div class="card-body">
             <center><h5 class="card-title">Landlord Registered on the system</h5></center>
             <center><p class="card-text">List all landlord registered on the system</p></center>
           </div>
           <div class="card-footer">
             <center><button type="cancel" class="btn btn-info" onclick="javascript:window.location='reportsLandlord.php';">Generate Report</button></center>
           </div>
         </div>
       </div>
       <div class="col">
        <div class="card">
          <center><img src="../images/minStudent.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
          <div class="card-body">
            <center> <h5 class="card-title">Student Registered on the system</h5></center>
            <center><p class="card-text">List all registered Prospect Student </p></center>
          </div>
          <div class="card-footer">
           <center><button type="cancel" class="btn btn-danger" onclick="javascript:window.location='reportStudent.php';">Generate Report</button></center>
         </div>
       </div>
     </div>
   </div>
 </div>

 <h3><center><u>Property Reports</u></center></h3>
 <div class="m-4">
  <div class="row row-cols-1 row-cols-md-3 g-4">

    <div class="col">
      <div class="card">
        <center><img src="../images/register1.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
        <div class="card-body">
          <center><h5 class="card-title">Registered property on the system</h5></center>
          <center><p class="card-text">List all property registered on the system</p></center>
        </div>
        <div class="card-footer">
          <center><button type="cancel" class="btn btn-secondary" onclick="javascript:window.location='reportProperty.php';">Generate Report</button></center>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
       <center><img src="../images/pro3.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
       <div class="card-body">
         <center><h5 class="card-title">Property available for rent</h5></center>
         <center><p class="card-text">List all property available for rent</p></center>
       </div>
       <div class="card-footer">
         <center><button type="cancel" class="btn btn-warning" onclick="javascript:window.location='reportPropertyAvail.php';">Generate Report</button></center>
       </div>
     </div>
   </div>

 </div>
</div>



<h3><center><u>Booking Reports</u></center></h3>
<div class="m-4">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">

      <div class="card">
        <center><img src="../images/confirmedBook.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
        <div class="card-body">
          <center><h5 class="card-title">Confirmed Booking on the system</h5></center>
          <center><p class="card-text">List all confirmed booking of property</p></center>
        </div>
        <div class="card-footer">
          <center><button type="cancel" class="btn btn-outline-primary" onclick="javascript:window.location='reportConfirmedBooking.php';">Generate Report</button></center>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
       <center><img src="../images/cancelBook.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
       <div class="card-body">
         <center><h5 class="card-title">Cancelled Booking</h5></center>
         <center><p class="card-text">List all cancelled booking of property</p></center>
       </div>
       <div class="card-footer">
         <center><button type="cancel" class="btn btn-outline-success" onclick="javascript:window.location='reportCancelledBooking.php';">Generate Report</button></center>
       </div>
     </div>
   </div>

   <div class="col">
    <div class="card">
      <center><img src="../images/allBook.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
      <div class="card-body">
        <center> <h5 class="card-title">List all Bookings</h5></center>
        <center><p class="card-text">List all bookings made by users</p></center>
      </div>
      <div class="card-footer">
       <center><button type="cancel" class="btn btn-outline-danger" onclick="javascript:window.location='reportAllBooking.php';">Generate Report</button></center>
     </div>
   </div>
 </div>

</div>
</div>

<h3><center><u>Rentals Reports</u></center></h3>
<div class="m-4">
  <div class="row row-cols-1 row-cols-md-3 g-4">

    <div class="col">
      <div class="card">
        <center><img src="../images/rent.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
        <div class="card-body">
          <center><h5 class="card-title">Confimed Rentals</h5></center>
          <center><p class="card-text">List all confirmed rental of property</p></center>
        </div>
        <div class="card-footer">
          <center><button type="cancel" class="btn btn-danger" onclick="javascript:window.location='reportRentalConfirmed.php';">Generate Report</button></center>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
       <center><img src="../images/terminate.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
       <div class="card-body">
         <center><h5 class="card-title">Terminated Rentals</h5></center>
         <center><p class="card-text">List all terminated rentals of property</p></center>
       </div>
       <div class="card-footer">
         <center><button type="cancel" class="btn btn-warning" onclick="javascript:window.location='reportRentalTerminated.php';">Generate Report</button></center>
       </div>
     </div>
   </div>
   

   <div class="col">
    <div class="card">
      <center><img src="../images/viewRental.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
      <div class="card-body">
        <center> <h5 class="card-title">List all Rentals</h5></center>
        <center><p class="card-text">List all rentals of property</p></center>
      </div>
      <div class="card-footer">
       <center><button type="cancel" class="btn btn-success" onclick="javascript:window.location='reportRentalAll.php';">Generate Report</button></center>
     </div>
   </div>
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