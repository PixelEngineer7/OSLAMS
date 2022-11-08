<?php
//Name:RAMLOCHUND Gitendrajeet 
 //Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
 //Scope: User Management | View Users
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

    //Creating a new connection to database for Pagination of Data to tables
$servername='localhost';
$username='root';
$password='';
$dbname = "udm";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
  die('Could not Connect My Sql:' .mysql_error());
}

$limit = 5;  
if (isset($_GET["page"])) 
{
  $page  = $_GET["page"]; 
} 
else
{ 
  $page=1;
};  
$start_from = ($page-1) * $limit; 
$result = mysqli_query($conn,"SELECT * FROM tblusers ORDER BY userID ASC LIMIT $start_from, $limit");

$database=new DBHandler();
$user1=new user();
$landC=$user1->countLandlord($database);
foreach ($landC as $rowA) 
  $countLandlord=(int)$rowA['total'];

$user2=new user();
$tenantC=$user2->countTenant($database);
foreach ($tenantC as $rowB) 
  $countTenant=(int)$rowB['total'];

$user3=new user();
$studentC=$user3->countStudent($database);
foreach ($studentC as $rowC) 
  $countStudent=(int)$rowC['total'];

$user4=new user();
$AllC=$user4->countAll($database);
foreach ($AllC as $rowD) 
  $countAll=(int)$rowD['total'];
?>
<!DOCTYPE html>
<html lang="en">
<title>UDM OSLAMS | User Management Dashbord </title>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">

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
    <a href="bookingManagement.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-plus-o"></i>  Rental | Booking Management</a>
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

 <!-- START of Boxes.... -->

 <div class="m-4">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card shadow">
        <center><img src="../images/register1.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
        <div class="card-body">
          <center><h5 class="card-title">Register A New User</h5></center>
          <center><p class="card-text">Register a New User on the UDM OSLAMS</p></center>
        </div>
        <div class="card-footer">
          <center><button type="cancel" class="btn btn-info" onclick="javascript:window.location='createUser.php';">Register User</button></center>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card shadow">
       <center><img src="../images/edituser.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
       <div class="card-body">
         <center><h5 class="card-title">Modify Registered User </center>
           <center> <p class="card-text">Modify User Registered on the UDM OSLAMS</p></center>
         </div>
         <div class="card-footer">
           <center><button type="cancel" class="btn btn-warning" onclick="javascript:window.location='modifyUser.php';">Modify User</button></center>
         </div>
       </div>
     </div>
     <div class="col">
       <div class="card shadow">
        <center><img src="../images/passwordChange.png" class="img-responsive" alt="" style="padding-top:10px;"></center>
        <div class="card-body">
          <center> <h5 class="card-title">User Password Change</h5></center>
          <center><p class="card-text">Password Change for user Forgot Cases</p></center>
        </div>
        <div class="card-footer">
         <center><button type="cancel" class="btn btn-danger" onclick="javascript:window.location='passwordChange.php';">Change Password</button></center>
       </div>
     </div>
   </div>
 </div>
</div>


<div class="w3-row-padding w3-margin-bottom">
  <div class="w3-quarter">
    <div class="w3-container w3-purple w3-padding-16 shadow">
      <div class="w3-left"><i class="fa fa-graduation-cap fa-4x" aria-hidden="true"></i></div>
      <div class="w3-right">
        <h3 style="font-size:30px;"><?php echo $countTenant; ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h6>Tenant Registered on System</h6>
    </div>
  </div>
  <div class="w3-quarter">
    <div class="w3-container w3-blue w3-padding-16 shadow">
      <div class="w3-left"><i class="fa fa-home fa-4x" aria-hidden="true"></i></div>
      <div class="w3-right">
        <h3 style="font-size:30px;"><?php echo $countLandlord; ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Landlord Registered on System</h4>
    </div>
  </div>
  <div class="w3-quarter">
    <div class="w3-container w3-green w3-padding-16 shadow">
      <div class="w3-left"><i class="fa fa-user-o fa-4x" aria-hidden="true"></i></div>
      <div class="w3-right">
        <h3 style="font-size:30px;"><?php echo $countStudent; ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Student Registered on System</h4>
    </div>
  </div>
  <div class="w3-quarter">
    <div class="w3-container w3-orange w3-text-white w3-padding-16 shadow">
      <div class="w3-left"><i class="fa fa-refresh fa-spin fa-4x fa-fw"></i></div>
      <div class="w3-right">
        <h2 style="font-size:30px;"><?php echo $countAll; ?></h2>
      </div>
      <div class="w3-clear"></div>
      <h4>Total Users Registered on System</h4>
    </div>
  </div>
</div>

<div class="w3-container">
  <div class="panel panel-primary shadow">
    <div class="panel-heading"><h4><center>List of All Registered Property On UDM OSALMS</center></h4>
    </div>
    <br>
    <div class="table-responsive">
      &nbsp;&nbsp;<b>Search Table:  </b><input id="myInput" type="text" placeholder="Search..">&nbsp;<i class="fa fa-search" aria-hidden="true"></i>
      <table class="table table-hover" id="myTable">
        <thead >
          <tr>
            <th scope="col">User ID</th>
            <th onclick="sortTable(1)" scope="col">Surname <i class="fa fa-sort"></i> </th>
            <th scope="col">Name</th>
            <th onclick="sortTable(0)" scope="col">Category <i class="fa fa-sort"></i></th>
            <th scope="col">Username</th>
          </tr>
        </thead>
        <?php while ($row = mysqli_fetch_array($result)) { ?>


          <tbody id="myTable">
            <tr>

              <td><?php echo $row['userID']; ?></td>
              <td><?php echo $row['surname']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['category']; ?></td>
              <td><?php echo $row['username']; ?></td>
            </tr>

          </tbody>
        <?php } ?>
      </table>
      <?php  

      $result_db = mysqli_query($conn,"SELECT COUNT(userID) FROM tblusers"); 
      $row_db = mysqli_fetch_row($result_db);  
      $total_records = $row_db[0];  
      $total_pages = ceil($total_records / $limit); 
      /* echo  $total_pages; */
      $pagLink = "<ul class='pagination justify-content-center'>";  
      for ($i=1; $i<=$total_pages; $i++) {
        $pagLink .= "<li class='page-item'><a class='w3-button w3-hover-green' href='userManagement.php?page=".$i."'>".$i."</a></li>"; 
      }
      echo $pagLink . "</ul>";  
      ?>
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
  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
</body>
</html>