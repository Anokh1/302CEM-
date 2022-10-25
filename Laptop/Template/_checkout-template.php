<!-- Checkout section -->
<?php

    // request method post
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['cancel_submit'])){
            // call method clearCart
            $Cart->clearCart($_POST['cart_id']);
            
        }
    }
?>





<section id="checkout" class="py-3">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Checkout</h5>

        <!--  shopping cart items   -->
            <div class="row">
                <div class="col-sm-9">
                    <?php
                        foreach ($product->getData('cart') as $item) :
                            
                            $cart = $product->getProduct($item['barcodeNumber']);
                            $subTotal[] = array_map(function ($item){
                    ?>
                        <!-- cart item -->
                        <div class="row border-top py-3 mt-3">
                            <div class="col-sm-2">
                                <img src="<?php echo $item['productImage'] ?? "./assets/products/1.png" ?>" style="height: 90px;" alt="cart1" class="img-fluid">
                            </div>
                            <div class="col-sm-8">
                                <h5 class="font-baloo font-size-20"><?php echo $item['productName'] ?? "Unknown"; ?></h5>
                                <small>Category: <?php echo $item['productType'] ?? "Type"; ?></small>
                                <!-- product rating --> <!-- need to retrieve from Ratings table -->
                                <div class="d-flex">
                                    <div class="rating text-warning font-size-12">
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="far fa-star"></i></span>
                                    </div>
                                    <a href="#" class="px-2 font-rale font-size-14">10 ratings</a>
                                </div>
                                <!--  !product rating-->

                                <!-- product qty -->
                                    <div class="qty d-flex pt-2">
                                        <div class="d-flex font-rale w-25">
                                            <!-- <button class="qty-up border bg-light" data-id="<?php echo $item['barcodeNumber'] ?? '0'; ?>">
                                                <i class="fas fa-angle-up"></i>
                                            </button> -->
                                            <input type="text" data-id="<?php echo $item['barcodeNumber'] ?? '0'; ?>" 
                                                class="qty_input border px-2 w-100 bg-light" disabled value="1" placeholder="1">
                                            <!-- <button data-id="<?php echo $item['barcodeNumber'] ?? '0'; ?>"
                                                    class="qty-down border bg-light"><i class="fas fa-angle-down"></i>
                                            </button> -->
                                        </div>

                                        <!-- Delete Product Button -->
                                        <!-- <form method="post">
                                            <input type="hidden" value="<?php echo $item['barcodeNumber'] ?? 0; ?>" name="barcodeNumber">
                                            <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                                        </form> -->
                                        <!-- !Delete Product Button -->

                                        <!-- <form method="post">
                                            <input type="hidden" value="<?php echo $item['barcodeNumber'] ?? 0; ?>" name="item_id">
                                            <button type="submit" name="wishlist-submit" class="btn font-baloo text-danger">Save for Later</button>
                                        </form> -->
                                    </div>
                                <!-- !product qty -->

                            </div>

                            <!-- product price --> 
                            <div class="col-sm-2 text-right">
                                <div class="font-size-20 text-danger font-baloo">
                                    $<span class="product_price" data-id="<?php echo $item['barcodeNumber'] ?? '0'; ?>"> <!-- ternary if and else statement -->
                                        <?php echo $item['productPrice'] ?? 0; ?>
                                    </span>
                                </div>
                            </div>
                            <!-- !product price -->

                        </div>
                    <!-- !cart item -->
                    <?php
                                return $item['productPrice'];
                            }, $cart); // closing array_map function at Line 13
                        endforeach;
                        //print_r($subTotal) // to see the array that calculate the sum of the items in the cart...
                    ?>


                </div>

                <!-- subtotal section-->
                <div class="col-sm-3">
                    <div class="sub-total border text-center mt-2">
                        <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                        <div class="border-top py-4">
                            <!-- Calculate the total of the order --> 
                            <h5 class="font-baloo font-size-20">
                                <!-- count($subTotal) : display the number of items in the cart -->
                                <!-- Subtotal ( <?php echo isset($subTotal) ? count($subTotal) : 0; ?> item):&nbsp; ternaary if and else statement -->
                                Total: 
                                <span class="text-danger">
                                    $
                                    <span class="text-danger" id="deal-price">
                                        <!-- call the 'getSum' method from 'database/Cart.php' -->
                                        <?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?> 
                                    </span>
                                </span>
                            </h5>
                            <!-- !Calculate the total of the order --> 

                            <!-- Go to Checkout page -->

                            <form method="post">
                                <input type="hidden" value="<?php echo $item['cart_id'] ?? 0; ?>" name="cart_id">
                                <button type="submit" name="cancel_submit" class="btn btn-danger">Cancel</button>
                            </form>

                            <a href="./checkout.php" class="btn btn-success mt-3">Pay</a>
                            <!-- !Go to Checkout page -->
                        </div>
                    </div>
                </div>
                <!-- !subtotal section-->
            </div>
        <!--  !shopping cart items   -->
    </div>
</section>
<!-- !Checkout section -->
