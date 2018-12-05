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
	<!-- Menu -->
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
				<?php 
					if(!isset($_SESSION['UserID'])) {
				?>
				<a href="./register.php" data-nav-section="menu">Register</a>		
				<?php 
					}
				?>
			</div>
		</div>

		<div id="fh5co-menus" data-section="menu">
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Food Menu</h2>
						<p class="sub-heading to-animate">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<!-- Cart -->
				<div  data-section="menu">
					<div class="container">
					<h3>Order Details</h3>
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
						<a type="button" href="./checkout.php" class="btn btn-primary btn-lg ">Check out</a>
					</div>
				</div>
				<br>
				<br>
				<div class="row row-padded">
					<div class="col-md-6">
						<div class="fh5co-food-menu to-animate-2">
							<h2 class="fh5co-drinks">Appetizers</h2>
							<ul>
                                <?php
                                    $query = "SELECT * FROM menu WHERE category='appetizers'";
                                    $result = mysqli_query($db,$query);
                                    if(mysqli_num_rows($result) > 0)
                                    {
                                        while($row = mysqli_fetch_array($result))
                                        {
                                ?>
                                    <li>
                                            <div class="fh5co-food-desc">
                                                <figure>
                                                    <img src="images/res_img_5.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
                                                </figure>
                                                <div>
                                                    <h3><?php echo $row["name"]; ?></h3>
                                                    <p><?php echo $row["description"]; ?></p>
                                                </div>    
                                                <div class="row item-quantity">
                                                <div class="col-md-12">
                                                    <form class="form-inline" method="post" action="shopping.php?action=add&id=<?php echo $row["id"];?>" >
                                                        <div class="form-group">
                                                            <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                                                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                                                            <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
                                                            <input type="number" name="quantity" min="1" max="10" step="1" class="form-control add-to-cart" placeholder="Count" required>
                                                        </div>
                                                        <button type="submit" name="add_to_cart" class="btn btn-warning add-to-cart-button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cart</button>
                                                    </form> 
                                                </div>
                                                    
                                                </div>  
                                            </div>
                                            <div class="fh5co-food-pricing">
                                                $ <?php echo $row["price"]; ?>
                                            </div>
                                    </li>
                                <?php
                                        }
                                    }
                                ?>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="fh5co-food-menu to-animate-2">
							<h2 class="fh5co-dishes">Stir Fry Entree`s</h2>
							<ul>
                                <?php
                                    $query = "SELECT * FROM menu WHERE category='entrees'";
                                    $result = mysqli_query($db,$query);
                                    if(mysqli_num_rows($result) > 0)
                                    {
                                        while($row = mysqli_fetch_array($result))
                                        {
                                ?>
                                    <li>
                                            <div class="fh5co-food-desc">
                                                <figure>
                                                    <img src="images/res_img_5.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
                                                </figure>
                                                <div>
                                                    <h3><?php echo $row["name"]; ?></h3>
                                                    <p><?php echo $row["description"]; ?></p>
                                                </div>    
                                                <div class="row item-quantity">
                                                <div class="col-md-12">
                                                    <form class="form-inline" method="post" action="shopping.php?action=add&id=<?php echo $row["id"];?>" >
                                                        <div class="form-group">
                                                            <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                                                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                                                            <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
                                                            <input type="number" name="quantity" min="1" max="10" step="1" class="form-control add-to-cart" placeholder="Count" required>
                                                        </div>
                                                        <button type="submit" name="add_to_cart" class="btn btn-warning add-to-cart-button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cart</button>
                                                    </form> 
                                                </div>
                                                    
                                                </div>  
                                            </div>
                                            <div class="fh5co-food-pricing">
                                                $ <?php echo $row["price"]; ?>
                                            </div>
                                    </li>
                                <?php
                                        }
                                    }
                                ?>
							</ul>
						</div>
					</div>
					
				</div>
				<div class="row">
				<div class="col-md-6">
						<div class="fh5co-food-menu to-animate-2">
							<h2 class="fh5co-drinks">Drinks</h2>
							<ul>
								<li>
									<div class="fh5co-food-desc">
										<figure>
											<img src="images/res_img_5.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
										</figure>
										<div>
											<h3>Pineapple Juice</h3>
											<p>Far far away, behind the word mountains.</p>
										</div>
									</div>
									<div class="fh5co-food-pricing">
										$17.50
									</div>
								</li>
								<li>
									<div class="fh5co-food-desc">
										<figure>
											<img src="images/res_img_6.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
										</figure>
										<div>
											<h3>Green Juice</h3>
											<p>Far far away, behind the word mountains.</p>
										</div>
									</div>
									<div class="fh5co-food-pricing">
										$7.99
									</div>
								</li>
								<li>
									<div class="fh5co-food-desc">
										<figure>
											<img src="images/res_img_7.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
										</figure>
										<div>
											<h3>Soft Drinks</h3>
											<p>Far far away, behind the word mountains.</p>
										</div>
									</div>
									<div class="fh5co-food-pricing">
										$12.99
									</div>
								</li>
								<li>
									<div class="fh5co-food-desc">
										<figure>
											<img src="images/res_img_5.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
										</figure>
										<div>
											<h3>Carlo Rosee Drinks</h3>
											<p>Far far away, behind the word mountains.</p>
										</div>
									</div>
									<div class="fh5co-food-pricing">
										$12.99
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="fh5co-food-menu to-animate-2">
							<h2 class="fh5co-dishes">Steak</h2>
							<ul>
								<li>
									<div class="fh5co-food-desc">
										<figure>
											<img src="images/res_img_3.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
										</figure>
										<div>
											<h3>Beef Steak</h3>
											<p>Far far away, behind the word mountains.</p>
										</div>
									</div>
									<div class="fh5co-food-pricing">
										$17.50
									</div>
								</li>
								<li>
									<div class="fh5co-food-desc">
										<figure>
											<img src="images/res_img_4.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
										</figure>
										<div>
											<h3>Tomato with Chicken</h3>
											<p>Far far away, behind the word mountains.</p>
										</div>
									</div>
									<div class="fh5co-food-pricing">
										$7.99
									</div>
								</li>
								<li>
									<div class="fh5co-food-desc">
										<figure>
											<img src="images/res_img_2.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
										</figure>
										<div>
											<h3>Sausages from Italy</h3>
											<p>Far far away, behind the word mountains.</p>
										</div>
									</div>
									<div class="fh5co-food-pricing">
										$12.99
									</div>
								</li>
								<li>
									<div class="fh5co-food-desc">
										<figure>
											<img src="images/res_img_8.jpg" class="img-responsive" alt="Free HTML5 Templates by FREEHTML5.co">
										</figure>
										<div>
											<h3>Beef Grilled</h3>
											<p>Far far away, behind the word mountains.</p>
										</div>
									</div>
									<div class="fh5co-food-pricing">
										$12.99
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4 text-center to-animate-2">
						<p><a href="#" class="btn btn-primary btn-outline">More Food Menu</a></p>
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

