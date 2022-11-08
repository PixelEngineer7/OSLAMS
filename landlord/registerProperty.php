
<?php
    //Name:RAMLOCHUND Gitendrajeet 
    //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
    //Scope: Landlord Dashboard / Property Creation Form
session_start(); 
require '../controller/Database.php';
require '../controller/property.php';
require '../controller/landlord.php';
require '../controller/user.php';

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

$_SESSION['landlordID']="";

$database = new DBHandler();
$viewlandlord = new Landlord();
$landlordview=$viewlandlord->retrieveLandlord($_SESSION['username']);

foreach($landlordview as $row)
  $uID=(int)$row['userID'];
$_SESSION['landlordID']=$uID;



if (isset($_POST["btnSubmit"]))
{
  
  $type= $_POST['type'];
  $rating= $_POST['rating'];
  $capacity = $_POST['capacity'];
  $rentalFee = $_POST['rentalFee'];
  $depositFee= $_POST['depositFee'];
  $status= $_POST['status'];
  $area= $_POST['area'];
  $address= $_POST['address'];
  $distance= $_POST['distance'];
  $wifi= $_POST['wifi'];
  $bathroom= $_POST['bathroom'];
  $kitchen= $_POST['kitchen'];
  $pictures= $_FILES['pictures']['name'];
  $otherFacilities= $_POST['otherFacilities'];
  $approved= $_POST['approved'];
  $bscAddress= $_POST['bscAddress'];


  $property  = new property();
  $property->addProperty($_SESSION['landlordID'],$type,$rating,$capacity,$rentalFee,$depositFee,$status,$area,$address,$distance,$wifi,$bathroom,$kitchen,$pictures,$otherFacilities,$approved,$bscAddress);
  header("Location:propertyManagement.php");

  $uploaddir= 'images/';
        //basenamefunction returns file name
  $uploadfile= $uploaddir. basename($_FILES['pictures']['name']);
  echo "<p>";      

  if (move_uploaded_file($_FILES['pictures']['tmp_name'], $uploadfile)) 
  {
    echo "File is valid, and was successfully uploaded.\n";
  }
  else
  {
   echo "Upload failed";
 } 
}
?>
<!DOCTYPE html>
<html>
<title>UDM OSLAMS Landlord | Register Property Landlord </title>
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
  html,body,h1,h2,h3,h4,h5,p{font-size: 14px;, font-family: "Arial", sans-serif}
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
 <br>

 <!-- START of Container for Welcome messages and Contents -->
 <div class="w3-container">
  <div class="panel panel-primary shadow">
    <div class="panel-heading"><h4><center>Register A Property</center></h4>
    </div>
    <div class="panel-body">
      <form method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label>Property Type: </label>
          <select name="type" class="form-select form-select-lg">
            <option value="Apartment Room" selected>Apartment Room</option>
            <option value="Detached House">Detached House</option>
            <option value="Part of House">Part of House</option>
            <option value="Shared Room">Shared Room</option>
            <option value="Private Flat">Private Flat</option>
          </select>
        </div>

        <div class="form-group">
          <label>Property Rating : </label>&nbsp;&nbsp;
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="1">
            <label class="form-check-label" for="inlineRadio1">1</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="2">
            <label class="form-check-label" for="inlineRadio2">2</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value="3" checked>
            <label class="form-check-label" for="inlineRadio3">3</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value="4">
            <label class="form-check-label" for="inlineRadio3">4</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value="5">
            <label class="form-check-label" for="inlineRadio3">5</label>
          </div>&nbsp;
          <label><p><small>Rating Range 1 is the lowest and 5 is the Highest</p></small></label>
        </div>

        <div class="form-group">
          <label>Number of Person to Accomodate: </label>
          <select name="capacity" class="form-select form-select-lg">
            <option value="1" selected>1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>

        <div class="form-group">
          <label for="">Monthly Rental Fee (Rs.) </label> &nbsp;  &nbsp;
          <input type="number" name="rentalFee" pattern="[0-9]+([\.][0-9]+)?" min ="0.00" step="0.01" max="9999.99" required>
        </div>

        <div class="form-group">
          <label for="">Deposit Fee (Rs.) </label> &nbsp;  &nbsp;
          <input type="number" name="depositFee" pattern="[0-9]+([\.][0-9]+)?" min ="0.00" step="0.01" max="9999.99" required>
        </div>

        <div class="form-group">
          <label>Property Status </label>
          <select name="status" class="form-select form-select-lg">
            <option value="Available" selected>Available</option>
            <option value="Maintenance">Maintenance</option>
            <option value="Occupied">Occupied</option>
            <option value="Inactive">Inactive</option>
          </select>
        </div>

        <div class="form-group">
          <label for="">Property Area </label> &nbsp;  &nbsp;
          <input type="number" name="area"  min ="1"  max="300" required> &nbsp;
          <label><p><small>m² </p></small></label>
        </div>

        <div class="form-group">
          <label for="">Location of Property</label>
          <input type="text" class="form-control" id="address" name="address" required></input>
        </div>

        <div class="form-group">
          <label for="">Property Distance From Nearest UDM Campus </label> &nbsp;  &nbsp;
          <input type="number" name="distance"  min ="1"  max="25" required> &nbsp;
          <label><p><small>km </p></small></label>
        </div>

        <div class="form-group">
          <label>Wireless Internet Connection (WiFi) Available</label>&nbsp;&nbsp;
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="wifi" id="inlineRadio1" value="1" >
            <label class="form-check-label" for="inlineRadio1">YES</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="wifi" id="inlineRadio2" value="0" checked>
            <label class="form-check-label" for="inlineRadio2">NO</label>
          </div>       
        </div>

        <div class="form-group">
          <label>Bathroom Available</label>&nbsp;&nbsp;
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="bathroom" id="inlineRadio1" value="1" checked>
            <label class="form-check-label" for="inlineRadio1">YES</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="bathroom" id="inlineRadio2" value="0">
            <label class="form-check-label" for="inlineRadio2">NO</label>
          </div>       
        </div>

        <div class="form-group">
          <label>Kitchen Available</label>&nbsp;&nbsp;
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="kitchen" id="inlineRadio1" value="1" >
            <label class="form-check-label" for="inlineRadio1">YES</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="kitchen" id="inlineRadio2" value="0" checked>
            <label class="form-check-label" for="inlineRadio2">NO</label>
          </div>       
        </div>

        <div class="form-group">
          <label>Upload Property Pictures</label>&nbsp;&nbsp; 
          <input type="file" name="pictures" multiple="multiple" class="btn btn-info" accept="image/*" onchange="preview()"/> 
          &nbsp;<img id="frame" src="" width="100px" height="100px" alt="Image Preview" />
        </div>

        <div class="form-group">
          <label for="">Other Facilities</label>
          <input type="text" class="form-control" id="otherFacilities" name="otherFacilities" ></input>
        </div>

        <div class="form-group">
          <label for="">BlockChain Address (ÐOGE)</label>
          <input type="text" class="form-control" name="bscAddress"></input>
        </div>


        <div class="form-group" >
         <div class="form-check form-check-inline">
          <input class="form-check-input" type="hidden" name="approved" id="inlineRadio1" value="1" disabled>                   
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="hidden" name="approved" id="inlineRadio2" value="0" checked>
        </div>       
      </div>
      <button type="submit" id="submit-button" class="btn btn-primary" name="btnSubmit" >Submit</button>&nbsp;
      <input type="reset" class="btn btn-danger" value="Reset" />&nbsp;
      <button type="cancel" class="btn btn-warning" onclick="javascript:window.location='propertyManagement.php';">Cancel</button>
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
<script type="text/javascript">
  function preview() {
    frame.src=URL.createObjectURL(event.target.files[0]);
  }
</script>

</body>
</html>