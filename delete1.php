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
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
		<title>Delete Account Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" href="style2.css" type="text/css">
		<script src="https://kit.fontawesome.com/b26b33266f.js" crossorigin="anonymous"></script>
		
        <!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
		<title>Delete Account</title>
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
		<h1 class="display-4">ReMYnd - Delete Account</h1>
		<p class="lead">Your personal planning valet</p>
		<hr class="my-4">
		<p>We help you keep track of all your commitments and help you improve your productivity.</p>
		<p class="lead">
			<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		</p>
	</div>
</div>
		<?php
			$username = $password =  "";
			if(isset($_POST["delete"])){
				$username = $_POST["username"];
				$password = $_POST["password"];
				
					$query = "SELECT * from userinfo WHERE username ='$username' AND password = '$password'";
					$query_run = mysqli_query($db, $query);

					if(mysqli_num_rows($query_run)>0){
						$query = "DELETE from userinfo WHERE username = '$username'";
						$query_run = mysqli_query($db, $query);
						echo "<script> alert('Account deleted')</script>";
					}else{
							echo "<script> alert('Unable to delete account')</script>";
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
        <!-- <input type="submit" id="loginbtn" value="Login" name="login"> -->
        <input class="btn btn-primary" type="submit" value="Delete Account" name="delete">

	</form>
		<!-- 
		<div>
			<h1>
				DELETE
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
					
					<div>
						<input type="submit" id="delbtn" value="Delete" name="delete">
						<br>
						<input type="button" id="backbtn" value="Back to Login Page" onclick= "window.location.href = 'index.php'">
					</div>
				</form>
			</h2>
		</div>
 -->
	</body>
</html>