<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<html>

<head>
	<title>Add Data</title>
</head>

<body>
	<?php
	ini_set('display_errors', 0);
	include_once("connection.php");

	$name = $_POST['name'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	$pic = $_POST['pic'];
	$loginId = $_SESSION['id'];

	$file = $_FILES['pic'];

	if ($_FILES['pic']['error'] > 0) echo "Error:" . $_FILES['pic']['error'] . "<br/>";
	
	if (file_exists("images/" . $_FILES['pic']['name'])) {
		echo $_FILES['pic']['name'] . " already exists.<br />";
	} else {
		move_uploaded_file($_FILES['pic']['tmp_name'], "images/" . $_FILES['pic']['name']);
	}
	//including the database connection file
	include_once("connection.php");

	if (isset($_POST['Submit'])) {
		$name = $_POST['name'];
		$qty = $_POST['qty'];
		$price = $_POST['price'];
		$pic = $_FILES['pic']['name'];
		$loginId = $_SESSION['id'];

		// checking empty fields
		if (empty($name) || empty($qty) || empty($price)) {

			if (empty($name)) {
				echo '<script language="javascript">';
				echo 'alert("Name field is empty.")';
				echo '</script>';
			}

			if (empty($qty)) {
				echo '<script language="javascript">';
				echo 'alert("Quantity field is empty.")';
				echo '</script>';
			}

			if (empty($price)) {
				echo '<script language="javascript">';
				echo 'alert("Price field is empty.")';
				echo '</script>';
			}

			//link to the previous page
			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
			header('Location: add.html');
		} else {
			// if all the fields are filled (not empty) 

			//insert data to database	
			$result = mysqli_query($mysqli, "INSERT INTO products(name, qty, price, pic, login_id) VALUES('$name','$qty','$price', '$pic', '$loginId')");

			//display success message
			header('Location: view.php');
		}
	}
	?>
</body>

</html>