<?php
  //Name:RAMLOCHUND Gitendrajeet 
  //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
  //Scope: Landlord Dashboard / Modify Property on OSLAMS
require_once(__DIR__.'/../controller/property.php');
require '../controller/user.php';

session_start();

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


if (isset($_GET['QStrpropertyID']))
{
  $_SESSION['propertyID']=(int)($_GET["QStrpropertyID"]);
  $property=new property();
  $row=$property->getPropertyInfo($_SESSION['propertyID']);

}

if (isset($_POST['btnSubmit']))
{

 $propertyID=$_SESSION['propertyID'];
 $rating=$_POST['rating'];
 $capacity=$_POST['capacity'];
 $rentalFee=$_POST['rentalFee'];
 $depositFee=$_POST['depositFee'];
 $wifi=$_POST['wifi'];
 $bathroom=$_POST['bathroom'];
 $kitchen=$_POST['kitchen'];
 $otherFacilities=$_POST['otherFacilities'];
 
 $p= new property();
 $p->modifyProperty($propertyID,$rating,$capacity,$rentalFee,$depositFee,$wifi,$bathroom,$kitchen,$otherFacilities);
 header('location:propertyStatus.php');

}
?>
<!DOCTYPE html>
<html>
<title>UDM OSLAMS Landlord | Property Management Dashboard </title>
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
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-Black" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
    <span class="w3-bar-item w3-right"><img src="../images/minLogo.png"   alt="" >&nbsp; &nbsp;<h3 style="display: inline-block">Online Student Lodging Accomodation Management System</h3></span>
  </div>
  <br>
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
    <a href="bookingManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  Booking | Rental Management</a>
    <a href="propertyManagement.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-home"></i>  Property Management</a>
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
   <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> | Property Management Dashboard</b></h4>
 </header>

 <!-- START of Container for Welcome messages and Contents -->
 <div class="w3-container">
  <div class="form">
    <div class="panel panel-warning shadow">
      <div class="panel-heading">

        <h4 class="text-center">Property Modification By Landlord</h4>
      </div>

      <div class="panel-body">
        <form method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label for="">Property ID :</label>
            <?php echo $row[0]['propertyID']; ?>
          </div>

          <div class="form-group">
           <label for="">Property Type : </label>
           <?php echo $row[0]['type']; ?>
         </div>

         <div class="form-group">
          <label for="">Property Rating :</label>
          <?php echo "<select name='rating' class='form-control' value='".$row[0]['rating']."'>";?>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>

      <div class="form-group">
        <label for="">Property Capacity :</label>
        <?php echo "<select name='capacity' class='form-control' value='".$row[0]['capacity']."'>";?>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
    </div>

    <div class="form-group">
      <label for="">Monthly Rental Fee (Rs.) </label> &nbsp;  &nbsp;
      <?php echo "<input type='number' pattern='[0-9]+([\.][0-9]+)?' min ='0.00' step='0.01' max='9999.99' required name='rentalFee' class='form-control' value='".$row[0]['rentalFee']."'>";?>
    </div>

    <div class="form-group">
      <label for="">Deposit Fee (Rs.) </label> &nbsp;  &nbsp;
      <?php echo "<input type='number' pattern='[0-9]+([\.][0-9]+)?' min ='0.00' step='0.01' max='9999.99' required name='depositFee' class='form-control' value='".$row[0]['depositFee']."'>";?>
    </div>

    <div class="form-group">
      <label for="">WiFi Available  </label>
      <?php echo "<select name='wifi' class='form-control' value='".$row[0]['wifi']."'>";?>
      <option value="1">YES</option>
      <option value="0">NO</option>
    </select>
  </div>

  <div class="form-group">
    <label for="">Bathroom Available  </label>
    <?php echo "<select name='bathroom' class='form-control' value='".$row[0]['bathroom']."'>";?>
    <option value="1">YES</option>
    <option value="0">NO</option>
  </select>
</div>

<div class="form-group">
  <label for="">Kitchen Available  </label>
  <?php echo "<select name='kitchen' class='form-control' value='".$row[0]['kitchen']."'>";?>
  <option value="1">YES</option>
  <option value="0">NO</option>
</select>
</div>

<div class="form-group">
  <label for="">Other Facilities</label>
  <?php echo "<input type='text' name='otherFacilities' class='form-control' value='".$row[0]['otherFacilities']."'>";?> 
</div>
<br>
<button type="submit" id="submit-button" class="btn btn-primary" name="btnSubmit" onclick="update()">Update Property</button> &nbsp;
<a href="propertyStatus.php" class="btn btn-warning">Cancel</a>   
</form>
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
<script>
  function update()
  {
    alert(" UDM OSLAMS: Property Updated Sucessfully!!!");
  }

</script>

</body>
</html>