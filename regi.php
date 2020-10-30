<?php require_once "app/autoload.php"; ?>

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
	 * isset
	 */

	 if(isset($_POST['add'])){

		$name = $_POST['name'];
		$email = $_POST['email'];
		$cell = $_POST['cell'];
		$uname = $_POST['uname'];
		$pass = $_POST['pass'];
		$cpass = $_POST['cpass'];


		/**
		 * make password hash
		 */

		$hash = password_hash ($pass, PASSWORD_DEFAULT);


		/**
		 * agreement
		 */

		$terms = "disagree";
		if(isset($_POST['terms'])){

			$terms = $_POST['terms'];

		}


		
			 /**
			 * Existing email check
			 */
			$email_check = valueCheck('users', 'email', $email);

			/**
			 * Existing username check
			 */
			$uname_check = valueCheck('users', 'uname', $uname);

			/**
			 * Existing cell check
			 */
			$cell_check = valueCheck('users', 'cell', $cell);

			/**
			 * file upload
			 */

			 $file_name = $_FILES['image']['name'];
			 $file_tmp = $_FILES['image']['tmp_name'];

			 $unique_name = md5(time() . rand()) . $file_name;
		
			 /**
			 * emphty field validation
			 */

		if (empty($name) || empty($email) || empty($cell) || empty($uname) || empty($pass)){

			$mess = validate('All fields are required ');

		}elseif($terms == "disagree"){

			$mess = validate('You should agree terms and conditions ');

		}elseif( $pass != $cpass){

			$mess = validate('Password did not match ');

		}elseif( !filter_var( $email, FILTER_VALIDATE_EMAIL)){

			$mess = validate('Invalid email id ');			

		}elseif($email_check >0){

			$mess = validate('This email alrady exist ');

		}elseif($uname_check >0){

			$mess = validate('Username alrady exist ');

		}elseif($cell_check >0){

			$mess = validate('Phone alrady exist ');

		} else{

			insert("INSERT INTO users ( name, email, cell, uname, pass, image, terms) VALUES ('$name','$email','$cell','$uname','$hash', '$unique_name','$terms')");
			
			move_uploaded_file($file_tmp, 'images/users/' . $unique_name) ;

			$mess = validate('Registration successfull', 'success');
			
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

				<form action="" method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<input name="name" class="form-control" type="text" placeholder="Name">
					</div>

					<div class="form-group">
						<input name="email" class="form-control" type="text" placeholder="Email">
					</div>

					<div class="form-group">
						<input name="cell" class="form-control" type="text" placeholder="Cell">
					</div>

					<div class="form-group">
						<input name="uname" class="form-control" type="text" placeholder="Username">
					</div>

					<div class="form-group">
						<input name="pass" class="form-control" type="password" placeholder="Password">
					</div>

					<div class="form-group">
						<input name="cpass" class="form-control" type="password" placeholder="Re-type Password">
					</div>

					<div class="form-group">
						<label for="">Image</label>
						<input name="image" class="form-control-file" type="file" >
					</div>

					<div class="form-group">
						<input name="terms" agree= "agree" type="checkbox" id="agree"><label for="agree">I agree</label>
					</div>
					
					<div class="form-group">
						<input name="add" class="btn btn-primary" type="submit" value="Sign Up">
					</div>

					<div class="card-footer">
						<a class="card-link" href="index.php">Log In</a>
					</div>

				</form>
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


