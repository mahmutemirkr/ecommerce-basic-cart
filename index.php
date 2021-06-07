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

        <div class="jumboth jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Anasayfa</h1>
                <p class="lead">E-ticaret Sepet Uygulaması</p>
            </div>
        </div>

        <div class="row mb-3">
            <?php
            $products = dataGet('productdata.json');
            foreach($products as $key => $product){  ?>  

                <div class="col-md-3 col-sm-6 mt-3">
                    <div class="card mr-3 cardwh">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['productname']; ?></h5>
                            <p class="card-text"><?php echo $product['price']; ?><span><?php echo $product['currency']; ?></span></p>
                            <form id="dataForm">
                                <a href="?config=add&stokno=<?php echo $product['stokno'];?>" id="dataSend" class="btn btn-primary">Sepete Ekle</a>
                            </form>
                        </div>
                    </div>
                </div>

            <?php } ?>


        </div>

    </div>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>