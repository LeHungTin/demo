<?php 
ob_start();
include'global/connect.php';
?>

<?php 
if (isset($_POST['name'])) {
	$re_name = $_POST['re_name'];
	$re_phone = $_POST['re_phone'];
	  
	$sql = mysqli_query($conn, "SELECT * FROM users u WHERE name = '$re_name' AND phone = '$re_phone'");

	$kt = mysqli_num_rows($sql);
	if ($kt == 1) {
		// $sql2 = mysqli_query($conn,"SELECT u.password FROM users u WHERE email = $re_email");
		// echo $sql2;
		echo 'mk';
		
	}else {
		echo 'Thông tin bạn nhập chưa chính xác';
	}



	
	
}


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
		<h2 style="text-align: center;color: red;">Vui lòng điền chính xác thông tin để lấy lại mật khẩu!</h2>
		<div class="row centered-form">
			<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Lấy lại mật khẩu</h3>
					</div>
					<div class="panel-body">
						<form role="form" action="" method="POST">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="re_name" id="re_name" class="form-control input-sm" placeholder="Name" required="">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="re_phone" id="re_phone" class="form-control input-sm" placeholder="Phone" required="">
									</div>
								</div>
							</div>


							<input type="submit" value="Lấy lại mật khẩu" class="btn btn-info btn-block">

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

