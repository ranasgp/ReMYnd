<?php
// initialize errors variable
session_start();
$username = $_SESSION['username'];
$errors = ""; ?>

<!-- <h2> Welcome <?php echo $username; ?> </h2> -->

<?php
//$username='user2';
// connect to database
//echo 'welcome'.$username;
$db = mysqli_connect("localhost", "root", "", "todo1");

// insert a quote if submit button is clicked
if (isset($_POST['submit'])) {
	if (empty($_POST['task'])) {
		$errors = "You must fill in the task";
	} else {
		$task = $_POST['task'];
		$date_task = $_POST['date_task'];
		$sql = "INSERT INTO tasks (task, date_t, username, status) VALUES ('$task','$date_task', '$username', 1)";
		//$sql = "INSERT INTO tasks (task, date_t) VALUES ('$task','$date_task')";
		mysqli_query($db, $sql);
		header('location: task_page2.php');
	}
}

// delete task
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id=" . $id . " AND username=" . "'" . $username . "'");
	header('location: task_page2.php');
}

//update task to completed
if (isset($_GET['complete_task'])) {
	$id = $_GET['complete_task'];

	mysqli_query($db, "UPDATE tasks SET status=0 where id=" . $id . " AND username=" . "'" . $username . "'");
	header('location: task_page2.php');
}


?>

<!DOCTYPE html>
<html>

<head>
	<title>ReMyNd </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
	<!-- <nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top"> -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
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
			<span class="nav-link" href="#"> <?php echo "$username" ?>
			<a class="btn btn-primary" href="testland2.php" role="button">Logout</a>
			</span>

		</div>
	</nav>
	<!-- 	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ReMYnd - Your personal tasks valet</h2>
	</div> -->
	<!-- 	<form method="post" action="task_page.php" class="input_form">
		<label for="task"> Task: </label><br>
		<input type="text" name="task" class="task_input"><br>
		<label for="date_task"> Expected completion date: </label><br>
		<input type="date" placeholder="YYYY/MM/DD" name="date_task" class="date_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form> -->

	<div class="card sticky-top">
		<div class="card-body">
			<h3 class=" animate__animated animate__bounceInLeft"> Welcome <?php echo "$username" ?> </h3>
		</div>
	</div>
	<div class="container">
		<form method="post" action="task_page2.php" class="input_form">
			<label for="task"> Task: </label><br>
			<input type="text" name="task" class="task_input"><br>
			<label for="date_task"> Expected completion date: </label><br>
			<input type="date" placeholder="YYYY/MM/DD" name="date_task" class="date_input">
			<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
		</form>
		<div class="row align-items-center">
			<div class="col">
				<h4> Outstanding tasks </h4>
			</div>
			<div class="col">
				<h4 class="animated infinite bounce delay-2s"> <?php echo "Today is " . date("Y-m-d") ?> </h4>
			</div>


		</div>


		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Date </th>
					<th scope="col">Days Left</th>


					<th scope="col">Tasks</th>

					<!-- <th scope="col" style="width: 60px;">Action</th> -->
					<th scope="col">Action</th>
				</tr>
			</thead>

			<tbody>

				<?php
				// select all tasks if page is visited or refreshed

				$tasks = mysqli_query($db, "SELECT * FROM tasks where status=1" . " AND username=" . "'" . $username . "'");

				$i = 1;
				while ($row = mysqli_fetch_array($tasks)) { ?>
					<tr>
						<td> <?php echo $i; ?> </td>
						<td class="date_task"> <?php echo $row['date_t']; ?> </td>
						<td class="date_task">  <?php 
						if(strtotime($row['date_t'])-strtotime(date(date("Y-m-d")))<0){
							 echo "Task is overdue";
						}
						else{
						echo (strtotime($row['date_t'])-strtotime(date(date("Y-m-d"))))/86400; 
					}
						?> </td>


						<td class="task"> <?php echo $row['task']; ?> </td>

						<td class="delete">
							<a href="task_page2.php?del_task=<?php echo $row['id'] ?>">delete</a>
						</td>
						<td class="complete">
							<a href="task_page2.php?complete_task=<?php echo $row['id'] ?>">complete</a>
						</td>
					</tr>
				<?php $i++;
				} ?>
			</tbody>
		</table>
	</div>

	<div class="container">
		<h4> Completed Tasks </h4>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col"> Date </th>

					<th scope="col">Tasks</th>


				</tr>
			</thead>

			<tbody>

				<?php
				// select all tasks if page is visited or refreshed

				$tasks = mysqli_query($db, "SELECT * FROM tasks where status=0" . " AND username=" . "'" . $username . "'");

				$i = 1;
				while ($row = mysqli_fetch_array($tasks)) { ?>
					<tr>
						<td> <?php echo $i; ?> </td>
						<td class="date_task"> <?php echo $row['date_t']; ?> </td>
						<td class="task"> <?php echo $row['task']; ?> </td>


					</tr>
				<?php $i++;
				} ?>
			</tbody>
		</table>
	</div>




	<?php if (isset($errors)) { ?>
		<p><?php echo $errors; ?></p>
	<?php } ?>

</body>

</html>