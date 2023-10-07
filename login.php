<?php ob_start();
session_start();
include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>

	<!-- font awesome cdn link  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link rel="icon" type="image/png" sizes="32x32" href="./image/favicon/favicon.ico">

</head>

<body>

	<section class="login-section">
		<div class="container">
			<div class="row justify-content-center align-items-center" style="height:100vh;">
				<div class="col-md-5">
					<?php
					if (isset($_POST['login'])) {

						$username = $_POST['username'];
						$password = md5($_POST['password']);

						$check_sql = "select * from admin_user where username = '$username' and password = '$password'";
						$check_result = $conn->query($check_sql);
						$check_count = $check_result->num_rows;

						if ($check_count == 1) {

							$check_row = $check_result->fetch_assoc();

							$_SESSION['login'] = true;
							$_SESSION['userid'] = $check_row['user_id'];
							$_SESSION['username'] = $check_row['username'];

							header('location: admin/');
						} else {
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
   Username or password not match.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
						}
					}


					?>

					<div class="card">
						<div class="card-header">
							Login Form
						</div>
						<div class="card-body">

							<form action="" method="post">
								<div class="row">

									<div class="col-md-12 mb-2">
										<label class="form-label">Username</label>
										<input type="text" class="form-control" name="username" placeholder="Enter Username">
									</div>

									<div class="col-md-12 mb-3">
										<label class="form-label">Password</label>
										<input type="password" class="form-control" name="password" placeholder="Enter Password">
									</div>

									<div class="col-md-4 mb-2">
										<button type="submit" name="login" class="btn btn-success">Login</button>
									</div>


								</div>
							</form>

						</div>
					</div>

				</div>
			</div>
		</div>
	</section>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>