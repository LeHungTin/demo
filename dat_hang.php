
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Đặt Hàng</title>
	<!-- Local bootstrap CSS -->
	<link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div><?php include'layout/head.php'; ?></div>
	<?php 
	$ghs = isset($_SESSION['gio-hang']) ? $_SESSION['gio-hang'] : [];	

	?>

	<?php $errors = []; ?>


	<div class="container">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

			<?php if (isset($_SESSION['login'])):

				$u = $_SESSION['login'];

				if (isset($_POST['dat_hang'])) {
					$user_id = $u['id'];
					//1.Lấy id của người dùng để thêm vào bảng orders
					$query_order = mysqli_query($conn,"INSERT INTO orders(user_id) VALUES($user_id)");
					if ($query_order) {
						//2.Lấy id của order theo cái id của người vừa được thêm(nghĩa là cứ thêm 1 user_id thì sẽ có 1 order_id)
						$order_id = mysqli_insert_id($conn);
						//3.duyệt giỏ hàng và lưu thông tin vào bảng order_detail
						foreach ($ghs as $gh) {
							$product_id = $gh['id'];
							$quantity = $gh['quantity'];
							$price = $gh['price'];

							mysqli_query($conn,"INSERT INTO order_detail VALUES($order_id,$product_id,$quantity,$price)");

						}
						header('location: index.php');
						unset($_SESSION['gio-hang']);
					}

				}

				?>
				<?php if (tong_so_luong() > 0): ?>

					<form action="" method="POST" role="form">
						<legend>Đặt hàng</legend>

						<div class="form-group">
							<label for="">Email</label>
							<p class="form-control"><?php echo $u['email']; ?></p>

						</div>
						<div class="form-group">
							<label for="">Số điện thoại</label>
							<p class="form-control"><?php echo $u['phone']; ?></p>
						</div>
						
						<button type="submit" class="btn btn-success" name="dat_hang">Đặt hàng</button>
						<a href="gio_hang.php" class="btn btn-primary">Giỏ hàng</a>
					</form>
					<?php else: ?>
						<?php echo 'Giỏ hàng trống!'; ?>
					<?php endif; ?>

					<?php else: ?>
						<?php echo 'Vui lòng đăng nhập!'; ?>

					<?php endif; ?>

				</div>
			<!-- <div class="clearfix">

			</div> -->
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<h3 style="text-align: center;">Giỏ hàng của bạn</h3>

				<table class="table">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên</th>
							<th>Ảnh</th>
							<th>Giá</th>
							<th>Số lượng</th>
							<th>Thành tiền</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $n = 1; foreach ($ghs as $gh): ?>
						<tr>
							<td><?php echo $n; ?></td>
							<td><?php echo $gh['name']; ?></td>
							<td>
								<img src="uploads/<?php echo $gh['image'] ?>" width = "50">
							</td>
							<td><?php echo number_format($gh['price']); ?> $</td>
							<td>
								<?php echo $gh['quantity']; ?>
							</td>
							<td style="color: red;font-weight: bold;"><?php echo number_format(($gh['price']*$gh['quantity'])) ?> $</td>

						</tr>
						<?php $n++; endforeach;  ?>
					</tbody>
					<h4>Tổng số lượng: <?php echo tong_so_luong(); ?></h4>
					<h4>Tổng tiền: <?php echo number_format(tong_tien()); ?> $</h4>

				</table>
				<?php if (isset($errors['gio-hang'])): ?>
					<h3 style="color: red;"><?php echo $errors['gio-hang']; ?></h3>
				<?php endif ?>

			</div>

		</div>
		<div class="clearfix">

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
	
