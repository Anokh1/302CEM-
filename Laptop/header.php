<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">

    <?php
        // require functions.php file
        require('functions.php');
        //C:\xampp\htdocs\Agile\Laptop\functions.php
    ?>
</head>
<body>

    <!-- start #header -->
        <header id="header">
            <div class="strip d-flex justify-content-between px-4 py-1 bg-light">
                <p class="font-rale font-size-12 text-black-50 m-0">Group 11 INTI International College Penang</p>
                <div class="font-rale font-size-14">
                    <a href="#" class="px-3 border-right border-left text-dark">Login</a>
                </div>
            </div>
            <!-- Primary Navigation -->
            <nav class="navbar navbar-expand-lg color-primary-bg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">Agile Laptop</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav m-auto font-rubik">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Category</a>
                      </li>
                    </ul>
                    <form action="#" class="font-size-14 font-rale">
                        <!-- Go to Cart page -->
                        <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
                            <!-- Shopping Cart icon not working -->
                            <span class="font-size-16 px-2 text-white"><i class="fa-solid fa-cart-shopping"></i></span>
                            <!-- Cart quantity --> 
                            <span class="px-3 py-2 rounded-pill text-dark bg-light">
                                <?php echo count($product->getData('cart')); ?></span>
                        </a>
                    </form>
                  </div>
                </div>
            </nav>
            <!-- !Primary Navigation -->

        </header>
    <!-- !start #header -->

    <!-- start #main -->
        <main id="main-site"> 

