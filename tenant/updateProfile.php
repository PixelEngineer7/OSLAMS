<?php
  ///Name:RAMLOCHUND Gitendrajeet 
 //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
 //Scope: Tenant Dashboard | Update Profile
    session_start();
    require '../controller/Database.php';
    require '../controller/tenant.php';
    require '../controller/user.php';

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
  
    
    $database = new DBHandler();
    $viewtenant = new Tenant();
    $tenantview=$viewtenant->retrieveTenant($_SESSION['username']);

    
if (isset($_POST['btnSubmit']))
  {
    $mobile=$_POST['mobile'];
    $address=$_POST['address'];
    $remarks=$_POST['remarks'];
   
    $modifyTenant = new tenant();
    $modifyTenant->updateProfile($_SESSION['userID'],$mobile,$address,$remarks);
    header('location:viewProfile.php');
}    
?>
<!DOCTYPE html>
<html>
<title>UDM OSLAMS Tenant | Tenant Details Dashboard </title>
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
<div class="w3-bar w3-top w3-white w3-large" style="z-index:4">
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
      <a href="tenantDashboard.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Overview</a>
      <a href="viewTenant.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-user-circle-o"></i>  User Details</a>
      <a href="viewBooking.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  View Booking | Rental</a>
      <a href="../landlord/propertyOnRent.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Property on Rent</a>
      <a href="contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope"></i>  Contact Us</a> 
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:33px">
     <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> | Tenant User Details</b></h4>
  </header>

<!-- START of Container to have Form for Tenant -->
<div class="w3-container">
     <form method="post" enctype="multipart/form-data" >
        <div class="panel panel-success">
          <div class="panel-heading">
             <h3 style="font-size:20px;" class="text-center"><i class="fa fa-info-circle" aria-hidden="true"></i> Update Tenant Personal Information</h3>
          </div>
        <div class="panel-body">
          <form >
                <?php foreach($tenantview as $row) { ?>

                <div class="form-group">
                   <label>Tenant ID :</label>
                    <?php echo $row['userID']; 
                          $_SESSION['userID']=(int)$row['userID']; ?>  

                </div>

                <div class="form-group">
                  <label>Gender :</label>
                  <?php echo $row['gender']; ?>
                </div>

                <div class="form-group">
                  <label>E-mail Address :</label>
                  <?php echo $row['email']; ?>
                </div>

                <div class="form-group">
                    <label for="">Mobile Number :</label>
                    <?php echo "<input type='tel' name='mobile' class='form-control' value='".$row['mobile']."'>";?> 
                </div>

                <div class="form-group">
                  <label for="">Country :</label>
                  <?php echo $row['country']; ?>
                </div>

                <div class="form-group">
                  <label for="">Nationality :</label>
                  <?php echo $row['nationality']; ?>
                </div>

                <div class="form-group">
                  <label for="">Passport Number :</label>
                  <?php echo $row['passportNo']; ?>
                </div>

                <div class="form-group">
                  <label for="">Address :</label>
                  <?php echo "<input type='text' name='address' class='form-control' value='".$row['address']."'>";?> 
                </div>

                <div class="form-group">
                  <label for="">Course Enrolled :</label>
                  <?php echo $row['course']; ?>
                </div>

                <div class="form-group">
                  <label for="">Date Of Enrolment :</label>
                  <?php echo $row['dateOfEnrolment']; ?>
                </div>

                <div class="form-group">
                  <label for="">Additional Info :</label>
                  <?php echo "<input type='text' name='remarks' class='form-control' value='".$row['remarks']."'>";?> 
                </div>

               <?php } ?>
               <button type="submit" id="submit-button" class="btn btn-primary" name="btnSubmit" onclick="update()">Update Profile</button>&nbsp;
               <a href="viewProfile.php" class="btn btn-warning">Cancel</a>   
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

</body>
</html>