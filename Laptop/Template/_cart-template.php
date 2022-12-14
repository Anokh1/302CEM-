<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete-cart-submit'])) {
        $deletedrecord = $Cart->deleteCart($_POST['barcodeNumber']);
    }
}
?>

<!-- Shopping cart section  -->
<section id="cart" class="py-3">
        <div class="container-fluid w-75">
            <h5 class="font-baloo font-size-20">Shopping Cart</h5>

            <!--  shopping cart items   -->
                <div class="row">
                    <div class="col-sm-9">
                        <?php
                        foreach ($product->getData('cart') as $item) :
                                $cart = $product->getProduct($item['barcodeNumber']);
                                $subTotal[] = array_map(function ($item) {
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
                                                <button class="qty-up border bg-light" data-id="<?php echo $item['barcodeNumber'] ?? '0'; ?>">
                                                    <i class="fas fa-angle-up"></i>
                                                </button>
                                                <input type="text" data-id="<?php echo $item['barcodeNumber'] ?? '0'; ?>" 
                                                    class="qty_input border px-2 w-100 bg-light" disabled value="1" placeholder="1"> <!--item_quantity-->
                                                <button data-id="<?php echo $item['barcodeNumber'] ?? '0'; ?>"
                                                     class="qty-down border bg-light"><i class="fas fa-angle-down"></i>
                                                </button>
                                            </div>

                                            <!-- Delete Product Button -->
                                            <form method="post">
                                                <input type="hidden" value="<?php echo $item['barcodeNumber'] ?? 0; ?>" name="barcodeNumber">
                                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                                            </form>
                                            <!-- !Delete Product Button -->

                                        </div>
                                    <!-- !product qty -->

                                </div>

                                <!-- product price --> 
                                <div class="col-sm-2 text-right">
                                    <div class="font-size-20 text-danger font-baloo">
                                        $<span class="product_price" data-id="<?php echo $item['barcodeNumber'] ?? '0'; ?>"> <!-- ternary if and else statement -->
                                            <?php echo $item['productPrice'] ?? 0; ?> <!--item_price-->
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
                                    Subtotal ( <?php echo isset($subTotal) ? count($subTotal) : 0; ?> item):&nbsp; <!-- ternaary if and else statement -->
                                    <span class="text-danger">
                                        $
                                        <span class="text-danger" id="deal-price">
                                            <!-- call the 'getSum' method from 'database/Cart.php' -->
                                            <?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?> 
                                        </span>
                                    </span>
                                </h5>

                                <form method="post">

                                    <input type="hidden" name="barcodeNumber" value="<?php echo $item['barcodeNumber'] ?? '1'; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo 1; ?>"> <!-- user id is the first user cause there is no USER SESSION -->
                                    <input type="hidden" name="productPrice" value="<?php echo $item['productPrice'] ?? '100' ; ?>">


                                    
                                    <input type="hidden" name="cart_total">
                                    <?php
                                        echo '<button type="submit" 
                                               name="submit-cart-total" 
                                               class="btn btn-warning mt-3">Checkout</button>';
                                    ?>
                                </form>

                                <!-- !Go to Checkout page -->
                            </div>
                        </div>
                    </div>
                    <!-- !subtotal section-->
                </div>
            <!--  !shopping cart items   -->
        </div>
    </section>
<!-- !Shopping cart section  -->