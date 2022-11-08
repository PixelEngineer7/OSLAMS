<?php
  //Name:RAMLOCHUND Gitendrajeet 
  //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
  //Scope: Properties More Details with Booking
  session_start();
    require '../controller/Database.php';
    require '../controller/landlord.php';
    require '../controller/user.php';
    require '../controller/property.php';

    $database=new DBHandler();
    $verify= new user();

    $security=$verify->securityCheck($_SESSION['username']);
      if($security[0]['category'] =='Student')
      {
       
      }
      else if ($security[0]['category'] !='Student')
      {
        header("location:../controller/logout.php");
      }
  

    $database = new DBHandler();
    $property = new property();
    //Data is being return i form of an associative array
    $propertyRent=$property->propertyOnRent($database);
?>
<!DOCTYPE html>
<html lang="en">
<title>UDM OSLAMS Tenant | Property On Rent </title>
meta charset="UTF-8">
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

  html,h1,h2,h3,h4 {font-size: 14px;, font-family: "Arial", sans-serif}

  h3,h5,p {font-size: 14px;, font-family: "Arial", sans-serif}
</style>
<style>
  .card{
  transition: border-color 1s, box-shadow 0.5s;
}
.card:hover {
  border-color: rgba(13, 110, 253, 0.7);
  box-shadow: 0px 0px 10px 2px rgba(13, 110, 253, 0.6);
}
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: yellowgreen;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 20px;
}

#myBtn:hover {
  background-color: #555;
}
</style>

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
      <a href="../applicant/viewProfile.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>UDM OSLAMS | Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="../applicant/applicantDashboard.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="../applicant/viewTenant.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o"></i>  User Details</a>
    <a href="../applicant/viewBooking.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  View Booking | Rental</a>
    <a href="propertyOnRentsB.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-home"></i>  Property on Rent</a>
    <a href="../applicant/contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope"></i>  Contact Us</a>

    
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<!-- Header -->
  <header class="w3-container" style="padding-top:33px">
    <h2 style="font-size:20px;"><center>List of Property Available for Booking</center></h2>
    <div class="w3-container">
  <div class="row">
    <div class="col">
    </div>
     <div class="col">
            <div class="input-group">
                 <form action="search.php" method="post">
        <b>Search Property on OSLAMS : </b><input type="text" name="term" placeholder=" Property Address" /><button type="submit"><i class="fa fa-search"></i></button>
        <div><small>*Searching using Address or will overwrite all other search criteria*</small></div>
     
      </form>
            </div>
    </div>
  </div>
</div>
  </header>
  <!-- START of Container for Welcome messages and Contents -->
<div class="w3-container">
<div class="row">
   <?php foreach ( $propertyRent as $row) { ?>
          
              <div class="card">
                <center><h5 class="card-text"><b>Type : </b><?php echo $row['type']; ?></h5></center>
                &nbsp;
                 <?php echo "<img src = 'images/" . $row['pictures'] ."' '>";?>
                  <div class="card-body">
                      
                      <p class="card-text"><b>Property Rating :</b> <?php echo $row['rating']; ?> <i class="fa fa-star" aria-hidden="true"></i> Star</p>
                      <p class="card-text"><b>Location :</b> <?php echo $row['address']; ?></p>
                      <p class="card-text"><b>Montly Rental(Rs) :</b> <?php echo $row['rentalFee']; ?></p>
                      <p class="card-text"><b>Status : </b> <span class="badge bg-primary"><?php echo $row['status']; ?></span></p>
                  </div>
                  <div class="card-txt">
                      <center><?php echo "<a  class='btn btn-success' href='propertyBooking.php?action=update&QStrpropertyID=".$row['propertyID']."'>Book Here</a>"; ?></center>
                  </div>
                  <div class="card-txt">
                    <center><?php echo "<a  class='btn btn-primary' href='moreDetails.php?action=update&QStrpropertyID=".$row['propertyID']."'>More Details..</a>"; ?></center>
                  </div>
                  &nbsp;
              </div>
        
         <?php } ?>
      </div>
       <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"> Top</i></button>
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
<style>
  
div.card
{
  padding-top: 10px;
  width: 16rem;
  margin-left: 10px;
  margin-top: 10px;

}
div.card-txt
{
 padding-bottom: 10px;

}
</style>

<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
</body>
</html>