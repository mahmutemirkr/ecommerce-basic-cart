<?php
error_reporting(E_ERROR);
function dataGet($path = null){
	$products = file_get_contents($path);
	$products = json_decode($products, true);
	return $products;
}

function dataSet($path = null, $products = null){
	$products = json_encode($products);
	file_put_contents($path, $products);
}

function basketGet(){
	$basket = $_COOKIE['basket'];
	$basket = json_decode($basket, true);
	return $basket;
}

function basketSet($basket){
	$basket = json_encode($basket);
	setcookie('basket', $basket, false, "/", false);
	header('Location: .');
}

function basketAdd($stokno = null){
	$basket = basketGet();

	if($basket[$stokno] > 0){

		$products = dataGet('productdata.json');
		$urun    = $products[$stokno];
		$max     = $urun['quantity'];

		if($basket[$stokno] < $max){
			$basket[$stokno] = ($basket[$stokno] + 1);
		}

	} else {
		$basket[$stokno] = 1;
	}

	basketSet($basket);
}

function basketSay(){

	$basket = basketGet();
	return count($basket);
}

function basketUp($stokno = null){
	$basket   = basketGet();

	$products = dataGet('productdata.json');
	$urun    = $products[$stokno];
	$max     = $urun['quantity'];

	if($basket[$stokno] < $max){
		$basket[$stokno] = ($basket[$stokno] + 1);
	}

	basketSet($basket);
	header("Location:cart.php");
}

function basketDown($stokno = null){
	$basket = basketGet();
	if($basket[$stokno] > 1){
		$basket[$stokno] = ($basket[$stokno] - 1);
	}
	basketSet($basket);
	header("Location:cart.php");
}

function basketDelete($stokno = null){
	$basket = basketGet();
	unset($basket[$stokno]);
	basketSet($basket);
	header("Location:cart.php");
}

function basketBosalt(){
	unset($_COOKIE['basket']);
	setcookie('basket', '', time() - 3600, '/', false);
}

function price_penny($price = null){
	$price = str_replace('.', '', $price);
	$price = str_replace(',', '.', $price);
	$penny = floatval($price) * 100;
	return $penny;
}

function penny_price($penny = 0){
	if($penny == 0) return "0,00";
	$price  = substr($penny, 0, strlen($penny) - 2);
	if($price == '') $price = 0;
	$penny = substr($penny, strlen($penny) - 2);
	return $price.",".$penny;
}

switch($_REQUEST['config']){
	case 'add':
	basketAdd($_REQUEST['stokno']);
	break;
	case 'up':
	basketUp($_REQUEST['stokno']);
	break;
	case 'down':
	basketDown($_REQUEST['stokno']);
	break;
	case 'delete':
	basketDelete($_REQUEST['stokno']);
	break;
}


?>
