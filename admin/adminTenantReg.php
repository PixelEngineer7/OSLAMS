<?php
   //Name:RAMLOCHUND Gitendrajeet 
  //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
  //Scope: Administrator Dashboard
 require_once(__DIR__.'/../controller/tenant.php');

  if (isset($_POST["btnSubmit"]))
  {
    $gender= $_POST['gender'];
    $email= $_POST['email'];
    $mobile = $_POST['mobile'];
    $country = $_POST['country'];
    $nationality= $_POST['nationality'];
    $passportNo= $_POST['passportNo'];
    $address= $_POST['address'];
    $course= $_POST['course'];
    $dateOfEnrolment= $_POST['dateOfEnrolment'];
    $remarks= $_POST['remarks'];    
    
    $tenant = new tenant();
    $tenant->addTenant($gender,$email,$mobile,$country,$nationality,$passportNo,$address,$course,$dateOfEnrolment,$remarks);
  
} 
?>


<!DOCTYPE html>
<html>
<title>UDM OSLAMS | Landlord Dashbord </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="icon" type="image/x-icon" href="../images/favicon.png">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<style>
  html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
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
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>UDM OSLAMS | Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o"></i>  User Details</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  View Booking</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Property on Rent</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Contact Us</a>


    
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:73px">
     <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> | Landlord Dashboard</b></h4>
  </header>

  <!-- START of Container for Welcome messages and Contents -->


  <div class="container">
    <div class="form">
      <div class="panel panel-primary">
          <div class="panel-heading">
            <img src="../images/minStudent.png" class="img-responsive" align="left" alt="">
            <h1 class="text-center">Registration Of Tenant</h1>
          </div>
        <div class="panel-body">
          <form method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="">Student Gender</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male">
                  <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" checked>
                  <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
              </div>
              <div class="form-group">
              <label for="">Email</label>
              <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required  title="Please enter valid email [user@mailhost.com]." type="text" class="form-control" id="email"></input>
            </div>

            <div class="form-group">
              <label for="">Mobile</label>
              <input pattern="[0-9]{3}[0-9]{8}"" title="Please enter valid Mobile number Eg: 02059xxxxxx" type="tel" class="form-control" id="mobile" required></input>
            </div>

           <div class="form-group">
                <label>Country:</label>
                  <select name="country" class="form-control">
                    <option value="Madagascar">Madagascar</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Congo DRC">Congo DRC</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Ivory Coast">Ivory Coast</option>
                    <option value="Mauritius" selected >Mauritius</option>
                    <option value="Rodrigues">Rodrigues</option>

                 </select>
             </div>

            <div class="form-group">
              <label for="">Nationality</label>
              <input type="text" class="form-control" id="nationality" required></input>
            </div>

            <div class="form-group">
              <label for="">Passport Number (Non-Resident MRU) or NIC Number (Resident MRU) </label>
              <input pattern="[A-Za-z 0-9]{14}" title="Input correct NIC Number" required type="text" class="form-control" id="passportno"></input>
            </div>

            <div class="form-group">
              <label for="">Address</label>
              <input type="text" class="form-control" id="address" required></input>
            </div>

            <div class="form-group">
                <label>Course:</label>
                  <select name="course" required class="form-control">
                    <option value="BEng (Hons) Civil Engineering">BEng (Hons) Civil Engineering</option>
                    <option value="BEng (Hons) Electrical and Electronic Engineering">BEng (Hons) Electrical and Electronic Engineering</option>
                    <option value="BSC (Hons) Civil Engineering<">BSC (Hons) Civil Engineering<</option>
                    <option value="BSc (Hons) Electrical Engineering and Automation">BSc (Hons) Electrical Engineering and Automation</option>
                    <option value="BSc (Hons) Electromechanical Engineering">BSc (Hons) Electromechanical Engineering</option>
                    <option value="BSc (Hons) Electrotechnics and Renewable Energy">BSc (Hons) Electrotechnics and Renewable Energy</option>
                    <option value="BSc (Hons) Facilities Management of Hotels and Real Estates">BSc (Hons) Facilities Management of Hotels and Real Estates</option>
                    <option value="Diploma in Civil Engineering">Diploma in Civil Engineering</option>
                    <option value="Diploma in Electrical Engineering and Automation">Diploma in Electrical Engineering and Automation</option>
                    <option value="BSc (Hons) Accounting and Finance">BSc (Hons) Accounting and Finance</option>
                    <option value="BSc (Hons) Banking and Financial Services">BSc (Hons) Banking and Financial Services</option>
                    <option value="BSc (Hons) Human Resource Management">BSc (Hons) Human Resource Management</option>
                    <option value="BSc (Hons) Marketing">BSc (Hons) Marketing</option>
                    <option value="BA (Hons) Top-up degree in Digital Humanities with specialisation in tech">BA (Hons) Digital Humanities with specialisation in tech</option>
                    <option value="BA(Hons) in Digital Humanities">BA(Hons) in Digital Humanities</option>
                    <option value="BSc (Hons) Applied Computer Science">BSc (Hons) Applied Computer Science</option>
                    <option value="BSc (Hons) Software Engineering">BSc (Hons) Software Engineering</option>
                    <option value="Master Artificial Intelligence and Robotics">Master Artificial Intelligence and Robotics</option>
                 </select>
             </div>

            <div class="form-group">
              <label for="">Date Of Enrolment</label>
              <input type="date" id="start" name="date" value="2021-08-07" min="2021-01-01" max="2023-12-31" required>
            </div>

            <div class="form-group">
              <label for="">Remarks</label>
              <br>
              <textarea class="form-control" name="remarks" rows="4"></textarea>
            </div>

            <button type="submit" id="submit-button" class="btn btn-primary" name="btnSubmit">Submit</button>

            <input type="reset" class="btn btn-danger" value="Reset" />



        </div>
      <



   

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