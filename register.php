<html>

<head>
	<title>Register</title>
</head>

<body>
	<a href="index.php">Home</a> <br />
	<?php
	ini_set('display_errors', 0);
	include_once("connection.php");
	$name = $_POST['name'];
	$email = $_POST['email'];
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$profile = $_POST['profile'];

	$file = $_FILES['profile'];

	if ($_FILES['profile']['error'] > 0) echo "Error:" . $_FILES['profile']['error'] . "<br/>";

	if (file_exists("User/" . $_FILES['profile']['name'])) {
		echo $_FILES['profile']['name'] . " already exists.<br />";
	} else {
		move_uploaded_file($_FILES['profile']['tmp_name'], "User/" . $_FILES['profile']['name']);
	}

	include("connection.php");

	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$profile = $_POST['profile'];
		if ($user == "" || $pass == "" || $name == "" || $email == "") {
			echo "All fields should be filled. Either one or many fields are empty.";
			echo "<br/>";
			echo "<a href='register.php'>Go back</a>";
		} else {
			mysqli_query($mysqli, "INSERT INTO login(name, email, username, profile, password) VALUES('$name', '$email', '$user', '$profile', md5('$pass'))")
				or die("Could not execute the insert query.");

			echo "Registration successfully";
			echo "<br/>";
			echo "<a href='login.php'>Login</a>";
		}
	} else {
	?>
		<p>
			<font size="+2">Register</font>
		</p>
		<form name="form1" method="post" action="">
			<table width="75%" border="0">
				<tr>
					<td width="10%">Full Name</td>
					<td><input type="text" name="name"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="username"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td>Profile</td>
					<td><label id="font">เลือกรูปภาพ: </label><br /><input type="file" name="profile" id="profile" placeholder="รูป" accept="User/*" required /></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
	<?php
	}
	?>
</body>

</html>