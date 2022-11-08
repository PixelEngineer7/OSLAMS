<?php
//Name:RAMLOCHUND Gitendrajeet 
//Project: UDM Online Student Lodging Accommodation Management System (OSLAMS)
//Scope: Index Page / Login Authenticator for OSLAMS.

    session_start();
    //Requires 2 class for it to be able to work correctly Class Database and Class user
    require 'controller/Database.php';
    require 'controller/user.php';

    $conn=mysqli_connect('localhost','root','','udm');
	//Getting Input value
	if(isset($_POST['btnLogin']))
	{
		// Escape special characters, if any
		$username=mysqli_real_escape_string($conn,$_POST['uname']);
		$password=mysqli_real_escape_string($conn,$_POST['pwd']);

		if(empty($username)&&empty($password))
		{
  			$error= '<span style=color:yellow>Please Fill out Username and Password Field!!!</span> ';
  		}

  		else 
		{
			//Creating new objects from class user and call function to pass 2 parameters to object user
			$user = new user();
			$role=$user->getRole($username,$password);
			if ($role == 'unidentifiedrole')
			{
				$error='<span style=color:Lime>INVALID!!! Username and Password</span>';
			}
			else
			{   
				//Redirecting User Based on category obtained from database UDM table tblusers
				switch($role)
				{
					case 'Administrator':
						  $_SESSION["username"] = $username;
						  header('location:admin/administratorDashboard.php');
					break;
					case 'Tenant':
						  $_SESSION["username"] = $username;
					 	  header('location:tenant/tenantDashboard.php');
					 break;
					case 'Student':
				     	  $_SESSION["username"] = $username;
						  header('location:applicant/applicantDashboard.php');
					break;

					case 'Landlord':
					     $_SESSION["username"] = $username;
						 header('location:landlord/landlordDashboard.php');
					break;

				}
			}
		}
			 
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <title>UDM OSLAMS Welcome | Login Page</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/style_login.css"> 
    <link rel="stylesheet" href="css/font-login.css">
    <style type="text/css">
		.alert{padding:5px;border:1px solid transparent;border-radius:5px; width:250px; margin:0px auto 10px auto;}
		.alert-danger{color:#dd4f43;background-color:#f0f0f0;border-color:#dd4f43; font-size:16px; font-weight:bold}
	</style> 
</head>

<body>
<div class="wrapper">
	<div class="container">
		<h1><img src="images/mainLogo.png" /></h1>
		<h2 class="text-center">Student Lodging Accomodation Management System</h2>
		<form class="form_login" method="post">
			            <input type="text" placeholder="Username" name="uname" required/>
						<input type="password" placeholder="Password" name="pwd"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"required />

			<button type="submit" id="login-button" class="btn btn-secondary" style="background-color:#424242; color:#fff" name="btnLogin" >Login</button>
			<br>
			<br>
			<p class="change_link">Not a member yet ? <a href="register.php"  class="link-success">Register Here</a></p>
			<br>
  					<?php if(isset($error)) {echo $error;}?>
			<br>
		</form>
	        <div class="copyright" style="font-size:14px; margin-top:10px;">
	           <p> &copy; 2021 UDM OSLAMS | By Gitendra  </p>	    
	        </div> 

	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"> </script>
</body>
</html>
