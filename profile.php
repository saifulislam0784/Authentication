
<?php include_once "app/autoload.php";?>

<?php

if(isset($_GET['logout']) AND $_GET['logout'] == 'ok'){

	session_destroy();
	header('location:index.php');

}

if(!isset($_SESSION['name'])){

	header('location:index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION['name'];?></title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	
	<div class="wrap shadow">
	<a class="btn btn-primary btn-sm" href="users.php">All Users</a>
		<div class="card">
			<div class="card-body ">
				<div class="profile">
					<img style="width: 150px; height: 150px; display: block; margin: auto; border-radius: 40%;" src="images/users/<?php echo $_SESSION['image'];?>" alt="">
				</div>
				<h2 style="text-align: center;"><?php echo $_SESSION['name'];?></h2>

				<table class="table table-striped">

					<tr>
						<td>Name</td>
						<td><?php echo $_SESSION['name'];?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $_SESSION['email'];?></td>
					</tr>
					<tr>
						<td>Cell</td>
						<td><?php echo $_SESSION['cell'];?></td>
					</tr>
					<tr>
						<td>Uname</td>
						<td><?php echo $_SESSION['uname'];?></td>
					</tr>
					

				</table>

				<a class="btn btn-secondary btn-sm" href="?logout=ok">Log Out</a>
			</div>
		</div>
	</div>
	

	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>


