<!-- Top Sale -->
<?php

    shuffle($product_shuffle);

    // request method post
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['top_sale_submit'])){
            // call method addToCart
            $Cart->addToCart($_POST['user_id'], $_POST['barcodeNumber'], $_POST['cart_total']);
        }
    }
?>


<section id="top-sale">
    <div class="container py-5">
        <h4 class="font-rubik font-size-20">Top Sale</h4>
        <hr>
        <!-- Owl Carousel -->
        <div class="owl-carousel owl-theme">
        <?php foreach ($product_shuffle as $item) { ?>
            <div class="item py-2">
                <div class="product font-rale">
                    <a href="<?php printf('%s?barcodeNumber=%s', 'product.php',  $item['barcodeNumber']); ?>"><img src="<?php echo $item['productImage'] ?? "./assets/products/1.PNG"; ?>" alt="product1" class="img-fluid"></a>
                    <div class="text-center">
                        <h6><?php echo  $item['productName'] ?? "Unknown";  ?></h6>
                        <div class="rating text-warning font-size-12">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                        </div>
                        <div class="price py-2">
                            <span>$<?php echo $item['productPrice'] ?? '0' ; ?></span>
                        </div>
                        <form method="post">
                            <input type="hidden" name="barcodeNumber" value="<?php echo $item['barcodeNumber'] ?? '1'; ?>">
                            <input type="hidden" name="user_id" value="<?php echo 1; ?>"> <!-- user id is the first user cause there is no USER SESSION -->
                            <input type="hidden" name="cart_total" value="<?php echo $item['cart_total'] ?? '0' ; ?>">
                            <!-- change the button to prevent user froma adding it to cart again --> 
                            <?php
                            if (in_array($item['barcodeNumber'], $Cart->getCartId($product->getData('cart')) ?? [])){
                                echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                            }else{
                                echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                            }
                            ?>

                        </form>
                        
                    </div>
                </div>
            </div>
            <?php } // closing foreach function ?>

            
        </div>
        <!-- !Owl Carousel -->
    </div>
</section>
<!-- !Top Sale -->