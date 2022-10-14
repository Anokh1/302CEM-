$(document).ready(function(){

    // banner owl carousel
    $("#banner-area .owl-carousel").owlCarousel({
        dots:true,
        items: 1
    }); 

    // top sale owl carousel
    $("#top-sale .owl-carousel").owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        responsive: {
            0: { 
                items:1
            },
            600: { // screen size is 600 pixels, display 3 items only...
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })

    // for Special Price section...
    // isotope filter
    var $grid = $(".grid").isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
    }); 

    // filter items on button click
    $(".button-group").on("click", "button", function(){
        var filterValue = $(this).attr('data-filter'); 
        $grid.isotope({filter: filterValue}); 
    });

    // new laptops owl carousel
    $("#new-laptops .owl-carousel").owlCarousel({
        loop:true,
        nav:false,
        dots:true,
        responsive: {
            0: { 
                items:1
            },
            600: { // screen size is 600 pixels, display 3 items only...
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })

    // blogs owl carousel
    $("#blogs .owl-carousel").owlCarousel({
        loop:true,
        nav:false,
        dots:true,
        responsive: {
            0: { 
                items:1
            },
            600: { // screen size is 600 pixels, display 3 items only...
                items: 3
            }
        }
    })

}); 