<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Giỏ hàng</title>
	<!-- Local bootstrap CSS -->
	<link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div><?php include'layout/head.php'; ?></div>
	<?php 
	$ghs = isset($_SESSION['gio-hang']) ? $_SESSION['gio-hang'] : [];

	?>
	<div class="container">
		
		<h3 style="text-align: center;">Giỏ hàng</h3>

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

						<form action="xu-li-gio-hang.php">
							
							<input name="id" type="hidden" value="<?php echo $gh['id']; ?>">
							<input name="action" type="hidden" value="update">
							<input name="quantity" value="<?php echo $gh['quantity']; ?>">
							<input type="submit" name="" value="Cập nhật">
						</form>
						

					</td>
					<td style="color: red;font-weight: bold;"><?php echo number_format(($gh['price']*$gh['quantity'])) ?> $</td>
					<td>
						
						<a onclick="return confirm('Bạn có chắc không?')" href="xu-li-gio-hang.php?id=<?php echo $gh['id']; ?>&action=delete" class="btn btn-xs btn-danger">Xóa</a>
					</td>
				</tr>
				<?php $n++; endforeach;  ?>
			</tbody>

			
		</table>
		<div class="jumbotron">
			<div class="container">
				<h4>Tổng số lượng: <?php echo tong_so_luong(); ?></h4>
				<h4>Tổng tiền: <?php echo number_format(tong_tien()); ?></h4>
				

				<p>
					<a href="index.php" class="btn btn-success btn-sm">Tiếp tục mua hàng</a>
					<a onclick="return confirm('Bạn có chắc không?')" href="xu-li-gio-hang.php?action=clear" class="btn btn-danger btn-sm">Xóa giỏ hàng</a>
					<a href="dat_hang.php" class="btn btn-primary btn-sm">Đặt hàng</a>
				</p>
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

