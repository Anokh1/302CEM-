<?php
    ob_start();
    // include header.php file
    include('header.php')
?>

<?php

    // include _cart-template.php file
    //include('Template/_cart-template.php');
    count($product->getData('cart')) ? include ('Template/_cart-template.php') :  include ('Template/nofFound/_cart-notFound.php');

    /*  include banner ads  */
    include('Template/_banner-ads.php');
    /*  include banner ads  */

?>

<?php
    // include footer.php file
    include('footer.php')
?>