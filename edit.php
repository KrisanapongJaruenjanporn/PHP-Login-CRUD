<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
// including the database connection file
include_once("connection.php");

if (isset($_POST['update'])) {
	$id = $_POST['id'];

	$name = $_POST['name'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	$pic = $_POST['pic'];


	// checking empty fields
	if (empty($name) || empty($qty) || empty($price)) {

		if (empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}

		if (empty($qty)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}

		if (empty($price)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}
	} else {
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE products SET name='$name', qty='$qty', price='$price', pic='$pic' WHERE id=$id");

		//redirectig to the display page. In our case, it is view.php
		header("Location: view.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
	$name = $res['name'];
	$qty = $res['qty'];
	$price = $res['price'];
	$pic = $res['pic'];
}
?>
<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Edit Data</title>
</head>

<body style="background: #EDDCD2;">
	<div class="container-fluid">
		<div class="row">
			<div class="col col-lg-2 ">
				<ul class="nav flex-column">
					<img src="Dark.gif" class="figure-img img-fluid rounded" alt="...">
					<li class="nav-item">
						<a href="profile.php" class="nav-link">
							<?php echo $_SESSION['name'] ?>
						</a>
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
			<div class="col">
				<form name="form1" method="post" action="edit.php">
					<div class="mb-3">

					</div>
					<table border="0">
						<tr>
							<td>Name</td>
							<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
						</tr>
						<tr>
							<td>Quantity</td>
							<td><input type="text" name="qty" value="<?php echo $qty; ?>"></td>
						</tr>
						<tr>
							<td>Price</td>
							<td><input type="text" name="price" value="<?php echo $price; ?>"></td>
						</tr>
						<tr>

							<td>Pic</td>
							<td> <img src="<?PHP echo 'images/' . $res['pic']; ?>" class="card-img-top" style="width: 100%; height: 65%; background-size: cover; padding-top: 10px; border-radius: 20px;" alt="...">
							</td>
							<td><label id="font">เลือกรูปภาพ: </label><br /><input type="file" name="pic" id="pic" placeholder="รูป" accept="image/*" required /></td>
						</tr>
						<tr>
							<td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
							<td><input type="submit" name="update" value="Update"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>


</body>

</html>