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
		<div id="fh5co-home" class="js-fullheight">

			<div class="flexslider">
				<div class="fh5co-overlay"></div>
				<div class="fh5co-text">
					<div class="container">
						<div class="row">
							<h1 class="to-animate">My Thai Cafe</h1>
							<!-- <h2 class="to-animate">Lovely Designed <span>by</span> <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2> -->
						</div>
					</div>
				</div>
			  	<ul class="slides">
			   	<li style="background-image: url(images/slide_1.jpg);" data-stellar-background-ratio="0.5"></li>
			   	<li style="background-image: url(images/slide_2.jpg);" data-stellar-background-ratio="0.5"></li>
			   	<li style="background-image: url(images/slide_3.jpg);" data-stellar-background-ratio="0.5"></li>
			  	</ul>

			</div>
			
		</div>
		
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
				<div class="fh5co-sayings-s-menu">
			<div class="fh5co-menu-s-2">
				<!-- <a href="./index.php" data-nav-section="home">Home</a>
				<a href="./shopping.php" data-nav-section="events">Menu</a> -->
				<?php 
					if(isset($_SESSION['UserID'])) {
				?>
				<a href="./client/index.php"  class="external" data-nav-section="menu">My Home</a>	
				<?php 
					}
				?>
				<a href="./checkout.php"  class="external" data-nav-section="menu">Cart</a>
				<a href=<?php echo (isset($_SESSION['UserID']) ? './client/profile.php' : './login.php' ) ?>  class="external" data-nav-section="menu">
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
				<a href="../app/logout.php"  class="external" data-nav-section="menu">Log Out</a>		
				<?php 
					}
				?>		
			</div>
		</div>
			</div>
		</div>
		

		<div id="fh5co-about" data-section="home">
			<div class="fh5co-2col fh5co-bg to-animate-2" style="background-image: url(images/res_img_1.jpg)"></div>
			<div class="fh5co-2col fh5co-text">
				<h2 class="heading to-animate">About Us</h2>
				<p class="to-animate">Looking for a great and affordable dining experience in the Bloomington area? Then My Thai Cafe is the place for you! Each of our locations provide a unique Thai food experience that will leave you satisfied and coming back for more.</p>
			</div>
		</div>
		<br>
		<br>

		<div id="fh5co-featured" data-section="features">
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Featured Dishes</h2>
						<p class="sub-heading to-animate">See some of our most popular menu items!</p>
					</div>
				</div>
				<div class="row">
					<div class="fh5co-grid">
						<div class="fh5co-v-half to-animate-2">
							<div class="fh5co-v-col-2 fh5co-bg-img" style="background-image: url(images/res_img_1.jpg)"></div>
							<div class="fh5co-v-col-2 fh5co-text fh5co-special-1 arrow-left">
								<h2>Pak Kra Prow</h2>
								<span class="pricing">$7.50</span>
								<p>Thai Basil Chicken, served with white rice.</p>
							</div>
						</div>
						<div class="fh5co-v-half">
							<div class="fh5co-h-row-2 to-animate-2">
								<div class="fh5co-v-col-2 fh5co-bg-img" style="background-image: url(images/res_img_2.jpg)"></div>
								<div class="fh5co-v-col-2 fh5co-text arrow-left">
									<h2>Chicken Cashew</h2>
									<span class="pricing">$12.00</span>
									<p>Stir fried chicken with cashew nuts, white and green onions, carrots, and straw mushrooms.</p>
								</div>
							</div>
							<div class="fh5co-h-row-2 fh5co-reversed to-animate-2">
								<div class="fh5co-v-col-2 fh5co-bg-img" style="background-image: url(images/res_img_8.jpg)"></div>
								<div class="fh5co-v-col-2 fh5co-text arrow-right">
									<h2>Kao Pad</h2>
									<span class="pricing">$4.50</span>
									<p>Stir fried rice with egg, tomatoes, and white and green onions.</p>
								</div>
							</div>
						</div>

						<div class="fh5co-v-half">
							<div class="fh5co-h-row-2 fh5co-reversed to-animate-2">
								<div class="fh5co-v-col-2 fh5co-bg-img" style="background-image: url(images/res_img_8.jpg)"></div>
								<div class="fh5co-v-col-2 fh5co-text arrow-right">
									<h2>Tofu Tom Yum</h2>
									<span class="pricing">$4.99</span>
									<p>Spicy and sour soup with lemon grass, onions, tomatoes, mushrooms, kaffirlime leaves, and galangal roots.</p>
								</div>
							</div>
							<div class="fh5co-h-row-2 to-animate-2">
								<div class="fh5co-v-col-2 fh5co-bg-img" style="background-image: url(images/res_img_4.jpg)"></div>
								<div class="fh5co-v-col-2 fh5co-text arrow-left">
									<h2>Larb</h2>
									<span class="pricing">$8.50</span>
									<p>Your choice of ground chicken, pork, beef, or tofu with red and green onions, mint, cilantro, and ground roasted rice mixed in lime juice.</p>
								</div>
							</div>
						</div>
						<div class="fh5co-v-half to-animate-2">
							<div class="fh5co-v-col-2 fh5co-bg-img" style="background-image: url(images/res_img_3.jpg)"></div>
							<div class="fh5co-v-col-2 fh5co-text fh5co-special-1 arrow-left">
								<h2>Fried Tofu</h2>
								<span class="pricing">$5.99</span>
								<p>Deep fried batterred tofu served with sweet and sour sauce, topped with crushed peanuts.</p>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>

		<div id="fh5co-sayings">
			<div class="container">
				<div class="row to-animate">
					<h2>See what others have to say!</h2>
					<div class="flexslider">
						<ul class="slides">
							
							<li>
								<blockquote>
									<p>&ldquo;Not your typical Thai restaurant, that's for sure!&rdquo;</p>
									<p class="quote-author">&mdash;Shirly Hulmes</p>
								</blockquote>
							</li>
							<li>
								<blockquote>
									<p>&ldquo;A little gem of a restaurant.&rdquo;</p>
									<p class="quote-author">&mdash;Ash Ketchup</p>
								</blockquote>
							</li>
							<li>
								<blockquote>
									<p>&ldquo;Great food for cheap! &rdquo;</p>
									<p class="quote-author">&mdash;John J.</p>
								</blockquote>
							</li>
							<li>
								<blockquote>
									<p>&ldquo;Highly recommend this Thai restaurant!&rdquo;</p>
									<p class="quote-author">&mdash;Hurlock Shulmes</p>
								</blockquote>
							</li>
							
							
						</ul>
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

