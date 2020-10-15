
<?php require_once "app/autoload.php";?>

<?php

if(isset($_SESSION['name'])){

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

						$_SESSION['name'] = $login_user['name'];
						$_SESSION['email'] = $login_user['email'];
						$_SESSION['cell'] = $login_user['cell'];
						$_SESSION['uname'] = $login_user['uname'];
						$_SESSION['image'] = $login_user['image'];

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
	


	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>


