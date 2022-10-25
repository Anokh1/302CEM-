<?php
    ob_start(); 
    // include _checkout-header.php file
    include('Template/_checkout-header.php')
?>

<?php

    /*  include checkout section  */
    include ('Template/_checkout-template.php');
    /*  include checkout section  */

    /*  include banner ads  */
        include ('Template/_banner-ads.php');
    /*  include banner ads  */

?>

<?php                 
    // include footer.php file
    include('footer.php')
?>

        
