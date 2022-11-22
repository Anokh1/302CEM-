<?php
    ob_start();
    // include header.php file
    include('header.php')
?>

<?php
    /*  include banner area  */
    include('Template/_banner-area.php');
    /*  include banner area  */

    /*  include top sale section */
        include('Template/_top-sale.php');
    /*  include top sale section */

    /*  include banner ads  */
        include('Template/_banner-ads.php');
    /*  include banner ads  */
?>

<?php
    // include footer.php file
    include('footer.php');


        
