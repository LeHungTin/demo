<div class="container">
	<h1 style="text-align: center;font-weight: bold;margin-bottom: 15px;">Cầu lông</h1>
	<div class="col-md-3 col-lg-3" ng-repeat="cl in cau_long">
		<div class="thumbnail my_products">
			<img style="height: 225px;" src="{{cl.image}}" alt="">
			<div class="caption">
				<h3>{{cl.name}}</h3>
				<p>
					<b>Price: {{cl.price | currency:""}} $</b>
				</p>
				<p>
					<a href="#" class="btn btn-primary" ng-click="show_info(cl)"><span class="glyphicon glyphicon-eye-open"></span> Chi tiết</a>
					<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng</a>
				</p>
			</div>
		</div>
	</div>
	<div ng-include="'layout/modal.html'"></div>

</div>