<?php 
ob_start();
include'global/connect.php';
?>
<?php 
$product = mysqli_query($conn, "SELECT * FROM product");

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
	<div>
		<?php include'layout/head.php'; ?>
	</div>
	<div>
		<?php include'layout/banner.php'; ?>

	</div>

	<div class="container" style="min-height: 450px;">
		<?php foreach ($product as $pro) : ?>
		<div class="col-md-3 col-lg-3" style="height: 380px;">
			<div class="thumbnail my_products">
				<img style="height: 150px;" src="uploads/<?php echo $pro['image'] ?>" alt="">
				<div class="caption">
					<h3><?php echo $pro['name']; ?></h3>
					<p>
						<b><?php echo $pro['price']; ?> $</b>
					</p>
					<div>
						<a href="chi_tiet_sp.php" class="btn btn-primary" data-toggle="tooltip" title="Chi tiết"><span class="glyphicon glyphicon-eye-open"></span></a>
						<a href="#" class="btn btn-success" data-toggle="tooltip" title="Giỏ hàng"><span class="glyphicon glyphicon-shopping-cart"></span></a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
		<div class="clearfix"></div>

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