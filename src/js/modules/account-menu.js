const accountTab = ()=>{
    jQuery(document).ready(function ($) {
        $('.woocommerce-MyAccount-navigation .active-tab a').on('click', function (e){
            e.preventDefault();
           $(this).closest('.active-tab').siblings('.other').slideToggle();
           $(this).closest('.mobile').toggleClass('open');
        })
    });
}
export  default accountTab;