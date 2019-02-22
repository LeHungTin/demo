var app = angular.module('app',['ngRoute']);

app.config(function($routeProvider) {
	$routeProvider
	.when('/bong_da',{
		templateUrl: 'products/bong_da.html'
	})
	.when('/cau_long',{
		templateUrl: 'products/cau_long.html'
	})
	.when('/bong_ro',{
		templateUrl: 'products/bong_ro.html'
	})
	.when('/kid',{
		templateUrl: 'products/kid.html'
	})
	.when('/women',{
		templateUrl: 'products/women.html'
	})
	.when('/men',{
		templateUrl: 'products/men.html'
	})
	
});

app.controller('homeCtrl', function($scope,$http){

	$scope.products1 = [
	{name:"BÓNG ĐÁ",link:"#!/bong_da"},
	{name:"CẦU LÔNG",link:"#!/cau_long"},
	{name:"BÓNG RỔ",link:"#!/bong_ro"}
	];
	$scope.footer_img = [
	{link:"https://twitter.com",img:"images/footer/1.png"},
	{link:"https://facebook.com",img:"images/footer/2.png"},
	{link:"https://facebook.com/instagram",img:"images/footer/3.png"},
	{link:"https://youtube.com",img:"images/footer/4.png"},
	];
	$scope.products2 = [
	{name:"MEN",link:"#!/men"},
	{name:"WOMEN",link:"#!/women"},
	{name:"KID",link:"#!/kid"}
	];

	$scope.nav = [
	{name:"GIỚI THIỆU",link:"gioi_thieu.html"},
	{name:"SẢN PHẨM",link:"san_pham.html"},
	{name:"TIN TỨC",link:"tin_tuc.html"},
	{name:"LIÊN HỆ",link:"lien_he.html"}
	];

	$http.get('data/bong_da.json').then(function(res){
		$scope.bong_da = res.data;

	});
	$http.get('data/cau_long.json').then(function(res){
		$scope.cau_long = res.data;

	});
	$http.get('data/bong_ro.json').then(function(res){
		$scope.bong_ro = res.data;

	});
	$http.get('data/kid.json').then(function(res){
		$scope.kid = res.data;

	});
	$http.get('data/men.json').then(function(res){
		$scope.men = res.data;

	});
	$http.get('data/women.json').then(function(res){
		$scope.women = res.data;

	});
	$scope.show_info = function(something){
		event.preventDefault();
		
		$scope.info = something;
		$("#modal-id2").modal("show");
	}

	
});