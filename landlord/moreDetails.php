<?php
  //Name:RAMLOCHUND Gitendrajeet 
  //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
  //Scope: Tenant Dashboard / List of Porperty On rent
session_start();
require '../controller/Database.php';
require '../controller/user.php';
require '../controller/property.php';

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
  $row=$property->getPropertyInfo($_SESSION['propertyID']);

}
?>
<!DOCTYPE html>
<html>
<title>UDM OSLAMS Tenant | Property On Rent </title>
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
  <div class="w3-bar w3-top w3-white w3-large" style="z-index:3">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-blue" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
    <span class="w3-bar-item w3-right"><img src="../images/minLogo.png"   alt="" >&nbsp; &nbsp;<h3 style="display: inline-block">Online Student Lodging Accomodation Management System</h3></span>
  </div>

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-light w3-animate-left" style="z-index:4;width:300px;" id="mySidebar">

    <div class="w3-container">
      <center><img src="../images/minUserTenant.png" class="img-responsive" alt="" style="width:80px;"></center>
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
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="../tenant/tenantDashboard.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="../tenant/viewTenant.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o"></i>  User Details</a>
    <a href="../tenant/viewBooking.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  View Booking | Rental</a>
    <a href="propertyOnRent.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-home"></i>  Property on Rent</a>
    <a href="../tenant/contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope"></i>  Contact Us</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:33px">
   <h4 style="font-size:20px;" ></strong>&nbsp;<b>More Details of Property : <?php echo $row[0]['type']; ?> </b></h4>
 </header>

 <!-- START of Container for Welcome messages and Contents -->
 <section style="background-color: #eee;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="card text-black shadow" style="width: 38rem;">
        <h4><center><b><?php echo $row[0]['type']; ?></b></center></h4>
        <?php echo "<img src = 'images/" . $row[0]['pictures'] ."' '>";?>
        <div class="card-body">
          <div class="text-center">
            <h5 class="card-title"><b>Type : </b><?php echo $row[0]['type']; ?></h5>
            <p class="card-txt"><b><i>Property Rating :</b> <?php echo $row[0]['rating']; ?> <i class="fa fa-star" aria-hidden="true"></i> Stars</i></p>
          </div>
          <div>
           <p class="card-text"><b>Accomodation Capacity :</b> <?php echo $row[0]['capacity']; ?> Person</p>
           <p class="card-text"><b>Deposit Fee (Rs) :</b> <?php echo $row[0]['depositFee']; ?></p>
           <p class="card-text"><b>Rental Fee (Rs) :</b> <?php echo $row[0]['rentalFee']; ?></p>
           <p class="card-text"><b>Property Area :</b> <?php echo $row[0]['area']; ?><b> ㎡</b></p>
           <p class="card-text"><b>Property Address :</b> <?php echo $row[0]['address']; ?></p>
           <p class="card-text"><b>Distance :</b> <?php echo $row[0]['distance']; ?> Kilometers (Km) From Nearest UDM Campus</p>
           <p class="card-text"><b>Wireless Internet Connection  :</b> <?php  if ((int)$row[0]['wifi']==1)
           echo "YES";
           else
            echo "NO";?> </p>
          <p class="card-text"><b>Kitchen Facilities Available : </b><?php  if ((int)$row[0]['kitchen']==1)
          echo "YES";
          else
            echo "NO";?></p>
          <p class="card-text"><b>Bathroom Facilities Available :</b> <?php  if ((int)$row[0]['bathroom']==1)
          echo "YES";
          else
            echo "NO";?>
          <p class="card-text"><b >Other Facilities : </b><?php echo $row[0]['otherFacilities']; ?></p>
          <p class="text-center"><b>Status : </b> <span class="badge bg-primary"><?php echo $row[0]['status']; ?></span></p>
        </div>
        &nbsp;
        <div class="card-txt">
          <center>
           <?php echo "<a  class='btn btn-success' href='propertyBooking.php?action=update&QStrpropertyID=".$row[0]['propertyID']."'>Book Here</a>"; ?> &nbsp;&nbsp; <?php echo "<a  class='btn btn-danger' href='propertyOnRent.php'>Cancel</a>"; ?> </center>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</section>
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
<style>

  div.card
  {
    padding-top: 10px;
    width: 22rem;
    margin-left: 10px;
    margin-top: 10px;

  }
  div.card-txt
  {
   padding-bottom: 10px;

 }
</style>

</body>
</html>