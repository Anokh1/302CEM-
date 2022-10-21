<?php
    $barcodeNumber = $_GET['barcodeNumber'] ?? 1;
    foreach ($product->getData() as $item) :
        if ($item['barcodeNumber'] == $barcodeNumber) :
?>

<!-- Product -->
<section id="product" class="product py-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo $item['productImage'] ?? "./assets/products/1.PNG" ?>" alt="product" class="img-fluid">                <div class="form-row pt-4 font-size-16 font-baloo">
                    <div class="col">
                        <button type="submit" class="btn btn-danger form-control">Buy Now</button>
                    </div>
                    <div class="col"> <!-- CHANGED -->
                        <?php
                        if (in_array($item['barcodeNumber'], $Cart->getCartId($product->getData('cart')) ?? [])){
                            echo '<button type="submit" disabled class="btn btn-success font-size-16">In the Cart</button>';
                        }else{
                            echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-16 form-control">Add to Cart</button>';
                        }
                        ?>
                    </div>
                </div>
            </div>
                
            <div class="col-sm-6 py-5">
            <h5 class="font-baloo font-size-20"><?php echo $item['productName'] ?? "Unknown"; ?></h5> <!-- Laptop name --> 
                <small>by <?php echo $item['productType'] ?? "Type"; ?></small>
                <div class="d-flex">
                    <div class="rating text-warning font-size-12">
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                    </div>
                    <a href="#" class="px-2 font-rale font-size-14">10 ratings | 3 answered questions</a>
                </div>
                <hr class="m-0">

                <!-- product price -->
                    <table class="my-3">
                        <tr class="font-rale font-size-14">
                            <td>M.R.P</td>
                            <td><strike>$100.00</strike></td>
                        </tr>
                        <tr class="font-rale font-size-14">
                            <td>Deal Price</td>
                            <td class="font-size-20 text-danger">$<span><?php echo $item['productPrice'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;Inclusive of all taxes</small></td>
                         </tr>
                        <tr class="font-rale font-size-14">
                            <td>You Save</td>
                            <td><span class="font-size-16 text-danger">$10.00</span></td>
                        </tr>
                    </table>
                <!-- !product price -->

                <!-- policy -->
                    <div id="policy">
                        <div class="d-flex">
                            <div class="return text-center mr-5">
                                <div class="font-size-20 my-2 color-second">
                                    <span class="fas fa-retweet border p-3 rounded-pill"></span>
                                </div>
                                <a href="#" class="font-rale font-size-12">10 Days <br> Exchange</a>
                            </div>
                            <div class="return text-center mr-5">
                                <div class="font-size-20 my-2 color-second">
                                    <span class="fas fa-truck border p-3 rounded-pill"></span>
                                </div>
                                <a href="#" class="font-rale font-size-12">Daily <br> Delivery</a>
                            </div>
                            <div class="return text-center mr-5">
                                <div class="font-size-20 my-2 color-second">
                                    <span class="fas fa-check-double border p-3 rounded-pill"></span>
                                </div>
                                <a href="#" class="font-rale font-size-12">Authentic <br> Product</a>
                            </div>
                        </div>
                    </div>
                <!-- !policy -->
                <hr>

                <!--order-details-->
                    <div id="order-details" class="font-rale d-flex flex-column text-dark">
                        <small>Delivery by : Oct 24  - Nov 1</small>
                        <small>Sold by <a href="#">Dell</a> (4.5 out of 5 | 10 ratings)</small>
                        <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 11500</small>
                    </div>
                <!--order-details-->

                <div class="row">
                    <div class="col-6">
                            <!-- color -->
                                <div class="color my-3">
                                    <div class="d-flex justify-content-between">
                                    <h6 class="font-baloo">Color:</h6>
                                    <div class="p-2 color-silver-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                    </div>
                                </div>
                            <!-- !color -->
                    </div>
                    <div class="col-6">
                        <!-- product qty section -->  
                        <div class="qty d-flex">
                            <h6 class="font-baloo">Qty</h6>
                            <div class="px-4 d-flex font-rale">
                                <button class="qty-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
                                <input type="text" data-id="pro1" class="qty_input border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                                <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                            </div>
                        </div>
                        <!-- !product qty section -->  
                    </div>
                </div>

                <!-- Storage -->
                    <div class="size my-3">
                        <h6 class="font-baloo">Storage :</h6>
                        <div class="d-flex justify-content-between w-75">
                            <div class="font-rubik border p-2">
                                <button class="btn p-0 font-size-14">256GB</button>
                            </div>
                            <div class="font-rubik border p-2">
                                <button class="btn p-0 font-size-14">512GB</button>
                            </div>
                            <div class="font-rubik border p-2">
                                <button class="btn p-0 font-size-14">1TB</button>
                            </div>
                        </div>
                    </div>
                <!-- !Storage -->

            </div>

            <div class="col-12">
                <h6 class="font-rubik">Product Description</h6>
                <hr>
                <!-- <p class="font-rale font-size-14">Barcode Number: 11223344</p> -->
                <p class="font-rale font-size-14">Dell Laptop</p>
            </div>
        </div>
    </div>
</section>
<!-- !Product -->
<?php
        endif;
        endforeach;
?>