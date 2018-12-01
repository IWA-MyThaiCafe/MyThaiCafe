<?php 
session_start();
ob_start();
include("./app/config.php");


if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        
        // echo "<script>console.log( 'Debug Objects shopping cart: " . json_encode(in_array($_GET["id"], $item_array_id)) . "' );</script>";            
        echo "<script>console.log( 'Debug Objects shopping cart: " . json_encode(array_keys($_SESSION["shopping_cart"])) . "' );</script>";            

		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$_GET["id"]] = $item_array;
		}
		else
		{       
            echo "<script>console.log( 'Debug Objects: " . json_encode($_SESSION["shopping_cart"]) . "' );</script>";            
            // echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
        $_SESSION["shopping_cart"][$_GET["id"]] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				// echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="shopping.php#"</script>';
			}
		}
	}
}

echo "<script>console.log( 'Debug Objects: " . json_encode($_SESSION["shopping_cart"]) . "' );</script>";            
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Checkout | My thai Cafe</title>
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

		<div id="fh5co-contact" data-section="Order">
			<div class="container ">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Order Details</h2>
						<p class="sub-heading to-animate">Experience our thai cuisine at your doorstep.</p>
					</div>
				</div>
				<!-- Cart -->
				<div  data-section="order-details">
					<div class="container">
					<br>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th width="40%">Item Name</th>
								<th width="10%">Quantity</th>
								<th width="20%">Price</th>
								<th width="15%">Total</th>
								<th width="5%">Action</th>
							</tr>
							<?php
							if(!empty($_SESSION["shopping_cart"]))
							{
								$total = 0;
								foreach($_SESSION["shopping_cart"] as $keys => $values)
								{
							?>
							<tr>
								<td><?php echo $values["item_name"]; ?></td>
								<td><?php echo $values["item_quantity"]; ?></td>
								<td>$ <?php echo $values["item_price"]; ?></td>
								<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
								<td><a href="shopping.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
							</tr>
							<?php
									$total = $total + ($values["item_quantity"] * $values["item_price"]);
								}
							?>
							<tr>
								<td colspan="3" align="right">Total</td>
								<td align="right">$ <?php echo number_format($total, 2); ?></td>
								<td></td>
							</tr>
							<?php
							}
							?>
                        </table>
                            
                        <br><br>
                        <h1>
                            Delivery Address
                        </h1>
                         <form action="./checkout.php" method="post">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group-1">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control custom-form-control" name="firstname" id="firstname" placeholder="John">
                                </div>
                                <div class="form-group-1">
                                    <label for="firstname">Last Name</label>
                                    <input type="text" class="form-control custom-form-control" name="lastname" id="lastname" placeholder="Carter">
                                </div>
                                <div class="form-group-1">
                                    <label for="firstname">Middle Name</label>
                                    <input type="text" class="form-control custom-form-control" name="middlename" id="middlename" placeholder="Hinkle">
                                </div>
                                <div class="form-group-1">
                                    <label for="firstname">Shipping Address</label>
                                    <input type="text" class="form-control custom-form-control" name="address1" id="address1" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group-1">
                                    <label for="cname">Name on Card</label>
                                    <input type="text" class="form-control custom-form-control" name="cname" id="cname" placeholder="John Carpentar">
                                </div>
                                <div class="form-group-1">
                                    <label for="ccnum">Card Number</label>
                                    <input type="text" class="form-control custom-form-control" name="ccnum" id="ccnum" placeholder="7894561278561234">
                                </div>
                                <div class="form-group-1">
                                    <label for="expmonth">Exp Month</label>
                                    <input type="text" class="form-control custom-form-control" name="expmonth" id="expmonth" placeholder="October">
                                </div>
								<div class="row">
								<div class="col-md-6">
								<div class="form-group-1">
										<label for="expyear">Exp Year</label>
										<input type="text" class="form-control custom-form-control" name="expyear" id="expyear" placeholder="2011">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group-1">
										<label for="cvv">CVV</label>
										<input type="text" class="form-control custom-form-control" name="cvv" id="cvv" placeholder="CVV">
									</div>
								</div>
								</div>
                            </div>
                        </div>
                            
                        </form>
						<a type="button" href="./shopping.php" class="btn btn-primary btn-lg ">Continue Shopping</a>
						<a type="button" href="./checkout.php" class="btn btn-primary btn-lg ">Check out</a>
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
