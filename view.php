<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE login_id=" . $_SESSION['id'] . " ORDER BY id DESC");
?>

<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Homepage</title>
</head>

<body style="background: #EDDCD2;">
	<div class="container-fluid">
		<div class="row">
			<div class="col col-lg-2 ">
				<ul class="nav flex-column">
					<img src="Dark.gif" class="figure-img img-fluid rounded" alt="...">
					<li class="nav-item" style="text-align: center;">
						<h3>
							<?php echo $_SESSION['name'] ?>
						</h3>
					</li>
					<li class="nav-item">
						<a href="view.php" class="nav-link">
							<span class="fa fa-home"></span>
							<span>Home</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="add.html" class="nav-link">
							<span class="fa fa-search"></span>
							<span>Add</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="logout.php" class="nav-link">
							<span class="fa fas fa-book"></span>
							<span>Logout</span>
						</a>
					</li>

				</ul>
			</div>
			<!-- <div class="col"> -->
			<div class="col">
				<div class='row row-cols'>
					<form name='search' action="" method="get">
						<div class="input-group mb-3" style="margin-top: 10px;">
							<span class="input-group-text" id="inputGroup-sizing-default">ช่องค้นหา</span>
							<input type="text" id="searching" name="searching" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
							<button type="submit">ค้นหา</button>

						</div>

					</form>
					<?PHP
					ini_set('display_errors', 0); // hide warning
					include('connectDB.php');


					if ($_GET['searching'] != "") {
						$sql = "SELECT * from products WHERE name LIKE '" . $_GET['searching'] . "'";
					} else {
						$sql = "select * from products";
					}
					?>

					<?php
					$data = mysqli_query($mysqli, $sql);
					while ($res = mysqli_fetch_array($data)) {
					?>
						<div class="card" style="width: 17rem; height: 26rem; margin: 5px; background: #EDDCD2;">
							<img src="<?PHP echo 'images/' . $res['pic']; ?>" class="card-img-top" style="width: 100%; height: 65%; background-size: cover; padding-top: 10px; border-radius: 20px;" alt="...">
							<?php
							echo "<div class='card-body' >";
							echo "<h5 class='card-title'>" . $res['name'] . "</h5>";
							echo "<p class='card-text' >" . $res['price'] . "</p>";
							echo "<div class='container'>";
							echo "<form method='POST'> <a href='Buy.php' class='btn btn-warning' type='submit' name='submit_button'>Buy</a> <a class='btn btn-warning' href=\"edit.php?id=$res[id]\">Edit</a> <a class='btn btn-danger' href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>";
							echo "</form></div>";
							echo "</div>";

							?>
						</div>
					<?php
					}
					?>

				</div>
			</div>
		</div>
	</div>
</body>

</html>