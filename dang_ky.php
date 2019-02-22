<?php 
ob_start();
include'global/connect.php';
?>

<?php 
$errors = [];

if (isset($_POST['register'])) {

	$name = isset($_POST['name']) ? $_POST['name'] : '';
	if ($name == '') {
		$errors['name'] = 'Name không được bỏ trống';
		
	}

	$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
	if ($phone == '') {
		$errors['phone'] = 'Phone không được bỏ trống';

	}

	$email = isset($_POST['email']) ? $_POST['email'] : '';
	if ($email == '') {
		$errors['email'] = 'Email không được bỏ trống';

	}

	$password = isset($_POST['password']) ? $_POST['password'] : '';
	if ($password == '') {
		$errors['password'] = 'Password không được bỏ trống';

	}

	$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
	$check = '';

	if ($password != $confirm_password) {
		$errors['confirm_password'] = 'Password không trùng';

	}

	if ($password == $confirm_password) {
		$check = md5(md5($password));
	}
	if (!$errors) {
		$sql = mysqli_query($conn, "INSERT INTO users(name,phone,email,password) VALUES('$name','$phone','$email','$check')");

		if ($sql) {
			echo '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Đăng ký thành công!</strong>
			</div>';
		// header('location: index.php');
		}else {
			echo '<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Đăng ký thất bại!</strong>
			</div>';	
		}

	}

}
//Nếu đăng ký thất bại thì email hoặc sđt có sẵn. thay email là ok :))
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Trang chủ</title>
	<!-- Local bootstrap CSS -->
	<link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	

</head>
<body>
	<div><?php include'layout/head.php'; ?></div>
	<div class="container">
		<div class="row centered-form">
			<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Đăng ký</h3>
					</div>
					<div class="panel-body">
						<form role="form" action="" method="POST">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group <?php if (isset($errors['name'])) : ?> has-error <?php endif; ?>">
										<input type="text" name="name" id="name" class="form-control input-sm" placeholder="Name" required="">
									</div>
									<?php if (isset($errors['name'])) : ?>
										<div class="help-block">
											<?php echo $errors['name']; ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group <?php if (isset($errors['phone'])) : ?> has-error <?php endif; ?>">
										<input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Phone" required="">
									</div>
									<?php if (isset($errors['phone'])) : ?>
										<div class="help-block">
											<?php echo $errors['phone']; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group <?php if (isset($errors['email'])) : ?> has-error <?php endif; ?>">
								<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required="">
								<?php if (isset($errors['email'])) : ?>
										<div class="help-block">
											<?php echo $errors['email']; ?>
										</div>
									<?php endif; ?>
							</div>

							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group <?php if (isset($errors['password'])) : ?> has-error <?php endif; ?>">
										<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required="">
									</div>
									<?php if (isset($errors['password'])) : ?>
										<div class="help-block">
											<?php echo $errors['password']; ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group <?php if (isset($errors['confirm_password'])) : ?> has-error <?php endif; ?>">
										<input type="password" name="confirm_password" id="confirm_password" class="form-control input-sm" placeholder="Confirm_password" required="">
									</div>
									<?php if (isset($errors['confirm_password'])) : ?>
										<div class="help-block">
											<?php echo $errors['confirm_password']; ?>
										</div>
									<?php endif; ?>

								</div>

							</div>

							<input type="submit" name="register" value="Đăng ký" class="btn btn-info btn-block">

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div><?php include'layout/footer.php'; ?></div>



	<!-- bs3 -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<!-- angular -->
	<script src="js/angular.min.js"></script>
	<script src="js/angular-route.min.js"></script>
	<script src="js/app.js"></script>
	

</body>
</html>

