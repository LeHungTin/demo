<div class="container">
	<h1 style="text-align: center;font-weight: bold;margin-bottom: 15px;">Men</h1>
	<div class="col-md-3 col-lg-3" ng-repeat="m in men">
		<div class="thumbnail my_products">
			<img style="height: 225px;" src="{{m.image}}" alt="">
			<div class="caption">
				<h3>{{m.name}}</h3>
				<p>
					<b>Price: {{m.price | currency:""}} $</b>
				</p>
				<p>
					<a href="#modal-id2" class="btn btn-primary" ng-click="show_info(m)""><span class="glyphicon glyphicon-eye-open"></span> Chi tiết</a>
					<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng</a>
				</p>
			</div>
		</div>
	</div>
	
	<div><?php include'layout/modal.php'; ?></div>
</div>