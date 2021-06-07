<?php 
include 'products.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>E-ticaret | MEK</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>

	<div class="container">

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Sepet</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Anasayfa<span class="sr-only"></span></a>
					</li>

					<a href="cart.php">
						<button type="button" class="btn btn-outline-success">
							Sepetim <span class="badge badge-light"><?php echo basketSay(); ?></span>
						</button>
					</a>

				</ul>
			</div>
		</nav>

		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Sepet</h1>
				<p class="lead">E-ticaret Spet Uygulaması</p>
			</div>
		</div>

		<div class="row">
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Stok No</th>
						<th>Ürün Adı</th>
						<th>Fiyat</th>
						<th></th>
						<th>Adet</th>
						<th></th>
						<th>Ara Toplam</th>
						<th>Ürün Sil</th>
					</tr>
				</thead>
				<tbody>

					<?php 
					$basket   = basketGet();
					$products = dataGet('productdata.json');
					foreach($products as $key => $product){
						if($basket[$product['stokno']] > 0){ ?>

							<tr>
								<th scope="row"><?php echo $product['stokno']; ?></th>
								<td><?php echo $product['productname']; ?></td>
								<td><?php echo $product['price']; ?></td>

								<td><a href="?config=down&stokno=<?php echo $product['stokno']?>"><button type="submit" class="ml-3 btn btn-warning">Adet(-)</button></a></td>
								<td><p><?php echo $basket[$product['stokno']]; ?> / <?php echo $product['quantity']; ?></p></td>

								<td><a href="?config=up&stokno=<?php echo $product['stokno']?>"><button type="submit" class="mr-3 btn btn-warning">Adet(+)</button></a></td>
								<td><?php 
								
								$say = $basket[$product['stokno']];
								$price = $product['price'];
								$penny = price_penny($price);
								$penny= $penny*$say;
								$price = penny_price($penny);
								echo $price;
								$gprice = $penny+$gprice;

								?></td>
								<td><a href="?config=delete&stokno=<?php echo $product['stokno']?>"><button type="submit" class="btn btn-danger">Sil</button></a></td>
							</tr>
						<?php } } ?>

					</tbody>
				</table>
				<tr>
					<td scope="row">Genel Toplam: <?php echo penny_price($gprice).' TL'; ?></td>
				</tr>
			</div>
		</div>

		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
	</body>
	</html>