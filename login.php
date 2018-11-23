<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login | My thai Cafe</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="My thai cafe" />
	<meta name="keywords" content="My thai cafe, bloomington, thai, indiana university,thai, thai cuisine" />


  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Merriweather:300,400italic,300italic,400,700italic' rel='stylesheet' type='text/css'>

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="css/simple-line-icons.css">
	<!-- Datetimepicker -->
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<link rel="stylesheet" href="css/style.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	<?php
		include('./app/config.php');

		if($_SERVER["REQUEST_METHOD"] == "POST") {
				echo "<script>console.log( 'Debug Objects: " . json_encode($_POST) . "' );</script>";
		       $myusername = mysqli_real_escape_string($db,$_POST['email']);
		       $pwd = mysqli_real_escape_string($db,$_POST['password']); 
			   $mypassword = md5($pwd);
		    	$sql = "SELECT * FROM user WHERE email = '$myusername' and password = '$mypassword'";
			//  echo $sql;
			  $result = mysqli_query($db,$sql);
		      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		      //$active = $row['active'];
		      
		      $count = mysqli_num_rows($result);
		      
		      //If result matched $myusername and $mypassword, table row must be 1 row
				
		      if($count == 1) {
		        $_SESSION['login_user'] = $myusername;
				$_SESSION['UserID'] = $row["id"];
				$_SESSION['firstName'] = $row["firstname"];
				$_SESSION['lastName'] = $row["lastname"];
				$_SESSION['UserType'] = $row["role"];
		      	if($row["role"] == "client"){
			  		header("location: index.php");
			  	} else if($row["role"] == "admin"){
			  		header("location: admin.php");
			  	}else if($row["UserType"] == "USER" && $row["role"] == "blocked"){
					  echo '<script type="text/javascript">alert("Your account is blocked. Please contact system administrator"); </script>';
			   		  echo $myusername;
			  	}
		      }else {
		      	echo '<script type="text/javascript">alert("Your Login Name or Password is invalid"); </script>';
		         $error = "Your Login Name or Password is invalid";
		      }
		   }
	?> 

	<div id="fh5co-container">

		<div class="js-sticky">
			<div class="fh5co-main-nav">
				<div class="container-fluid">
					<div class="fh5co-menu-1">
						<a href="#" data-nav-section="home">Home</a>
						<a href="#" data-nav-section="about">About</a>
						<a href="#" data-nav-section="features">Features</a>
					</div>
					<div class="fh5co-logo">
						<a href="index.html">My Thai Cafe</a>
					</div>
					<div class="fh5co-menu-2">
						<a href="#" data-nav-section="menu">Menu</a>
						<a href="#" data-nav-section="events">Events</a>
						<a href="#" data-nav-section="reservation">Reservation</a>
					</div>
				</div>

			</div>
		</div>

		<div id="fh5co-contact" data-section="reservation">
			<div class="container ">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Login</h2>
						<p class="sub-heading to-animate">Join the My Thai Cafe Family, to experince the best cuisines </p>
					</div>
				</div>
				<div class="row centered">
					<div class="col-md-12 to-animate-2">
					<form method="post" action="login.php">
						<div class="form-group ">
							<label for="email" class="sr-only">email</label>
							<input id="email" name="email" class="form-control" placeholder="johnhinkle@gmail.com" type="text" required="true">
						</div>
						<div class="form-group ">
							<label for="password" class="sr-only">Password</label>
							<input id="password" name="password" class="form-control" placeholder="********" type="password" required="true">
						</div>
						<div class="form-group centered">
							<button type="submit" id="login" class="btn btn-danger" btn-lg btn-block">Log In</button>
						</div>
						<div class="form-group">
							<div>Dont have an account ?<a href="./register.php"> Register </a>now</div>
						</div>
					</form>
						</div>
				    </div>
			</div>
		</div>

	</div>

	<div id="fh5co-footer">
		<div class="container">
			<div class="row row-padded">
				<div class="col-md-12 text-center">
					<p class="to-animate">&copy; 2016 Foodee Free HTML5 Template. <br> Designed by <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> Demo Images: <a href="http://pexels.com/" target="_blank">Pexels</a> <br> Tasty Icons Free <a href="http://handdrawngoods.com/store/tasty-icons-free-food-icons/" target="_blank">handdrawngoods</a>
					</p>
					<p class="text-center to-animate"><a href="#" class="js-gotop">Go To Top</a></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<ul class="fh5co-social">
						<li class="to-animate-2"><a href="#"><i class="icon-facebook"></i></a></li>
						<li class="to-animate-2"><a href="#"><i class="icon-twitter"></i></a></li>
						<li class="to-animate-2"><a href="#"><i class="icon-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Bootstrap DateTimePicker -->
	<script src="js/moment.js"></script>
	<script src="js/bootstrap-datetimepicker.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<script>
		$(function () {
	       $('#date').datetimepicker();
	   });
	</script>
	<!-- Main JS -->
	<script src="js/main.js"></script>

	</body>
</html>
