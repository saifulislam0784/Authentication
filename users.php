<?php require_once "app/autoload.php";?>

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
	
	

	<div class="wrap-table shadow">
	<a class="btn btn-primary btn-sm" href="profile.php">Your profile</a>
		<div class="card">
			<div class="card-body">
				<h2>All Data</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
						
							$sql = "SELECT * FROM users";
							$data = $connection -> query($sql);
							$i = 1;
							while($user = $data -> fetch_assoc() ):
						
						?>

						<tr>
							<td><?php echo $i;$i++;?></td>
							<td><?php echo $user['name'];?></td>
							<td><?php echo $user['email'];?></td>
							<td><?php echo $user['cell'];?></td>
							<td><img src="images/users/<?php echo $user['image'];?>" alt=""></td>
							<td>
								<a class="btn btn-sm btn-info" href="profile.php?user_id=<?php echo $user['id'];?>">View</a>

								<?php if($user['id'] == $_SESSION['user_id']): ?>

									<a class="btn btn-sm btn-warning" href="#">Edit</a>
									<a class="btn btn-sm btn-danger" href="#">Delete</a>

								<?php endif; ?>
							</td>
						</tr>
						
						<?php endwhile; ?>

					</tbody>
				</table>
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