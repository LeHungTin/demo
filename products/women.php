<div class="container">
	<h1 style="text-align: center;font-weight: bold;margin-bottom: 15px;">Women</h1>
	<div class="col-md-3 col-lg-3" ng-repeat="w in women">
		<div class="thumbnail my_products">
			<img style="height: 225px;" src="{{w.image}}" alt="">
			<div class="caption">
				<h3>{{w.name}}</h3>
				<p>
					<b>Price: {{w.price | currency:""}} $</b>
				</p>
				<p>
					<a href="#" class="btn btn-primary" ng-click="show_info(w)""><span class="glyphicon glyphicon-eye-open"></span> Chi tiết</a>
					<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng</a>
				</p>
			</div>
		</div>
	</div>
	<div ng-include="'layout/modal.html'"></div>
</div>