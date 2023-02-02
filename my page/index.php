<?php

include("admin/includes/db_config.php");
session_start();
?>


<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/favicon.png" type="image/png">
	<title>Mohammad Abduallah - SE</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
	<!-- main css -->
	<link rel="stylesheet" href="css/style.css">
	<style>
		.modal {
			display: none;
			/* Hidden by default */
			position: fixed;
			/* Stay in place */
			z-index: 9999;
			/* Sit on top */
			padding-top: 100px;
			/* Location of the box */
			left: 0;
			top: 0;
			width: 100%;
			/* Full width */
			height: 100%;
			/* Full height */
			overflow: auto;
			/* Enable scroll if needed */
			background-color: rgb(0, 0, 0);
			/* Fallback color */
			background-color: rgba(0, 0, 0, 0.4);
			/* Black w/ opacity */
		}

		/* Modal Content */
		.modal-content {
			background-color: #fefefe;
			margin: auto;
			margin-top: 90px;
			padding: 20px;
			border: 1px solid #888;
			width: 50%;
		}

		/* The Close Button */
		.close {
			color: #aaaaaa;
			float: right;
			font-size: 28px;
			font-weight: bold;
		}

		.close:hover,
		.close:focus {
			color: #000;
			text-decoration: none;
			cursor: pointer;
		}
	</style>
</head>

<body>

	<!--================ Start Header Area =================-->
	<?php
	$sql = "SELECT * FROM header";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) :
		while ($row = mysqli_fetch_assoc($result)) :
	?>
			<header class="header_area">
				<div class="main_menu">
					<nav class="navbar navbar-expand-lg navbar-light">
						<div class="container">
							<!-- Brand and toggle get grouped for better mobile display -->
							<a class="navbar-brand logo_h" href="index.php?id=0"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['icon']); ?>" style="
							width: 100px;
							height: 100px;
							background-position: -25px -20px;
							border-radius: 50%;
							background-size: cover;
							" alt=""></a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
								<ul class="nav navbar-nav menu_nav justify-content-end">
									<li class="nav-item active"><a class="nav-link" href="index.php?id=0">Home</a></li>
									<li class="nav-item"><a class="nav-link" href="?id=0#about_us">About</a></li>
									<li class="nav-item"><a class="nav-link" href="?id=0#service">Services</a></li>
									<li class="nav-item"><a class="nav-link" href="?id=0#Business-summary">Business summary</a></li>
									<li class="nav-item"><a class="nav-link" href="?id=0#Contact">Contact</a></li>
									<li class="nav-item"><a class="nav-link" href="admin/index.php">Admin site</a></li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</header>
		<?php endwhile; ?>
	<?php endif; ?>
	<!--================ End Header Area =================-->

	<!--================ Start Home Banner Area
	<iframe src="/uploads/media/default/0001/01/540cb75550adf33f281f29132dddd14fded85bfc.pdf" width="100%" height="500px">
	=================-->
	<?php
	$sql = "SELECT * FROM home";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) :
		while ($row = mysqli_fetch_assoc($result)) :
			$name = $row['name'];
			$jop = $row['jop'];
			$email = $row['email'];
			$phone = $row['phone'];
			$image = $row['image'];

	?>
			<section class="home_banner_area">
				<div class="banner_inner">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="banner_content">
									<h3 class="text-uppercase">Hell0</h3>
									<h1 class="text-uppercase">I am <?php echo $name; ?></h1>
									<h5 class="text-uppercase"><?php echo $jop; ?></h5>
									<div class="d-flex align-items-center">

										<button class="primary_btn" id="myBtn"><span>Hire Me</span></button>
										<!-- The Modal -->
										<div id="myModal" class="modal">

											<!-- Modal content -->
											<div class="modal-content">
												<span class="close">&times;</span>
												<h5>To connect please send email to</h5>
												</hr>
												<p style="font-size:20px;"><?php echo $email; ?></p><br>
												<h5>Or connect with me using phone</h5>
												<p style="font-size:20px;"><?php echo $phone; ?></p>
											</div>

										</div>
										<?php
										$sql = "SELECT * FROM about_us";
										$result = mysqli_query($conn, $sql);
										if (mysqli_num_rows($result) > 0) {
											while ($row = mysqli_fetch_assoc($result)) {
												$cv = $row['cv'];

												echo '<a class="primary_btn tr-bg" href="admin/pdf/' . $cv . '.pdf" target=_blanck ><span>Get CV</span></a>';
											}
										}

										?>
									</div>
								</div>
							</div>

							<div class="col-lg-5">
								<div class="home_right_img">
									<img class="" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="" style="
							width: 500px;
							height: 500px;
							background-position: -25px -20px;
							border-radius: 50%;
							background-size: cover;
							">
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
	<?php endif; ?>
	<!--================ End Home Banner Area =================-->

	<!--================ Start About Us Area =================-->
	<?php
	$sql = "SELECT * FROM about_us";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) :
		while ($row = mysqli_fetch_assoc($result)) :
			$description = $row['description'];
			$phone = $row['phone'];
			$_SESSION['experience'] = $row['experience'];
			$_SESSION['phone'] = $row['phone'];
			$cv = $row['cv'];
	?>
			<section class="about_area section_gap" id="about_us">
				<div class="container">
					<div class="row justify-content-start align-items-center">
						<div class="col-lg-5">
							<div class="about_img">
								<img class="" src="img/about-us.png" alt="">
							</div>
						</div>

						<div class="offset-lg-1 col-lg-5">
							<div class="main_title text-left">
								<h2>let’s <br>
									Introduce about <br>
									myself</h2>
								<p>
									<?php echo $description; ?>
								</p>

								<a Download class="primary_btn" href="admin/pdf/<?php echo $cv; ?>.pdf"><span>Download CV</span></a>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
	<?php endif; ?>
	<!--================ End About Us Area =================-->

	<!--================ Srart Brand Area =================-->

	<section class="brand_area section_gap_bottom">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div class="row">
						<?php
						$sql = "SELECT * FROM aboutus_inerr";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) :
							while ($row = mysqli_fetch_assoc($result)) :

						?>
								<div class="col-lg-4 col-md-4 col-sm-6">
									<div class="single-brand-item d-table">
										<div class="d-table-cell text-center">
											<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['icons']); ?>" alt="">
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="offset-lg-2 col-lg-4 col-md-6">
					<div class="client-info">
						<div class="d-flex mb-50">
							<span class="lage"><?php echo $_SESSION['experience']; ?></span>
							<span class="smll">Years Experience Working</span>
						</div>
						<div class="call-now d-flex">
							<div>
								<span class="fa fa-phone"></span>
							</div>
							<div class="ml-15">
								<p>call us now</p>
								<h3><?php echo $_SESSION['phone']; ?></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--================ End Brand Area =================-->

	<!--================ Start Features Area =================-->
	<section class="features_area" id="service">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<div class="main_title">
						<h2>service offers </h2>
						<p>
							The services that I implement quickly and proficiently and the ability to do more than one task
						</p>
					</div>
				</div>
			</div>
			<div class="row feature_inner">
				<?php
				$sql = "SELECT * FROM service";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) :
					while ($row = mysqli_fetch_assoc($result)) :
						$title = $row['title'];
						$description = $row['description'];

				?>
						<div class="col-lg-3 col-md-6">
							<div class="feature_item">
								<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['icon']); ?>" alt="" style="width:63px; height:63px;">
								<h4><?php echo $title; ?></h4>
								<p><?php echo $description; ?></p>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!--================ End Features Area =================-->

	<!--================Start Portfolio Area =================-->
	<section class="portfolio_area" id="Business-summary">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main_title text-left">
						<h2>Quality of project work done </h2>
					</div>
				</div>
			</div>
			<div class="filters portfolio-filter">
				<ul>
					<?php if ($_GET == null) {
						$_GET['id'] = 0;
					}  ?>
					<a href="index.php?id=0#portfolio">
						<li <?php if ($_GET['id'] == 0) {
								echo 'class="active" ';
							} ?>>all</li>
					</a>
					<a href="index.php?id=1#portfolio">
						<li <?php if ($_GET['id'] == 1) {
								echo 'class="active" ';
							} ?>>Projects</li>
					</a>
					<a href="index.php?id=2#portfolio">
						<li <?php if ($_GET['id'] == 2) {
								echo 'class="active" ';
							} ?>>Mysql Database </li>
					</a>
					<a href="index.php?id=3#portfolio">
						<li <?php if ($_GET['id'] == 3) {
								echo 'class="active" ';
							} ?>>Code</li>
					</a>
					<a href="index.php?id=4#portfolio">
						<li <?php if ($_GET['id'] == 4) {
								echo 'class="active" ';
							} ?>>Design</li>
					</a>
				</ul>
			</div>

			<div class="filters-content">
				<div class="row portfolio-grid justify-content-center">

					<?php

					$id = $_GET['id'];

					$sql = "SELECT * FROM portfolio where filter= '$id' or all_filter ='$id'";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) > 0) :
						while ($row = mysqli_fetch_assoc($result)) :
							$title = $row['title'];
							$sub_title = $row['sub_title'];

					?>

							<div class="col-lg-4 col-md-6 all">
								<div class="portfolio_box">
									<div class="single_portfolio">
										<img class="img-fluid w-100" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="">
										<div class="overlay"></div>
										<a href="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" class="img-gal">
											<div class="icon">
												<span class="lnr lnr-cross"></span>
											</div>
										</a>
									</div>
									<div class="short_info">
										<h4><a href="portfolio-details.html"><?php echo $title; ?></a></h4>
										<p><?php echo $sub_title; ?></p>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<!--================End Portfolio Area =================-->

	<!--================ Start Testimonial Area =================-->
	<div class="testimonial_area section_gap_bottom">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<div class="main_title">
						<h2>client say about me</h2>
						<p>Some comments and opinions of customers on the work that has been done.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="testi_slider owl-carousel">
					<?php
					$sql = "SELECT * FROM client";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							$name = $row['name'];
							$description = $row['description'];

					?>
							<div class="testi_item">
								<div class="row">
									<div class="col-lg-4">
										<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="">
									</div>
									<div class="col-lg-8">
										<div class="testi_text">
											<h4><?php echo $name; ?></h4>
											<p><?php echo $description; ?></p>
										</div>
									</div>
								</div>
							</div>
					<?php }
					} else {
						echo '	        			
						<div class="testi_item">
        					<div class="row">
        						<div class="col-lg-8">
        							<div class="testi_text">
        								<h4>There are no feedback yet</h4>
        						</div>
        					</div>
        				</div>
        			</div>
							
			';
					}
					?>

				</div>
			</div>
		</div>
	</div>
	<!--================ End Testimonial Area =================-->

	<!--================Footer Area =================-->
	<?php
	$sql = "SELECT * FROM footer";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) :
		while ($row = mysqli_fetch_assoc($result)) :
			$url1 = $row['url1'];
			$url2 = $row['url2'];
			$url3 = $row['url3'];
	?>
			<footer class="footer_area" id="Contact">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="footer_top flex-column">
								<div class="footer_logo">
									<a href="?id=0#">
										<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['icon']); ?>" style="
							width: 150px;
							height: 150px;
							background-position: -25px -20px;
							border-radius: 50%;
							background-size: cover;
							" alt="">
									</a>
									<h4>Follow Me</h4>
								</div>
								<div class="footer_social">
									<a href="<?php echo $url1; ?>" target=_blanck><i class="fa fa-facebook"></i></a>
									<a href="<?php echo $url2; ?>" target=_blanck><i class="fa fa-linkedin"></i></a>
									<a href="<?php echo $url3; ?>" target=_blanck><i class="fa fa-instagram"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="row footer_bottom justify-content-center">
						<p class="col-lg-8 col-sm-12 footer-text">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script> All rights reserved | made with Clever Mind POB by MOHAMMAD ABDUALLAH
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
					</div>
				</div>
			</footer>
		<?php endwhile; ?>
	<?php endif; ?>
	<!--================End Footer Area =================-->

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/stellar.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
	<script src="vendors/isotope/isotope-min.js"></script>
	<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/mail-script.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/theme.js"></script>

	<script>
		// Get the modal
		var modal = document.getElementById("myModal");

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal 
		btn.onclick = function() {
			modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>

	<script>



	</script>


</body>

</html>