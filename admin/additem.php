<?php
session_start();
// ob_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Register | My thai Cafe</title>
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
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="../css/simple-line-icons.css">
	<!-- Datetimepicker -->
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="../css/flexslider.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../css/bootstrap.css">

	<link rel="stylesheet" href="../css/style.css">


	<!-- Modernizr JS -->
	<script src="../js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>                                                        
	<![endif]-->

	</head>
	<body>
	<?php
		include("../app/config.php");
		// include('header.php');

		if($_SERVER["REQUEST_METHOD"] == "POST") {

			$itemcode = mysqli_real_escape_string($db,$_POST['code']);
			$itemname = mysqli_real_escape_string($db,$_POST['name']);
			$description = md5(mysqli_real_escape_string($db,$_POST['description'])); 
			$category = mysqli_real_escape_string($db,$_POST['category']); 
			$price = mysqli_real_escape_string($db,$_POST['price']); 
			$spice = mysqli_real_escape_string($db,$_POST['spice']); 

			// $sql = "SELECT  * FROM user WHERE email = '$email'";
			// $result = mysqli_query($db,$sql);
			// $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			// $count = mysqli_num_rows($result);
			// echo "<script>console.log( 'Debug Objects: " . json_encode($_POST) . "' );</script>";
				
			if($count >= 1) {

				echo '<script type="text/javascript">alert("The email exist in our records!"); </script>';

				}
				else{
					$id = uniqid();
					$sqlInsert="INSERT INTO user(id,firstname,lastname,middlename,email,password,street1,street2,city,state,country,zip,mobile) values('".$id."','".$firstname."','".$lastname."','".$middlename."','".$email."','".$password."','".$street1."','".$street2."','".$city."','".$state."','".$country."','".$zip."','".$phone."')";
					

					if (mysqli_query($db, $sqlInsert))
					{
							echo "<script>console.log( 'Debug Objects: " . json_encode($_POST) . "' );</script>";
							$_SESSION['login_user'] = $myusername;
							$sqlGet = "SELECT  * FROM user WHERE Email = '$myusername'";
							$resultGet = mysqli_query($db,$sqlGet);
							$rowGet = mysqli_fetch_array($resultGet,MYSQLI_ASSOC);

							$_SESSION['UserID'] = $rowGet["UserID"];
							$_SESSION['firstName'] = $rowGet["FirstName"];
							echo '<script type="text/javascript">alert("You have successfully signed up!"); </script>';
							$to      = $myusername;
							$message = "<b>You have just signed up.</b>";                                       
							$message .= "<h1>Lets start your first tour with <a href='http://ella.ils.indiana.edu/~szpatel/HappyHolidays-InfoArch/login.php'>MyHobbyHolidays</a></h1>";
							$message .= "<b>Username for the account is ". $myusername ."</b></br>";
							$header .= "MIME-Version: 1.0\r\n";
							$header .= "Content-type: text/html\r\n";
							$retval = mail ($to,$subject,$message,$header);           
							
							if( !$retval) {
								// echo "Message sent successfully...";
							}
							header("location: login.php");
							
					}
					else{
				echo '<script type="text/javascript">alert("Sign up failed. Please try again!"); </script>';
				$error = "Signup failed!";
			}
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
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Add New Item</h2>
						<p class="sub-heading to-animate">Add new item to the exquiste <strong>My Thai Cafe</strong> menu.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 to-animate-2">
						<div class="form-group ">
							<label for="code" class="sr-only">Item Code</label>
							<input id="code" name="code" class="form-control" placeholder="Item Code (eg. A1)" type="text">
						</div>
						<div class="form-group ">
							<label for="name" class="sr-only">Name</label>
							<input id="name" name="name" class="form-control" placeholder="Name" type="email">
						</div>
						<div class="form-group ">
							<label for="description" class="sr-only">Description</label>
							<input id="description" name="description" class="form-control" placeholder="Description" type="text">
						</div>
						<div class="form-group">
							<label for="occation" class="sr-only">Occation</label>
							<select name="category" class="form-control" id="occation">
							  <option value="appetizers">Appetizers</option>
							  <option value="yum">Yum</option>
							  <option value="soups">Soups</option>
							  <option value="friedrice">Fried Rice</option>
							  <option value="entrees">Entrees</option>
							  <option value="drinks">Drinks</option>
							  <option value="desert">Desert</option>
							</select>
						</div>
						<form method="post" action="../admin/additem.php">
						<div class="form-group">
							<label for="firstname" class="sr-only">First Name</label>
							<input id="firstname" name="firstname" class="form-control" placeholder="First Name" type="text" required="true">
						</div>
						<div class="form-group">
							<label for="lastname" class="sr-only">Last Name</label>
							<input id="lastname" name="lastname" class="form-control" placeholder="Last Name" type="text" required="true">
						</div>
						<div class="form-group">
							<label for="middlename" class="sr-only">Middle Name</label>
							<input id="middlename"  name="middlename" class="form-control" placeholder="Middle Name" type="text" >
						</div>
						<div class="form-group">
							<label for="email" class="sr-only">email</label>
							<input id="email" name="email" class="form-control" placeholder="Email" type="text" required="true">
						</div>
						<div class="form-group">
							<label for="street1" class="sr-only">Address Line 1</label>
							<input id="street1"  name="street1" class="form-control" placeholder="Address Line 1" type="text" required="true">
						</div>
						<div class="form-group">
							<label for="street2" class="sr-only">Address Line 2</label>
							<input id="street2" name="street2" class="form-control" placeholder="Address Line 2" type="text">
						</div>
						<div class="form-group">
							<label for="city" class="sr-only">City</label>
							<input id="city" name="city" class="form-control" placeholder="Address Line 2" type="text">
						</div>
						<div class="form-group ">
							<button type="submit" id="register" class="btn btn-danger" btn-lg btn-block">Add Item</button>
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
	<script src="../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Bootstrap DateTimePicker -->
	<script src="../js/moment.js"></script>
	<script src="../js/bootstrap-datetimepicker.min.js"></script>
	<!-- Waypoints -->
	<script src="../js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="../js/jquery.stellar.min.js"></script>

	<!-- Flexslider -->
	<script src="../js/jquery.flexslider-min.js"></script>
	<script>
		$(function () {
	       $('#date').datetimepicker();
	   });
	</script>
	<!-- Main JS -->
	<script src="../js/main.js"></script>

	</body>
</html>
