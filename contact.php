<?php
	session_start();
	ob_start();

	include("./app/config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$name = mysqli_real_escape_string($db,$_POST['contact_name']); 
		$message = mysqli_real_escape_string($db,$_POST['message']); 
		$id = uniqid();
		$date = date('Y-m-d H:i:s');
			
		$sqlInsert="INSERT INTO enquiries values('".$id."','".$name."','".$email."','".$message."','".$date."')";
			
		if (mysqli_query($db, $sqlInsert))
		{
			echo '<script type="text/javascript">alert("Enquiry has been successfully submitted!"); </script>';
			$message = "Enquiry sucessfully submitted !";
		}
		else{
			echo '<script type="text/javascript">alert("Failed to submit enquiry. Please try again!"); </script>';
			$message = "Enquiry failed!";
		}
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>My Thai Cafe</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />

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

	<div id="fh5co-container">
		
	<div class="js-sticky">
			<div class="fh5co-main-nav">
				<div class="container-fluid">
					<div class="fh5co-menu-1">
						<a href="./index.php" class="external" data-nav-section="home">Home</a>
						<a href="./about.php" class="external" data-nav-section="about">About</a>
					</div>
					<div class="fh5co-logo">
						<a href="index.html" class="external">My Thai Cafe</a>
					</div>
					<div class="fh5co-menu-2">
						<a href="./shopping.php" class="external" data-nav-section="menu">Menu</a>
						<a href="./contact.php" class="external" data-nav-section="contact">Contact</a>
					</div>
				</div>
				
			</div>
		</div>
		<div class="fh5co-sayings-s-menu">
			<div class="fh5co-menu-s-2">
				<!-- <a href="./index.php" data-nav-section="home">Home</a>
				<a href="./shopping.php" data-nav-section="events">Menu</a> -->
				<?php 
					if(isset($_SESSION['UserID'])) {
				?>
				<a href="./client/index.php" data-nav-section="menu">My Home</a>	
				<?php 
					}
				?>
				<a href="./checkout.php" data-nav-section="menu">Cart</a>
				<a href=<?php echo (isset($_SESSION['UserID']) ? './client/profile.php' : './login.php' ) ?> data-nav-section="menu">
				<?php 
				 	if(isset($_SESSION['UserID'])) {
						echo $_SESSION['firstName'];
					}
					 else{
						 echo "Login";
					 }
				?>
				</a>
				<?php 
					if(isset($_SESSION['UserID'])) {
				?>
				<a href="../app/logout.php" data-nav-section="menu">Log Out</a>		
				<?php 
					}
				?>		
			</div>
		</div>

		<div id="fh5co-contact" data-section="contact">
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Contact Us</h2>
						<p class="sub-heading to-animate">My Thai Cafe maintains three locations: Bloomington (West side), downtown Bloomington, and the NEW My Thai Express.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 to-animate-2">
						<h3>Contact Info</h3>
						<ul class="fh5co-contact-info">
							<li class="fh5co-contact-address ">
								<i class="icon-home"></i>
								Bloomington - West Side <br>
								3316 West 3rd Street <br> Bloomington, IN 47404 <br>
								(812) 333-2234
							</li>
							<li class="fh5co-contact-address ">
								<i class="icon-home"></i>
								Bloomington - Downtown <br>
								420-424 East 4th Street <br> Bloomington, IN 47408<br>
								(812) 333-3993
							</li>
							<li class="fh5co-contact-address ">
								<i class="icon-home"></i>
								My Thai Express <br>
								519 South Walnut Street <br> Bloomington, IN 47401 <br>
								(812) 330-7004
							</li>
							<li><i class="icon-clock2"></i> Lunch <br> Mon.-Sat.: 11 am - 3 pm <br> <br> Dinner <br> Mon.-Thurs.: 4:30 - 9 pm <br> Fri.: 4:30 - 10 pm <br> Sat.: 3 - 10 pm <br> <em>Closed Sundays.</em></li>
						</ul>
					</div>
					<div class="col-md-6 to-animate-2">
						<form action="./contact.php" method="post">
							<h3>Contact Form</h3>
							<div class="form-group ">
								<label for="name" class="sr-only">Name</label>
								<input id="name" name="contact_name" class="form-control" placeholder="Name" type="text" required>
							</div>
							<div class="form-group ">
								<label for="email" class="sr-only">Email</label>
								<input id="email" name="email" class="form-control" placeholder="Email" type="email" required>
							</div>
														
							<div class="form-group ">
								<label for="message" class="sr-only">Message</label>
								<textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message" required></textarea>
							</div>
							<div class="form-group ">
								<button class="btn btn-primary" value="Send Message" type="submit"> Submit</button>
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
					<p class="to-animate">&copy; 2018 My Thai Cafe. <br> Bloomington, IN
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

