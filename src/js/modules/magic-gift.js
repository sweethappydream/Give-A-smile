const $ = window.jQuery;

$('#projects-gift').on('click', function ()  {

});
$('.special-gift__wrapper').on('click',function (){
    let btn = $(this).find('.btn');

    if (btn.length){
        let link = btn.attr('href');
        window.location.href = link;
    }

});