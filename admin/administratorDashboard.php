<?php
   //Name:RAMLOCHUND Gitendrajeet 
  //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
  //Scope: Administrator Dashboard
 session_start();
 require '../controller/Database.php';
 require '../controller/user.php';

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
?>
<!DOCTYPE html>
<html lang="en">
<title>UDM OSLAMS | Administrator Dashbord </title>
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
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">
<style>

  html,body,h1,h2,h3,h5,p {font-size: 14px;, font-family: "Arial", sans-serif}
  h4 {font-size: 16px;, font-family: "Arial", sans-serif}
</style>


<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-white w3-large" style="z-index:4">
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
    <a href="administratorDashboard.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="userManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o"></i>  User Registration</a>
    <a href="propertyManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Property Management</a>
    <a href="bookingManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  Booking | Rental Management</a>
    <a href="reports.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file-text-o"></i>  Reports</a>
    <a href="backup.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-database"></i>  Backup | Restore Database</a>
    <a href="contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Contact Us</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:33px">
     <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> | Administrator Dashboard</b></h4>
  </header>

  <!-- START of Container for Welcome messages and Contents -->

  <div class="w3-container">
      <center><h2 style="font-size:20px;" class="text-primary">Welcome to UDM Online Student Lodging Accodomation Management System</h2></center>
    <br>

      <center><h3 style="font-size:20px;" class="p-2 mb-2 bg-info text-white">Informations about Student Lodging</h3></center>
      <h4>Universite Des Mascareignes reserve the right to cancel any booking made through its Online Student Lodging Accomodation Management System (UDM OSLAMS) if ever there are situations that are beyond UDM control i.e Pandemic (COVID-19) , where
      the country will not be operating as usual and where there will be travelling restriction to foreign student. In this light UDM may request concerned party to make any refund or postpone of booking where applicable.
      </h4>

      <center><h3 style="font-size:20px;" class="p-2 mb-2 bg-success text-white">Informations about Student Lodging</h3></center>
      <h4>Universite Des Mascareignes reserve the right to cancel any booking made through its Online Student Lodging Management System (UDM OSLMS) if ever there are situations that are beyond UDM control i.e COVID-19, where
      the country will not be operating as usual and where there will be travelling restriction to foreign student. In this light UDM may request concerned party to make any refund or postpone of booking where applicable.
      </h4>

      <center><h3  style="font-size:20px;" class="p-2 mb-2 w3-indigo text-white">Warning</h3></center>
        <h4>This Online Student Logding Management System is intended only for Univeriste Des Mascareignes Students / Propsect Student / UDM appointed Landlord / and UDM Administrator. Unauthorized access or use of this system may subject you to administrative, civil, or criminal actions, as well as fines or other penalties. In accordance with Federal Regulations, employees have "a duty to protect and conserve Government property and shall not use
        such property, or allow its use, for other than authorized purposes."</h4>

        <h4>If <strong><?php echo $_SESSION['username'];?></strong> , You are not suppozed to be here, We suggest you to log out immediately and displose any logs to UDM Administrator on following email address : <strong style="color:red;">admin@udm.ac.mu</strong></h4>

        <h4>This computer system may be monitored and information disclosed for any lawful purposes, including for the management and maintenance of the system, to ensure that the system is authorized to facilitate protection against unauthorized access, and to verify security procedures, survivability and operational security. </h4>

  </div>

<br>


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