<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "todo1");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registration Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" href="style2.css" type="text/css">
		<script src="https://kit.fontawesome.com/b26b33266f.js" crossorigin="anonymous"></script>
		
        <!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
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
		<h1 class="display-4">ReMYnd - Register for a new account</h1>
		<p class="lead">Your personal planning valet</p>
		<hr class="my-4">
		<p>We help you keep track of all your commitments and help you improve your productivity.</p>
		<p class="lead">
			<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		</p>
	</div>
</div>


		<?php
			$username = $password = $cpassword = "";
			// isset — Determine if a variable is declared and is different than NULL
			if(isset($_POST["reg_btn"])){
				$username = $_POST["username"];
				$password = $_POST["password"];
				$cpassword = $_POST["cpassword"];
				
				if($password == $cpassword){
					$query = "SELECT * from userinfo WHERE username ='$username'";
					// Perform query against a database
					// https://www.php.net/manual/en/mysqli.query.php
					// https://www.w3schools.com/php/func_mysqli_query.asp => mysqli_query(connection, query, resultmode)
					$query_run = mysqli_query($db, $query);

					// https://www.w3schools.com/php/func_mysqli_num_rows.asp
					// returns the number of rows in a result set   => mysqli_num_rows(result);
					if(mysqli_num_rows($query_run)>0){
						echo "<script> alert('Username taken')</script>";
					}else{
						$query = "INSERT into userinfo(username, password) VALUES('$username', '$password')";
						$query_run = mysqli_query($db, $query);

						if($query_run){
							echo "<script> alert('User registered! Proceed to Login.')</script>";
						}else{
							echo "<script> alert('Unable to create account')</script>";
						}
					}
				}else{
					echo "<script> alert('Passwords do not match!')</script>";
				}
			}
		?>

<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<div class="container">
		<div class="mb-3">
			<label for="exampleInputEmail1" class="form-label">Username</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name = "username" aria-describedby="emailHelp">
			
		</div>
		<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Password</label>
			<input type="password" class="form-control" id="exampleInputPassword1" name = "password">
		</div>
        <div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Confirm Password</label>
			<input type="password" class="form-control" id="exampleInputPassword1" name = "cpassword">
		</div>
        <!-- <input type="submit" id="loginbtn" value="Login" name="login"> -->
        <input class="btn btn-primary" type="submit" value="Register Account" name="reg_btn">

	</form>




<!-- 
		<div>
			<h1>
				REGISTER
			</h1>

			<h2>
				<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class = "loginbox">
					<div class = "loginfield">
						<span style="font-size: 20px; color: white;">
  							<i class="fas fa-user"></i>
						</span>						
						<input type="text" placeholder="Your Username" name = "username" required>
					</div>

					<div class = "loginfield">
						<span style="font-size: 20px; color: white;">
							<i class="fas fa-lock"></i>
						</span>
						<input type="password" placeholder="Your Password" name = "password" required>
					</div>

					<div class = "loginfield">
						<span style="font-size: 20px; color: white;">
							<i class="fas fa-lock"></i>
						</span>
						<input type="password" placeholder="Confirm Password" name = "cpassword" required>
					</div>
					
					<div>
						<input type="submit" id="registerbtn" value="Register Account" name="reg_btn">
						<br>
						<input type="button" id="backbtn" value="Back to Login Page" onclick= "window.location.href = 'index.php'">
					</div>
				</form>

			</h2>
		</div> -->

	</body>
</html>