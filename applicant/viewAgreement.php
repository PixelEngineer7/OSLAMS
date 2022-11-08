<?php
  /* Script to comminicate with Database for POST*/
    session_start();
    require '../controller/Database.php';
    require '../controller/tenant.php';
    require '../controller/user.php';
    require '../controller/booking.php';
    require '../controller/rental.php';
    require '../controller/property.php';


  
if (isset($_GET['QStrbookingID'],$_GET['QStrrentalID'],$_GET['QStrtenantID'],$_GET['QStrpropertyID']))
  {
    $_SESSION['userID']=(int)($_GET["QStrtenantID"]);
    $_SESSION['propertyID']=(int)($_GET["QStrpropertyID"]);
    $_SESSION['bookingID']=(int)($_GET["QStrbookingID"]);
    $_SESSION['rentalID']=(int)($_GET["QStrrentalID"]);

   
    $database = new DBHandler();
    $viewtenant = new user();
    $viewt=$viewtenant->retrieveUser($_SESSION['username']);
    foreach ($viewt as $tenant) 
    {
      $name=$tenant['name'];
      $surname=$tenant['surname'];
      
    }

    $database = new DBHandler();
    $viewproperty = new property();
    $viewp=$viewproperty->getPropertyInfo($_SESSION['propertyID']);
     foreach ($viewp as $property) 
    {
      $rentalFee=$property['rentalFee'];
      $type=$property['type'];
      $address=$property['address'];
      $depositFee=$property['depositFee']; 
    }

    $database = new DBHandler();
    $viewbooking = new booking();
    $viewb=$viewbooking->getBooking($_SESSION['bookingID']);
    foreach ($viewb as $booking) 
    {
        $duration=$booking['duration'];
    }

    $database = new DBHandler();
    $viewrental =new rental();
    $viewr=$viewrental->getUserRental($_SESSION['rentalID']);
    foreach ($viewr as $rental) 
    {
        $startDate=$rental['startDate'];
        $endDate=$rental['endDate'];

    }

   
  }

  if (isset($_POST['btnSubmit']))
  {
    
    $remarks=$_POST['remarks'];

   $rental = new rental();
   $rental->agreeRental($_SESSION['rentalID'],$remarks);
 }
       
?>


<!DOCTYPE html>
<html>
<title>UDM OSLAMS Tenant | View Rental Offer Dashboard </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="icon" type="image/x-icon" href="../images/favicon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-white w3-large" style="z-index:-1">
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
      <a href="viewBooking.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-calendar-plus-o"></i>  View Booking | Rental</a>
      <a href="../landlord/propertyOnRentsB.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Property on Rent</a>
      <a href="contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope"></i>  Contact Us</a> 
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:73px">
     <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> | View Rental Offer By Landlord</b></h4>
  </header>

<!-- START of Container to have Form for Tenant -->
  <div class="container">
<div class="panel panel-info">
  <div class="panel-heading"><h3><center>Rental Agreement Between Landlord and Tenant</center></h3></div>
  <div class="panel-body">
    <form method="post" enctype="multipart/form-data">
      
    <p>This Rent Agreement Witness As Under: That the Tenant/Lessee will have to pay Rs. <b><?php echo $rentalFee ?> </b> as monthly rent, which does not include electricity and water charges. That the Tenant/Lessee shall not lease the property to a subtenant under any circumstances without the consent of the owner/landlord.</p>

    <p><b>NAME OF TENANT : </b>&nbsp;<b><?php echo $name ?>&nbsp; </b><b><?php echo $surname ?> </b>
    <p><b>PROPERTY TYPE : </b>&nbsp;<?php echo $type ?></p>
    <p><b>PROPERTY ADDRESS : </b>&nbsp;<?php echo $address ?></p>
    <p><b>PROPERTY DEPOSIT FEE (Rs) : </b>&nbsp;<?php echo $depositFee ?></p>
    <p><b>RENTAL DURATION :</b>&nbsp;<?php echo $duration ?> Months</p>

    <p>The Tenant has an obligation to inform the Landlord for any extension of lease within 2 Months prior to expiry of Lease.</p>

     <div class="form-group">
        <label for="">Start Date : </label>
            <?php echo $startDate ?>
          </div>

           <div class="form-group">
              <label for="">End Date : </label>
              <?php echo $endDate ?>
            </div>
  </div>
  <div class="panel-footer">Read And Approved By the Tenant
    <div class="form-group">
              <label for="">Write Read and Approved Following Your Name </label>
              <input class="form-control" type="text" id="remarks" name="remarks">
            </div>

             <button type="submit" id="submit-button" class="btn btn-info" name="btnSubmit" onclick="update()">Accept Agreement</button>&nbsp;
              <a href="viewBooking.php" class="btn btn-warning">Cancel</a> 



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
  function update()
  {
     alert("UDM OSLAMS: Agreement Sent Sucessfully to Landlord!");
  }
</script>

</body>
</html>