<?php
    //Name:RAMLOCHUND Gitendrajeet 
    //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
    //Scope: Administrator Dashboard / View Property on Rent
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
        //.....Continue;
      }
      else if ($security[0]['category'] !='Administrator')
      {
        header("location:../controller/logout.php");
      }

    $database = new DBHandler();
    $property = new property();
    $propertyRent=$property->propertyOnRent($database);
    


?>
<!DOCTYPE html>
<html>
<title>UDM OSLAMS Administrator | Property On Rent </title>
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
  html,body,h1,h3,h4,h5 {font-size: 14px;, font-family: "Arial", sans-serif}

  p,h2{font-size: 12px;, font-family: "Arial", sans-serif}

  h4{font-size: 18px;, font-family: "Arial", sans-serif}

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


<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-white w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-blue" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
  <span class="w3-bar-item w3-right"><img src="../images/minLogo.png"   alt="" >&nbsp; &nbsp;<h3 style="display: inline-block">Online Student Lodging Accomodation Management System</h3></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-light w3-animate-left" style="z-index:4;width:300px;" id="mySidebar">
    <div class="w3-container">
      <center><img src="../images/adminIco.gif" class="img-responsive" alt="" style="width:80px;"></center>
      <br>
      <span>Welcome, <strong><?php echo $_SESSION['username'];?></strong></span><br>
      <a href="../controller/logout.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>
      <a href="../admin/viewProfile.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>UDM OSLAMS | Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-grey" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="../admin/administratorDashboard.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="../admin/userManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o"></i>  User Registration</a>
    <a href="../admin/propertyManagement.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-home"></i>  Property Management</a>
    <a href="../admin/bookingManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  Rental | Booking Management</a>
    <a href="../admin/reports.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file-text-o"></i>  Reports</a>
    <a href="../admin/backup.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-database"></i>  Backup | Restore Database</a>
    <a href="contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope"></i>  Contact Us</a>

    
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:43px">
    <h4><center>List of Property Available for Booking</center></h4>
     
  </header>

  <!-- START of Container for Welcome messages and Contents -->
<div class="container">
 
<div class="row">
   <?php foreach ( $propertyRent as $row) { ?>
          
              <div class="card">
                  <?php echo "<img src = 'images/" . $row['pictures'] ."' '>";?>
                  <div class="card-body">

                      <h2 class="card-text"><b>Type : </b><?php echo $row['type']; ?></h2>
                       <h2 class="card-text"><b>Property ID : </b><?php echo $row['propertyID']; ?></h2>
                      <p class="card-text"><b>Property Rating :</b> <?php echo $row['rating']; ?> <i class="fa fa-star" aria-hidden="true"></i>Star</p>
                      <p class="card-text"><b>Accomodation Capacity :</b> <?php echo $row['capacity']; ?></p>
                      <p class="card-text"><b>Deposit Fee (Rs) :</b> <?php echo $row['depositFee']; ?></p>
                      <p class="card-text"><b>Rental Fee (Rs) :</b> <?php echo $row['rentalFee']; ?></p>
                      <p class="card-text"><b>Property Area :</b> <?php echo $row['area']; ?><b> ㎡</b></p>
                      <p class="card-text"><b>Property Address :</b> <?php echo $row['address']; ?></p>
                      <p class="card-text"><b>Distance :</b> <?php echo $row['distance']; ?> Kilometers (Km) From Campus</p>
                      <p class="card-text"><b>Wireless Internet <i class="fa fa-wifi" aria-hidden="true"></i> :</b> <?php  if ((int)$row['wifi']==1)
                                                                                    echo "YES";
                                                                                  else
                                                                                    echo "NO";?></p>
                      <p class="card-text"><b>Kitchen Available : </b><?php  if ((int)$row['kitchen']==1)
                                                                                    echo "YES";
                                                                                  else
                                                                                    echo "NO";?></p>
                      <p class="card-text"><b>Bathroom <i class="fa fa-bath" aria-hidden="true"></i> Available :</b> <?php  if ((int)$row['bathroom']==1)
                                                                                    echo "YES";
                                                                                  else
                                                                                    echo "NO";?>
                      <p class="card-text"><b >Other Facilities : </b><?php echo $row['otherFacilities']; ?></p>
                      <p class="card-text"><b>Status : </b> <span class="badge bg-primary"><?php echo $row['status']; ?></span></p>
                  </div>
                  
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
  width: 20rem;
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