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

if(isset($_SESSION["UserID"])){
	$user_id = $_SESSION['UserID'];

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
}

if(isset($_POST["check_out"]))
{
	$order_id = uniqid();
	$order = json_encode($_SESSION["shopping_cart"]);
	// Logged in User checkout
	if(isset($_SESSION["shopping_cart"])) {
		if(isset($_SESSION["UserID"])){
			$client_id = $_SESSION['UserID'];
			$address_id = uniqid();
			
			$firstname = mysqli_real_escape_string($db,$_POST['firstname']); 
			$lastname = mysqli_real_escape_string($db,$_POST['lastname']); 
			$middlename = mysqli_real_escape_string($db,$_POST['middlename']); 

			$street1 = mysqli_real_escape_string($db,$_POST['street1']); 
			$street2 = mysqli_real_escape_string($db,$_POST['street2']); 
			$city = mysqli_real_escape_string($db,$_POST['city']); 
			$zip = mysqli_real_escape_string($db,$_POST['zip']); 
			$state = mysqli_real_escape_string($db,$_POST['state']);
			$country = mysqli_real_escape_string($db,$_POST['country']);
			$email = mysqli_real_escape_string($db,$_POST['email']);
			$mobile = mysqli_real_escape_string($db,$_POST['mobile']);

			$now = new DateTime();
			$date = $now->format('Y-m-d H:i:s');
		}
		else {
			$client_id = '1a1a1a1a1a';
			$address_id = uniqid();

			echo "<script>console.log( 'Guest Check Out' );</script>";

			$firstname = mysqli_real_escape_string($db,$_POST['firstname']); 
			$lastname = mysqli_real_escape_string($db,$_POST['lastname']); 
			$middlename = mysqli_real_escape_string($db,$_POST['middlename']); 
			
			$street1 = mysqli_real_escape_string($db,$_POST['street1']); 
			$street2 = mysqli_real_escape_string($db,$_POST['street2']); 
			$city = mysqli_real_escape_string($db,$_POST['city']); 
			$state = mysqli_real_escape_string($db,$_POST['state']);
			$country = mysqli_real_escape_string($db,$_POST['country']);
			$zip = mysqli_real_escape_string($db,$_POST['zip']); 
			$email = mysqli_real_escape_string($db,$_POST['email']);
			$mobile = mysqli_real_escape_string($db,$_POST['mobile']);

			$now = new DateTime();
			$date = $now->format('Y-m-d H:i:s');
		}
	}

	// $sqlInsert="INSERT INTO orders (order_id,customer_id,address_id,order,created_date,street1,street2,city,state,country,zip,email,mobile) values('".$order_id."','".$client_id."','".$address_id."','".$order."','".$date."','".$street1."','".$street2."','".$city."','".$state."','".$country."','".$zip."','".$email."','".$mobile."')";
	$sqlInsert="INSERT INTO orders values('".$order_id."','".$client_id."','".$address_id."','".$order."','".$date."','".$street1."','".$street2."','".$city."','".$state."','".$country."','".$zip."','".$email."','".$mobile."','".$firstname."','".$lastname."','".$middlename."')";


	if (mysqli_query($db, $sqlInsert))
	{
		echo "<script>console.log( 'Success Debug Objects: " . json_encode($_POST) . "' );</script>";
		unset($_SESSION["shopping_cart"]);
		if(isset($_SESSION["UserID"])) {
			header("location: ./client/orders.php");
		} else {
			echo '<script type="text/javascript">alert("Guest Order succesfully placed"); </script>';
			header("location: ./index.php");
		}
	}
	else{
			echo '<script type="text/javascript">alert("Check out failed. Please try again!"); </script>';
			$message = "Check Out Failed! Please try again";
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
				<?php 
					if(!isset($_SESSION['UserID'])) {
				?>
				<a href="./register.php" data-nav-section="menu">Register</a>		
				<?php 
					}
				?>		
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
						<br>
                         <form action="./checkout.php" method="post">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group-1">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control custom-form-control" name="firstname" value="<?php echo htmlentities($firstname); ?>" id="firstname" placeholder="John">
                                </div>
                                <div class="form-group-1">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control custom-form-control" name="lastname" value="<?php echo htmlentities($lastname); ?>" id="lastname" placeholder="Carter">
                                </div>
                                <div class="form-group-1">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control custom-form-control" name="middlename" value="<?php echo htmlentities($middlename); ?>" id="middlename" placeholder="Hinkle">
                                </div>
                                <div class="form-group-1">
                                    <label for="address1">Address Line 1</label>
                                    <input type="text" class="form-control custom-form-control" name="street1" value="<?php echo htmlentities($street1); ?>" id="address1" placeholder="Address Line 1" required>
                                </div>
                                <div class="form-group-1">
                                    <label for="address2">Address Line 2</label>
                                    <input type="text" class="form-control custom-form-control" name="street2" value="<?php echo htmlentities($street2); ?>" id="address2" placeholder="Address Line 2">
								</div>
								<div class="form-group-1">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control custom-form-control" name="city" value="<?php echo htmlentities($city); ?>" id="city" placeholder="Bloomington" required>
								</div>
								<div class="form-group-1">
                                    <label for="state">State</label>
                                    <input type="text" placeholder="Indiana" class="form-control custom-form-control" name="state" value="<?php echo htmlentities($state); ?>" id="state" required>
								</div>
								<div class="form-group-1">
                                    <label for="country">Country</label>
                                    <input type="text"  placeholder="USA" class="form-control custom-form-control" name="country" value="<?php echo htmlentities($country); ?>" id="country" required>
								</div>
								<div class="form-group-1">
                                    <label for="email">Email</label>
                                    <input type="email" placeholder="samuelj.jack@gmail.com" class="form-control custom-form-control" value="<?php echo htmlentities($email); ?>" name="email" id="email" placeholder="Address Line 1" required>
                                </div>
                                <div class="form-group-1">
                                    <label for="number">Mobile</label>
                                    <input type="number" placeholder="812 369 3213" class="form-control custom-form-control" name="mobile" value="<?php echo htmlentities($mobile); ?>" id="mobile" placeholder="Address Line 2" required>
								</div>
								<div class="form-group-1">
                                    <label for="zip">Zip</label>
                                    <input type="number" placeholder="47408" class="form-control custom-form-control" value="<?php echo htmlentities($zip); ?>" name="zip" id="zip" required>
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
							<a type="button" name="cont_shop" href="./shopping.php" class="btn btn-primary btn-lg ">Continue Shopping</a>
							<button type="submit" name="check_out" class="btn btn-primary btn-lg ">Check out</button>
                        </form>
						
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
