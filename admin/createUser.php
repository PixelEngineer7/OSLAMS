<?php
    //Name:RAMLOCHUND Gitendrajeet 
    //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
    //Scope: User Management Dashboard | Create New User on System
require_once(__DIR__.'/../controller/user.php');
session_start();

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
$error="";

if (isset($_POST["btnSubmit"]))
{
  $surname= $_POST['surname'];
  $name= $_POST['name'];
  $cat = $_POST['cat'];
  $uname = $_POST['uname'];
  $pwd = $_POST['pwd'];

  
  $usr = new user();
  try{
    $usr->registerUser($surname,$name,$cat,$uname,$pwd);
    $error="ALERT: Successfully added the new user " . $_POST['name'];
    header('location:userManagement.php');
  }
  Catch(PDOException $e) 
  {
    $error="ALERT: Username already Exist on System";
  }
}
?>
<!DOCTYPE html>
<html>
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
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="administratorDashboard.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="userManagement.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-user-circle-o"></i>  User Registration</a>
    <a href="propertyManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Property Management</a>
    <a href="bookingManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i> Rental | Booking Management</a>
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
    <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> | User Management Dashboard</b></h4>
  </header>

  <br>
  <!-- START of Container for Welcome messages and Contents -->
  <div class="w3-container">
    <div class="form">
      <div class="panel panel-primary shadow">
        <div class="panel-heading">
          <h1 style="font-size:20px;" class="text-center">User Registration Form OSLAMS</h1>
        </div>
        <div class="panel-body">
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="">Surname</label>
              <input type="text" pattern="[a-zA-Z]+" oninvalid="setCustomValidity('Please enter on alphabets only. ')" class="form-control" name="surname" required></input>
            </div>

            <div class="form-group">
              <label for="">Name</label>
              <input type="text" pattern="[a-zA-Z]+" oninvalid="setCustomValidity('Please enter on alphabets only. ')" class="form-control" name="name" required></input>
            </div>

            <div class="form-group">
              <label for="">Category</label>
              <div class="form-check f">
                <input class="form-check-input" type="radio" name="cat" id="cat1" value="Landlord" checked>
                <label class="form-check-label" for="inlineRadio1">Landlord</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="cat" id="cat2" value="Student">
                <label class="form-check-label" for="inlineRadio2">Prospect Student (New Students Only)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="cat" id="cat2" value="Tenant">
                <label class="form-check-label" for="inlineRadio2">Enrolled Student (Also Known As Tenant)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="cat" id="cat3" value="Administrator">
                <label class="form-check-label" for="inlineRadio3">Administrator</label>
              </div>
            </div>

            <div class="form-group">
              <label for="">Username</label>
              <input type="text" class="form-control" name="uname" required></input>
            </div>

            <div class="form-group">
              <label for="">Password</label>
              <input type="password" class="form-control" name="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"required ></input>
              
            </div>

            <?php if (isset($_POST["btnSubmit"])) {?>
              <div class="alert alert-info" role="alert">
               <strong><?php echo $error; ?></strong> 
             </div>
           <?php }?>
           <button type="submit" id="submit-button" class="btn btn-primary" name="btnSubmit">Submit</button>&nbsp;
           <input type="reset" class="btn btn-danger" value="Reset"/>&nbsp;
           <button type="cancel" class="btn btn-warning" onclick="javascript:window.location='userManagement.php';">Cancel</button>

         </div>
       </form>


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