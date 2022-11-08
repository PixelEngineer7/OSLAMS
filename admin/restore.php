<?php
 //Name:RAMLOCHUND Gitendrajeet 
 //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
 //Scope: Admin Backup| Restore Database
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


//Connection to PhpMyadmin database
$conn = mysqli_connect("localhost", "root", "", "udm");
if (! empty($_FILES)) {
    // Validating SQL file type by extensions
    if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
        "sql"
    ))) {
        $response = array(
            "type" => "error",
            "message" => "Invalid File Type , only SQL format is valid!"
        );
    } else {
        if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
            move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
            $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
        }
    }
}

//Function that takes input fo .SQL file as extention to restore the database using Web based API
function restoreMysqlDB($filePath, $conn)
{
    $sql = '';
    $error = '';
    
    if (file_exists($filePath)) {
        $lines = file($filePath);
        
        foreach ($lines as $line) {

            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($line), - 1, 1) == ';') {
                $result = mysqli_query($conn, $sql);
                if (! $result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = '';
            }
        } // end foreach
        
        if ($error) {
            $response = array(
                "type" => "error",
                "message" => $error
            );
        } else {
            $response = array(
                "type" => "success",
                "message" => "Database Restore Completed Successfully."
            );
        }
        exec('rm ' . $filePath);
    } // end if file exists
    
    return $response;
}
?>
<!DOCTYPE html>
<html lang="en">
<title>UDM OSLAMS Administrator | Backup and Restore </title>
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
    <a href="administratorDashboard.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="userManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o"></i>  User Registration</a>
    <a href="propertyManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Property Management</a>
    <a href="bookingManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  Booking | Rental Management</a>
    <a href="reports.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-file-text-o"></i>  Reports</a>
    <a href="backup.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-database"></i>  Backup | Restore Database</a>
    <a href="contactus.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home"></i>  Contact Us</a>
</div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
	<header class="w3-container" style="padding-top:43px">
        <h4></strong>&nbsp;<b><i class="fa fa-tachometer" aria-hidden="true"></i> Backup | Restore Database</b></h4>

    </header>

    <h3><center><u>Restore Database</u></center></h3>
    <div class="m-4">
      <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
              <div class="card shadow">
                  <center><img src="../images/restore.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
                  <div class="card-body">
                      <center><b><h5 class="card-title">Backup SQL Database system</h5></b></center>
                      <?php
                      if (! empty($response)) {
                          ?>
                          <div class="response <?php echo $response["type"]; ?>">
                              <?php echo nl2br($response["message"]); ?>
                          </div>
                          <?php
                      }
                      ?>
                      <form method="post" action="" enctype="multipart/form-data"
                      id="frm-restore">
                      <div class="form-row">
                        <div><center>Choose Backup File (.SQL Format)</center></div>
                        <div>
                         <center> <input type="file" name="backup_file" class="btn btn-info"  /></center>
                     </div>
                     &nbsp;
                 </div>
                 <div>
                    <center><input type="submit" name="restore" value="Restore" class="btn btn-primary"  /></center>
                </div>
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