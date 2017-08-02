
<?php
session_start();
if ((isset($_REQUEST['username'])) && (isset($_REQUEST['password'])))
{
$username = $password = $err = '';
$username = isset($_POST["username"]);
$password = isset($_POST["password"]);

	
$username = $_REQUEST['username'];
if ($username =='')
	$err .="You must supply a Username <br/>";
	
	
$password=$_REQUEST['password'];
if ($password == '')
$err .="You must supply a Password <br/>";

if ($err == ''){
	$password = sha1($password);
	
	$connect=mysql_connect("localhost","root","favina");
	 mysql_select_db("test")or die("cannot select Database");
	 
	$query=mysql_query("SELECT*FROM user WHERE username ='$username'AND password ='$password'");
	$numrow= mysql_num_rows($query);
	if ($numrow!=0){	
		while($row= mysql_fetch_assoc($query)){
			$dusername=$row['username'];
			$dpassword=$row['password'];
			$suspend=$row['suspend'];
								
		}
		if ($username == $dusername&&($password == $dpassword)&&$suspend=="YES"){
			$err .="Sorry your Account has Been Temporarily Suspended!<br/>";
			}
		
			if ($username == $dusername&&($password == $dpassword)&&$suspend=="NO"){
			mysql_query("UPDATE user SET logged_in ='YES'WHERE username='$username'");
			header( 'Location:http://localhost:8080/assignment/member.php');
			$_SESSION['username']=$username;
			
			}
			
				
				
			
	}
	
			
			

	}$err .="Incorrect Username or Password!<br/>";

}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- CSS -->
		<link href="stylesheets/styles.css" rel="stylesheet" type="text/css" />
	
	</head>
	<body>
		<div id="wrapper">
			<!--Overlay -->
	        <div class="overlay"></div>
	        <!--SideBar-->
	        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
	         	<ul class="sidebar-nav">
					<li><a href="#"><span class="glyphicon glyphicon-home"> <span class="menu-text">Dashboard </span></span></a></li>
					<li><a href="#"> <span class="glyphicon glyphicon-file"> <span class="menu-text">Pages </span></span></a></li>
					<li><a href="#"> <span class="glyphicon glyphicon-random"> <span class="menu-text">Redirects </span></span></a></li>
					<li><a href="#"><span class="glyphicon glyphicon-cog"> <span class="menu-text">Settings </span></span></a></li>
					<li><a href="#"><span class="glyphicon glyphicon-share"> <span class="menu-text">Logout </span></span></a></li>
				</ul> 
	        </nav>
	        
          	<!-- Page Content -->
        	<div id="page-content-wrapper">
	        	 <button type="button" class="toggle-icon" data-toggle="offcanvas">
	                <span class="icon-top"></span>
	    			<span class="icon-middle"></span>
					<span class="icon-bottom"></span>
	            </button>
        	</div>
        	<section id="page-content-wrapper">
			<div class="col-sm-4 col-sm-offset-4">		
				<div class="login-form">

				<form id="loginForm" class="form-wrapper" role="form"  action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return validateForm();" >
					<fieldset>
						 <div class="form-group">
						 <input class="form-control" type="text" name="username" value="" placeholder="Username" required>
						<span class="error"></span>
						</div>
						 <div class="form-group">
						 <input class="form-control" type="password" name="password" placeholder="Password" required>
						<span class="error"> </span>
						</div>
						 <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
					</fieldset>
				</form>
			</div>
		</div>
		</section>
	    </div><!--WRAPPER END -->
	    <script>


function validateForm()
{
	var input =document.forms["sign_in"]["user"].value;
	var passinput =document.forms["sign_in"]["password"].value;
	
if((passinput==null || passinput=="" )&&(input==null || input==""))
  {
	 document.getElementById('user').style.background="#FFC9CA"  
   document.getElementById('user_error').innerHTML = "*Please enter your Username!";
	document.getElementById('password').style.background="#FFC9CA"  
   document.getElementById('password_error').innerHTML = "*Please enter your Password!";
     return false;
	}
if(input==null || input=="")
  {
	 document.getElementById('user').style.background="#FFC9CA"  
    document.getElementById('user_error').innerHTML = "*Please enter your Username!";
	     return false;
  }
  if(passinput==null || passinput=="" )
  {
	document.getElementById('password').style.background="#FFC9CA"  
   document.getElementById('password_error').innerHTML = "*Please enter your Password!";
     return false;
	}
  
}


</script>

<div id="fadeout" class"fade">
<script type="text/javascript">

    $(window).load(function() {
       $('#fadeout').hide().fadeIn(1000);
    })
	</script>

		
		 

	    <!-- JS -->

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>    <script src="javascripts/bootstrap.js"></script>
    	<script src="javascripts/index.js"></script>
	</body>
</html>