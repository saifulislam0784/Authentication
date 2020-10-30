
	<?php include_once "app/autoload.php";?>

	<?php

	if(isset($_GET['logout']) AND $_GET['logout'] == 'ok'){

		
		setcookie('user_login_id', $_SESSION['user_id'], time() - (60*60*24*12));

		if(isset($_COOKIE['recent_user_login'])){

			$recent_old_val = $_COOKIE['recent_user_login'];
			$rla = explode(',', $recent_old_val);
			array_push($rla, $_SESSION['user_id']);
			$recnt_final_list = implode(',',$rla );


		}else{

			$recnt_final_list = $_SESSION['user_id'];
		}

		



		setcookie('recent_user_login', $recnt_final_list, time() + (60*60*24*12));


		session_destroy();
		header('location:index.php');

	}

	if(!isset($_SESSION['user_id'])){

		header('location:index.php');
	}

	if(isset($_SESSION['user_id'])){

		$id = $_SESSION['user_id'];
		$sql = "SELECT * FROM users WHERE id = '$id'";
		$login_info = $connection -> query($sql);
		$info = $login_info -> fetch_assoc();
		

	}

	if( isset($_GET['user_id']) ){

		$id = $_GET['user_id'];
		$sql = "SELECT * FROM users WHERE id= '$id'";
		$login_info = $connection -> query($sql);
		$info = $login_info -> fetch_assoc();
		

	}

	


	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $info['name'];?></title>
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
						<img style="width: 150px; height: 150px; display: block; margin: auto; border-radius: 40%;" src="images/users/<?php echo $info['image'];?>" alt="">
					</div>
					<h2 style="text-align: center;"><?php echo $info['name'];?></h2>

					<table class="table table-striped">

						<tr>
							<td>Name</td>
							<td><?php echo $info['name'];?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $info['email'];?></td>
						</tr>
						<tr>
							<td>Cell</td>
							<td><?php echo $info['cell'];?></td>
						</tr>
						<tr>
							<td>Uname</td>
							<td><?php echo $info['uname'];?></td>
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


