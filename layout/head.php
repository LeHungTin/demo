<?php 
session_start();
ob_start();
include'global/connect.php';
include'global/cart-function.php';
?>

<?php 
$erros = [];

if (isset($_POST['login'])) {

	$name = isset($_POST['name']) ? $_POST['name'] : '';
	if ($name == '') {
		$erros['name'] = 'Name không được bỏ trống';
		
	}

	$password = isset($_POST['password']) ? $_POST['password'] : '';
	if ($password == '') {
		$erros['password'] = 'Password không được bỏ trống';

	}

	if (!$erros) {
		$check_password = md5(md5($password));
		$sql = mysqli_query($conn, "SELECT * FROM users WHERE name = '$name' AND password = '$check_password'");
		$row = mysqli_fetch_assoc($sql);
		$check_login = mysqli_num_rows($sql);
		if ($check_login == 1) {
			// echo '<div class="alert alert-success">
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			// <strong>Đăng nhập thành công!</strong>
			// </div>';
			$_SESSION['login'] = $row;
		// header('location: index.php');
		}

	}
	else {
		echo '<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Sai tên đăng nhập hoặc mật khẩu!</strong>
		</div>';	
	}

}

//Nếu đăng ký thất bại thì email hoặc sđt có sẵn. thay email là ok :))
?>


<nav class="navbar navbar-inverse my_nav" role="navigation" style="margin-bottom: 0px;">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="my_nav">
				<ul>
					<li><a href="index.php" data-toggle="tooltip" title="Trang chủ"><span class="glyphicon glyphicon-home"></span> WIND</a></li>
					<li><a href="gioi_thieu.php" data-toggle="tooltip" title="Giới thiệu"> GIỚI THIỆU </a></li>
					<li><a href="san_pham.php" data-toggle="tooltip" title="Sản phẩm"> SẢN PHẨM </a></li>
					<li><a href="tin_tuc.php" data-toggle="tooltip" title="Tin tức"> TIN TỨC </a></li>
					<li><a href="lien_he.php" data-toggle="tooltip" title="Liên hệ"> LIÊN HỆ </a></li>
				</ul>
			</div>
			
			
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">

			<div>
				<ul class="nav navbar-nav navbar-right">
					<?php if (isset($_SESSION['login'])): 
						$u = $_SESSION['login'];
						?>
						
						<li><a href='profile_user.php'><span class="glyphicon glyphicon-user"></span> Hi <?php echo $u['name']; ?></a>
						</li>
						<li><a href="logout.php">Logout</a></li>
						<li><a href="gio_hang.php"><span data-toggle="tooltip" title="Giỏ hàng" class="glyphicon glyphicon-shopping-cart"></span></a></li>
					</li>
					<?php else: ?>

						<li><a data-toggle="modal" href='#modal-id'><span data-toggle="tooltip" title="Người dùng" class="glyphicon glyphicon-user"></span></a>
						</li>
						<li><a href="gio_hang.php"><span data-toggle="tooltip" title="Giỏ hàng" class="glyphicon glyphicon-shopping-cart"></span></a></li>
					</li>

				<?php endif ?>
			</ul>
		</div>

		<form class="navbar-form navbar-right" role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Tìm kiếm...">
			</div>
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" data-toggle="tooltip" title="Tìm kiếm"></span></button>
		</form>

	</div><!-- /.navbar-collapse -->
</div>
</nav>


<div class="modal fade" id="modal-id">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Đăng nhập</h4>
			</div>
			<div class="modal-body">
				<form  method="POST" >


					<div class="form-group <?php if (isset($erros['name'])) : ?> has-error <?php endif; ?>">
						<label for="">Name</label>
						<input type="text" class="form-control" id="name" placeholder="Name.." name="name">
						<?php if (isset($erros['name'])) : ?>
							<div class="help-block">
								<?php echo $erros['name']; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="form-group <?php if (isset($erros['password'])) : ?> has-error <?php endif; ?>">
						<label for="">Password</label>
						<input type="Password" class="form-control" id="password" placeholder="Password.." name="password">
						<?php if (isset($erros['password'])) : ?>
							<div class="help-block">
								<?php echo $erros['password']; ?>
							</div>
						<?php endif; ?>
					</div>
					<a href="quen_mat_khau.php"><p style="color: gray;">Quên mật khẩu?</p></a>
					<button type="submit" name="login" class="btn btn-primary"><a href="dang_nhap.php"></a>Đăng nhập</button>

					<a href="dang_ky.php" class="btn btn-danger">Đăng ký</a>

				</form>
			</div>

		</div>
	</div>
</div>



