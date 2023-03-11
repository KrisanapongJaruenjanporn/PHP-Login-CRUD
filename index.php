<?php session_start(); ?>
<html>

<head>
	<title>Homepage</title>
	<link href="index.css" rel="stylesheet" type="text/css">
</head>

<body>
	<header class="header"></header>
	<div class="background"></div>
	<div class="container">
		<div class="item">
			<div class="text-item">
				<h2 class="logo"><i class="bx bxl-xing"></i>AJAX JINNY</h2><br>
				<h2>Welcome! <br /><span> My Website </span></h2>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit,
					repellendus?
				</p>
				<?php
				if (isset($_SESSION['valid'])) {
					include("connection.php");
					$result = mysqli_query($mysqli, "SELECT * FROM login");
				?>

					
				<?php
				} else {
					echo "You must be logged in to view this page.<br/><br/>";
					echo "<div class='create-account'> <p> <a href='login.php' class='register-link'>Login</a> </p> <p> <a href='register.php' class='register-link'> Sign Up </a> </p> </div>";
				}
				?>
				<div class="social-icon">
					<a href="#"><i class="bx bxl-facebook"></i></a>
					<a href="#"><i class="bx bxl-twitter"></i></a>
					<a href="#"><i class="bx bxl-youtube"></i></a>
					<a href="#"><i class="bx bxl-instagram"></i></a>
					<a href="#"><i class="bx bxl-linkedin"></i></a>
				</div>
			</div>
		</div>


	</div>
</body>

</html>