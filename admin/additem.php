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
			$description = mysqli_real_escape_string($db,$_POST['description']); 
			$category = mysqli_real_escape_string($db,$_POST['category']); 
			$price = mysqli_real_escape_string($db,$_POST['price']); 
			$spice = mysqli_real_escape_string($db,$_POST['spice']); 

			$sql = "SELECT  * FROM menu WHERE code = '$itemcode'";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
				
			if($count >= 1) {
				$message  = "<p>Item exists in our records</p>";
			}
				else{
					$id = uniqid();
					$sqlInsert="INSERT INTO menu(id,code,name,description,category,price,spice) values('".$id."','".$itemcode."','".$itemname."','".$description."','".$category."','".$price."','".$spice."')";
					
					if (mysqli_query($db, $sqlInsert))
					{
							echo "<script>console.log( 'Debug Objects: " . json_encode($_POST) . "' );</script>";
							$message = "<p><strong> New Item </strong> has been added to menu</p>";                                       
							// header("location: home.php");
							
					}
					else{
							$message = "<p><strong> Unable </strong> to add new item to menu. Please try again</p>";                                       
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
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Add New Item</h2>
						<p class="sub-heading to-animate">Add new item to the exquiste <strong>My Thai Cafe</strong> menu.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 to-animate-2">
							<?php
								echo $message
							?>
						<form method="post" action="../admin/additem.php">
							<div class="form-group">
								<label for="code" class="sr-only">Item Code</label>
								<input id="code" name="code" class="form-control" placeholder="Item Code (eg. A1)" type="text">
							</div>
							<div class="form-group ">
								<label for="name" class="sr-only">Name</label>
								<input id="name" name="name" class="form-control" placeholder="Item Name" type="text">
							</div>
							<div class="form-group">
								<label for="category" class="sr-only">category</label>
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
							<div class="form-group">
								<label for="spicy" class="sr-only">Spice</label>
								<select name="spice" class="form-control" id="occation">
								<option value="1">Low</option>
								<option value="2">Medium</option>
								<option value="3">High</option>
								<option value="4">Thai Spicy</option>
								</select>
							</div>
							<div class="form-group ">
								<label for="price" class="sr-only">Price</label>
								<input id="price" name="price" step="0.01" class="form-control" placeholder="Price" type="number">
							</div>
							<div class="form-group ">
								<label for="description" class="sr-only">Description</label>
								<textarea name="description" id="description" cols="40" rows="5"></textarea>
							</div>
							<button type="submit" class="btn btn-primary">ADD ITEM</button>
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
