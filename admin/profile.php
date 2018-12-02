<?php
session_start();
// ob_start();

if(isset($_SESSION['UserID'])){
	echo "<script>console.log( 'Debug Objects: " . json_encode($_SESSION['id']) . "' );</script>";
	$user_id = $_SESSION['UserID'];
} else {
	header('login.php');
}
?>
<!-- <!DOCTYPE html> -->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>My Profile | My thai Cafe</title>
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

		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$email = mysqli_real_escape_string($db,$_POST['email']);
			if($_POST['password'] != '') {
				if($_POST['password'] != $_POST['password_prev']){
					$password = md5(mysqli_real_escape_string($db,$_POST['password'])); 
					echo '<script type="text/javascript">alert("Password Updated"); </script>';
				}
			}
			else {
				$password = md5(mysqli_real_escape_string($db,$_POST['password_prev']));
			}
			$phone = mysqli_real_escape_string($db,$_POST['mobile']); 
			$firstname = mysqli_real_escape_string($db,$_POST['firstname']); 
			$lastname = mysqli_real_escape_string($db,$_POST['lastname']); 
			$middlename = mysqli_real_escape_string($db,$_POST['middlename']); 
			$street1 = mysqli_real_escape_string($db,$_POST['street1']); 
			$street2 = mysqli_real_escape_string($db,$_POST['street2']); 
			$city = mysqli_real_escape_string($db,$_POST['city']); 
			$zip = mysqli_real_escape_string($db,$_POST['zip']); 
			$state = mysqli_real_escape_string($db,$_POST['state']);
			$country = mysqli_real_escape_string($db,$_POST['country']);
			$mobile = mysqli_real_escape_string($db,$_POST['mobile']);

			$sql = "SELECT  * FROM user WHERE id = '$user_id'";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);

			if($count == 1) {
                $sqlUpdate="UPDATE user SET id = '".$user_id."' ,firstname = '".$firstname."',lastname ='".$lastname."',middlename='".$middlename."',email='".$email."',street1='".$street1."',street2='".$street2."',city='".$city."',state='".$state."',zip='".$zip."',country='".$country."',mobile='".$mobile."', password='".$password."' WHERE id = '".$user_id."'";
				
				if (mysqli_query($db, $sqlUpdate))
				{
					echo '<script type="text/javascript">alert("Profile Updated"); </script>';
					$_SESSION['login_user'] = $email;
					// header("location: ./index.php");
				}
				else{
					echo '<script type="text/javascript">alert("Sign up failed. Please try again!"); </script>';
					$error = "Update Failed!";
				}
			}
		}

        $sql = "SELECT  * FROM `user` WHERE id = '$user_id'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		echo "<script>console.log( 'Debug Objects: " . json_encode($_POST) . "' );</script>";
    
        if($count == 1) {
			$email = $row['email'];
			$phone = $row['phone']; 
			$firstname = $row['firstname']; 
			$password = $row['password'];
			$lastname = $row['lastname']; 
			$middlename = $row['middlename']; 
			$street1 = $row['street1']; 
			$street2 = $row['street2']; 
			$city = $row['city']; 
			$zip = $row['zip']; 
			$state = $row['state'];
			$country = $row['country'];
			$mobile = $row['mobile'];
        }else {
            $message = "Profile not found";
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
		<div class="fh5co-sayings-s-menu">
			<div class="fh5co-menu-s-2">
				<a href="./index.php" data-nav-section="home">Home</a>
				<a href="./menu.php" data-nav-section="events">Menu</a>
				<a href="./orders.php" data-nav-section="menu">Orders</a>
				<a href="./profile.php" data-nav-section="menu">
				<?php 
				 	if(isset($_SESSION['firstName'])) {
						echo $_SESSION['firstName'];
					}
					 else{
						 echo "Guest";
					 }
				?>
				</a>
			</div>
		</div>

		<div id="fh5co-contact" data-section="reservation">
			<div class="container ">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Register</h2>
						<p class="sub-heading to-animate">Join the My Thai Cafe Family, to experince the best cuisines </p>
					</div>
				</div>
				<div class="row centered">
					<div class="col-md-12 to-animate-2">
					<form method="post" action="profile.php">
						<div class="form-group">
							<label for="firstname" class="sr-only">First Name</label>
							<input id="firstname" name="firstname" class="form-control" placeholder="First Name" value="<?php echo htmlentities($firstname); ?>" type="text" required="true">
						</div>
						<div class="form-group">
							<label for="lastname" class="sr-only">Last Name</label>
							<input id="lastname" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo htmlentities($lastname); ?>" type="text" required="true">
						</div>
						<div class="form-group">
							<label for="middlename" class="sr-only">Middle Name</label>
							<input id="middlename"  name="middlename" class="form-control" placeholder="Middle Name" value="<?php echo htmlentities($middlename); ?>" type="text" >
						</div>
						<div class="form-group">
							<label for="email" class="sr-only">email</label>
							<input id="email" name="email" class="form-control" placeholder="Email" value="<?php echo htmlentities($email); ?>" type="text" required="true">
						</div>
						<div class="form-group">
							<label for="street1" class="sr-only">Address Line 1</label>
							<input id="street1"  name="street1" class="form-control" placeholder="Address Line 1" value="<?php echo htmlentities($street1); ?>" type="text" required="true">
						</div>
						<div class="form-group">
							<label for="street2" class="sr-only">Address Line 2</label>
							<input id="street2" name="street2" class="form-control" placeholder="Address Line 2" value="<?php echo htmlentities($street2); ?>" type="text">
						</div>
						<div class="form-group">
							<label for="city" class="sr-only">City</label>
							<input id="city" name="city" class="form-control" placeholder="Address Line 2" value="<?php echo htmlentities($city); ?>" type="text">
						</div>
						<div class="form-group">
							<label for="state" class="sr-only">State</label>
							<input id="state" name="state" class="form-control" placeholder="State" type="text" value="<?php echo htmlentities($state); ?>" required="true">
						</div>
						<div class="form-group">
							<label for="country" class="sr-only">Country</label>
							<input id="country" name="country" class="form-control" placeholder="Country" value="<?php echo htmlentities($country); ?>" type="text" required="true">
						</div>
						<div class="form-group">
							<label for="zip" class="sr-only">Zipcode</label>
							<input id="zip" name="zip" class="form-control" placeholder="Zipcode" value="<?php echo htmlentities($zip); ?>" type="number" required="true">
						</div>
						<div class="form-group">
							<label for="mobile" class="sr-only">Mobile</label>
							<input id="mobile" name="mobile" class="form-control" placeholder="Mobile No." value="<?php echo htmlentities($mobile); ?>" type="number" required="true">
						</div>
						<div class="form-group">
							<label for="password" class="sr-only">Password</label>
							<input id="password" name="password" class="form-control" placeholder="Password" type="password" >
							<input name="password_prev" value="<?php echo htmlentities($password); ?>" hidden type="password" >
						</div>
						<div class="form-group centered">
							<button type="submit" id="register" class="btn btn-danger" btn-lg btn-block">Update</button>
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
