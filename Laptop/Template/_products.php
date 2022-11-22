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
                <img src="<?php echo $item['productImage'] ?? "./assets/products/1.PNG" ?>"
                     alt="product" class="img-fluid">                <div class="form-row pt-4 font-size-16 font-baloo">


                </div>
            </div>
                
            <div class="col-sm-6 py-5">
            <h5 class="font-baloo font-size-20"> <!-- Laptop name -->
                <?php echo $item['productName'] ?? "Unknown"; ?>
            </h5>
<!--                <small>by --><?php //echo $item['productType'] ?? "Type"; ?><!--</small>-->
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
                            <td>Price</td>
                            <td class="font-size-20 text-danger">$<span><?php echo $item['productPrice'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;Inclusive of all taxes</small></td>
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
                            </div>
                            <div class="return text-center mr-5">
                                <div class="font-size-20 my-2 color-second">
                                    <span class="fas fa-truck border p-3 rounded-pill"></span>
                                </div>
                            </div>
                            <div class="return text-center mr-5">
                                <div class="font-size-20 my-2 color-second">
                                    <span class="fas fa-check-double border p-3 rounded-pill"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- !policy -->
                <hr>

                <!--order-details-->
                    <div id="order-details" class="font-rale d-flex flex-column text-dark">
                        <small>Delivery by : Oct 24  - Nov 1</small>
                        <small>Sold by <a href="#">Agile Laptop</a> (4.5 out of 5 | 10 ratings)</small>
                        <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 11500</small>
                    </div>
                <!--order-details-->

                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-6">

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
                <p class="font-rale font-size-14"><?php echo $item['productDescription'] ?? "No Description"; ?></p>
            </div>
        </div>
    </div>
</section>
<!-- !Product -->
        <?php
    endif;
endforeach;
?>