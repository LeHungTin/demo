<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sản phẩm</title>
	<!-- Local bootstrap CSS & JS -->
	<link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<style type="text/css">
	ul li:hover{
		font-size: 1.2em;
	}


</style>

<!-- bs3 -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- angular -->
<script src="js/angular.min.js"></script>
<script src="js/angular-route.min.js"></script>
<script src="js/app.js"></script>



</head>
<body>
	<div><?php include'layout/head.php'; ?></div>
	<div class="container">
		<div class="col-md-3">	
			<div class="sidebar-nav">
				<div class="well" style="padding: 8px 0;">
					<ul class="nav nav-list"> 
						<li class="nav-header" style="text-align: center;"><h3><b>Danh mục</b></h3></li>        
						<li class="active"><a href="">Bóng đá</a></li>
						<li><a href="#"> Cầu lông</a></li>
						<li><a href="#"> Bóng rổ</a></li>
						<li><a href="#"> Men</a></li>
						<li><a href="#"> Women</a></li>
						<li><a href="#"> Kid</a></li>
					</ul>
				</div>
			</div>
		</div>
		<?php 
			$sql = "SELECT * FROM product";
			$products = mysqli_query($conn,$sql);
		 ?>
		<div class="col-md-9">
			<div class="container" style="max-width: 100%;">
				<h1 style="text-align: center;font-weight: bold;margin-bottom: 15px;">Bóng đá</h1>
				<?php foreach ($products as $pro): ?>
					
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
			</div>

		</div>
	</div>

	<div><?php include'layout/footer.php'; ?></div>

</body>
</html>