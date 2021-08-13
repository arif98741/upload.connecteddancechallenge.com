var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
    showLeft = document.getElementById( 'showLeft' ),
    body = document.body;


$(document).ready(function () {

    $('#showLeft').click(function () {
        classie.toggle( this, 'active' );
        classie.toggle( menuLeft, 'cbp-spmenu-open' );
    });

    $('.mobileMenuHideOnOutside').click(function () {
        classie.removeClass( menuLeft, 'cbp-spmenu-open' );
    });
});
