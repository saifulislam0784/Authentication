
	<?php require_once "app/autoload.php";?>

	<?php


	if(isset($_SESSION['name'])){

		header('location:profile.php');

		}

		if(isset($_COOKIE['user_login_id'])){

			$id = $_COOKIE['user_login_id'];
			$cookie_user = $connection -> query("SELECT * FROM users WHERE id = '$id'");
			$user_login_data = $cookie_user -> fetch_assoc();
			$_SESSION['user_id'] = $user_login_data['id'];

			header('location:profile.php');

		}

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Development Area</title>
		<!-- ALL CSS FILES  -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/responsive.css">
	</head>
	<body>


		<?php

			/**
			 * login form isset
			 */

			if(isset($_POST['submit'])){

				$login = $_POST['login'];
				$password = $_POST['password'];

				if(empty($login) || empty($password)){

					$mess = validate('All fields are required ');

				}else{
					$sql = "SELECT * FROM users WHERE email='$login' OR uname='$login'";
					$login_data = $connection -> query($sql);
					$login_num = $login_data -> num_rows;
					$login_user = $login_data -> fetch_assoc();

					if($login_num == 1){

						if(password_verify($password, $login_user['pass'])){

							$_SESSION['user_id'] = $login_user['id'];
							setcookie('user_login_id', $login_user['id'], time() + (60*60*24*12));

								header('location:profile.php');
						}else{

							$mess = validate('Wrong password ');

						}

					}else{
						$mess = validate('Wrong email or username ');
					}
				}

			}


		?>

		<div class="wrap shadow">
			<div class="card">
				<div class="card-body">
					<h2>Sign Up</h2>

					<?php
						if(isset($mess)){
							echo $mess;
						}
					?>
					<form action="" method = "POST">

						<div class="form-group">
							<input name="login" class="form-control" type="text" placeholder="Userame/Email">
						</div>

						<div class="form-group">
							<input name="password" class="form-control" type="password" placeholder="Password">
						</div>

						<div class="form-group">
							<input name="submit" class="btn btn-primary" type="submit" value="Log in">
						</div>

					</form>
				</div>

				<div class="card-footer">
					<a class="card-link" href="regi.php">Sign Up</a>
				</div>
			</div>
		</div>


		<div style=" width:500px; margin:0px auto; " class="recent-login clearfix">

					<?php

						if(isset($_COOKIE['recent_user_login'])){	
							$recent_login_info = $_COOKIE['recent_user_login'];
						}

						$sql = "SELECT * FROM users WHERE id IN($recent_login_info) ";
						$recent_data = $connection -> query($sql);


						while( $data = $recent_data -> fetch_assoc() ):
						
					?>


				<div style="width:25%; float:left;" class="card rl-item">

						<img style="width:100%; height:120px;" class="card-img" src="images/users/<?php echo $data['image'];?>" alt="">

					<div class="card-body">
						
						<h4 style=" font-size:16px; text-align:center;"><?php echo $data['name'];?></h4>
						<a class="btn btn-primary" href="">Log in</a>
					</div>
				
				</div>

					<?php endwhile; ?>
			
		</div>

		

		<!-- JS FILES  -->
		<script src="assets/js/jquery-3.4.1.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/custom.js"></script>
	</body>
	</html>


