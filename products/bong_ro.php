<div class="container">
	<h1 style="text-align: center;font-weight: bold;margin-bottom: 15px;">Bóng rổ</h1>
	<div class="col-md-3 col-lg-3" ng-repeat="br in bong_ro">
		<div class="thumbnail my_products">
			<img style="height: 225px;" src="{{br.image}}" alt="">
			<div class="caption">
				<h3>{{br.name}}</h3>
				<p>
					<b>Price: {{br.price | currency:""}} $</b>
				</p>
				<p>
					<a href="#" class="btn btn-primary" ng-click="show_info(br)"><span class="glyphicon glyphicon-eye-open"></span> Chi tiết</a>
					<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng</a>
				</p>
			</div>
		</div>
	</div>
	<div ng-include="'layout/modal.html'"></div>

</div>