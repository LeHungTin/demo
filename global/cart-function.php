<?php 
$ghs = isset($_SESSION['gio-hang']) ? $_SESSION['gio-hang'] : [];
// $id = isset($_GET['id']) ? $_GET['id'] : 0;

function tong_so_luong()
{
	
	global $ghs;
	$tong_so_luong = 0;
	foreach ($ghs as $gh) {
		$tong_so_luong = $tong_so_luong + $gh['quantity'];
		
	}
	return $tong_so_luong;
}

function tong_tien()
{
	
	global $ghs;
	$tong_tien = 0;
	foreach ($ghs as $gh) {
		$tong_tien = $tong_tien + ($gh['quantity']*$gh['price']);
		
	}
	return $tong_tien;
}

// function tang()
// {
// 	if (isset($_SESSION['gio-hang'][$id])) {
// 		$_SESSION['gio-hang'][$id]['quantity'] += 1;

// 	}
// }
// function giam()
// {
// 	if (isset($_SESSION['gio-hang'][$id])) {
// 		$_SESSION['gio-hang'][$id]['quantity'] -= 1;

// 	}
// }


?>