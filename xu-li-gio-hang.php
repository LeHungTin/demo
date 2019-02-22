<?php 
//b1. tạo session start và include connect.
session_start();
include 'global/connect.php';
include'global/cart-function.php';

//b2. tạo biến $id.

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : 'add';
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
$quantity = $quantity > 0 ? $quantity : 1;

// echo $action;die;
//b3. truy vấn để lấy sản phẩm theo id.

$query = mysqli_query($conn,"SELECT * FROM product WHERE id = '$id'");

//b4 . lấy kết quả nếu duyệt thành công.

$row = mysqli_fetch_assoc($query);

// session_destroy();

//b5. kiểm tra $row => nếu có thì tạo session giỏ hàng ? nếu không thì trả về mảng rỗng.

if ($row && $action == 'add') {
	if (isset($_SESSION['gio-hang'][$id])) {
		$_SESSION['gio-hang'][$id]['quantity'] += 1;
		
	}else { 

		$_SESSION['gio-hang'][$id] = [
			'id' => $row['id'],
			'image' => $row['image'],
			'name' => $row['name'],
			'price' => $row['sale_price'] ?  $row['sale_price'] : $row['price'],
			'quantity' => 1
		];
		
	}

	header('location: index.php');

}
if ($action == 'update') {
	if (isset($_SESSION['gio-hang'][$id])) {
		$_SESSION['gio-hang'][$id]['quantity'] = $quantity;
	}
	header('location: gio_hang.php');
}

if ($action == 'delete') {
	if (isset($_SESSION['gio-hang'][$id])) {
		unset($_SESSION['gio-hang'][$id]);
	}
	header('location: gio_hang.php');
}
if ($action == 'clear') {
	if (isset($_SESSION['gio-hang'])) {
		unset($_SESSION['gio-hang']);
	}
	header('location: gio_hang.php');
}



	// echo '<pre>';
	// print_r($_SESSION['gio-hang']);
?>

