<?php
// initialize errors variable
session_start();
$errors = "";

// connect to database
$db = mysqli_connect("localhost", "root", "", "todo1");
?>

<?php
if (isset($_GET["name"])) {
	$name = $_GET["name"];
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" href="style2.css" type="text/css">

</head>

<body>
	<nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top">
		<div class="container-fluid">

			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="testland2.php"> Home </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.html"> About </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="register1.php"> Register </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="changepassword1.php"> Change Password </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="delete1.php"> Delete Account </a>
				</li>
			</ul>

		</div>
	</nav>
	<div class="container">
		<div class="jumbotron">
			<h1 class="display-4">ReMYnd</h1>
			<p class="lead">Your personal planning valet</p>
			<hr class="my-4">
			<p>We help you keep track of all your commitments and help you improve your productivity.</p>
			<p class="lead">
				<a class="btn btn-primary btn-lg" href="about.html" role="button">Learn more</a>
			</p>
		</div>
	</div>

	<?php
	$username = $password = "";
	if (isset($_POST["login"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		$query = "SELECT * from userinfo WHERE username = '$username' AND password = '$password' ";
		// Perform query against a database
		// https://www.php.net/manual/en/mysqli.query.php
		// https://www.w3schools.com/php/func_mysqli_query.asp => mysqli_query(connection, query, resultmode)
		$query_run = mysqli_query($db, $query);

		// https://www.w3schools.com/php/func_mysqli_num_rows.asp
		// returns the number of rows in a result set   => mysqli_num_rows(result);
		if (mysqli_num_rows($query_run) > 0) {
			//header("location:homepage.php?user=$username");
			$_SESSION['username'] = $username;
			header("location:task_page2.php?user=$username");
		} else {
			echo "<script> alert('Username or Password is incorrect.')</script>";
		}
	}
	?>


	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<div class="container">
			<div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Username</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp">

			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Password</label>
				<input type="password" class="form-control" id="exampleInputPassword1" name="password">
			</div>

			<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
			<!-- <input type="submit" id="loginbtn" value="Login" name="login"> -->
			
			<input class="btn btn-primary" type="submit" value="Login" name="login">
			<a class="btn btn-success" href="register1.php" role="button">Sign Up</a>
		</div>
	</form>

	< <script>
		$("#hidebtn").click(function() {
		$("#hide").toggle(100);
		if ($('#hidebtn').val() === 'Hide Pic') {
		$('#hidebtn').val("Show Pic");
		} else {
		$('#hidebtn').val("Hide Pic");
		}
		});
		</script>

</body>

</html>